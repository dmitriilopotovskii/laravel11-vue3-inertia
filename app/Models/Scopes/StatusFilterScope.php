<?php

namespace App\Models\Scopes;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Builder;

class StatusFilterScope
{
    public function __construct(
        protected readonly ?string $status,
    ) {
    }

    public function __invoke(Builder $query): void
    {
        if ($this->status) {
            $status = ProjectStatus::tryFrom($this->status)->value;

            $query->where('status', $status);
        }
    }
}
