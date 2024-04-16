<?php

namespace App\Data;

use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ProjectData extends Data
{

    public function __construct(

        public readonly ?int $id,
        public readonly string $name,
        public readonly Lazy|string $description,
        public readonly Lazy|string $due_date,
        public readonly Lazy|string $created_at,
        public readonly Lazy|string $status,
        public readonly Lazy|string|null $image_path,
        public readonly ?UserData $created_by,
        public readonly ?UserData $updated_by
    ) {
    }

    public static function fromModel(Project $project): self
    {
        return new self(
            $project->id,
            $project->name,
            Lazy::inertia(fn() => $project->description),
            Lazy::inertia(fn() =>(new Carbon($project->due_date))->format('Y-m-d')),
            Lazy::inertia(fn() => $project->created_at->format('Y-m-d')),
            Lazy::inertia(fn() => $project->status),
            Lazy::inertia(fn() => $project->image_path),
            UserData::from(User::find($project->created_by)),
            UserData::from(User::find($project->updated_by)),

        );
    }
}
