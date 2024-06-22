<?php

declare(strict_types=1);

namespace App\Data;

use App\Enums\ProjectStatus;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Attributes\Validation\Enum;
use Spatie\LaravelData\Attributes\Validation\Image;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Lazy;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use Storage;

#[TypeScript]
class ProjectData extends Data
{
    public function __construct(

        public readonly ?int $id,
        #[Max(255)]
        public readonly string $name,
        public readonly Lazy|string $description,
        #[Date]
        public readonly Lazy|string $due_date,
        public readonly Lazy|string|null $created_at,
        #[Enum(ProjectStatus::class)]
        public readonly Lazy|string $status,
        #[Image]
        public readonly Lazy|UploadedFile|null $image,
        public readonly Lazy|string|null $image_path,
        public readonly Lazy|UserData|null $created_by,
        public readonly Lazy|UserData|null $updated_by,
        #[DataCollectionOf(TaskData::class)]
        public readonly Lazy|DataCollection|null $tasks
    ) {
    }

    public static function fromModel(Project $project): self
    {

        return new self(
            $project->id,
            $project->name,
            Lazy::inertia(fn () => $project->description),
            Lazy::inertia(fn () => (new Carbon($project->due_date))->format('Y-m-d')),
            Lazy::inertia(fn () => $project->created_at ? $project->created_at->format('Y-m-d') : null),
            Lazy::inertia(fn () => $project->status),
            Lazy::inertia(fn () => $project->image = null),
            Lazy::inertia(fn () => $project->image_path && ! (str_starts_with($project->image_path, 'http')) ?
                Storage::url($project->image_path) : $project->image_path),
            Lazy::closure(fn () => UserData::from($project->createdBy)),
            Lazy::inertia(fn () => $project->updatedBy ? UserData::from($project->updatedBy) : null),
            Lazy::inertia(fn () => null),

        );
    }
}
