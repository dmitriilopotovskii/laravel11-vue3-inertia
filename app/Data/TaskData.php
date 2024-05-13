<?php

declare(strict_types=1);

namespace App\Data;

use App\Models\Task;
use Carbon\Carbon;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class TaskData extends Data
{
    public function __construct(

        public readonly ?int $id,
        public readonly string $name,
        public readonly Lazy|string $description,
        public readonly Lazy|string $due_date,
        public readonly Lazy|string $created_at,
        public readonly Lazy|string $status,
        public readonly Lazy|string $priority,
        public readonly Lazy|string|null $image_path,
        public readonly Lazy|UserData|null $created_by,
        public readonly Lazy|UserData|null $updated_by,
        public readonly Lazy|UserData|null $assigned_user,
        public readonly Lazy|ProjectData|null $project,

    ) {
    }

    public static function fromModel(Task $task): self
    {
        return new self(
            $task->id,
            $task->name,
            Lazy::inertia(fn () => $task->description),
            Lazy::inertia(fn () => (new Carbon($task->due_date))->format('Y-m-d')),
            Lazy::inertia(fn () => $task->created_at->format('Y-m-d')),
            Lazy::inertia(fn () => $task->status),
            Lazy::inertia(fn () => $task->priority),
            Lazy::inertia(fn () => $task->image_path),
            Lazy::inertia(fn () => UserData::from($task->CreatedBy()->first())),
            Lazy::inertia(fn () => UserData::from($task->UpdatedBy()->first())),
            Lazy::inertia(fn () => UserData::from($task->AssignedUser()->first())),
            Lazy::inertia(fn () => ProjectData::from($task->project()->first())->only('id', 'name'))

        );
    }
}
