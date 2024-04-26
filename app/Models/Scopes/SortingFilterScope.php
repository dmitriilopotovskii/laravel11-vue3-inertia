<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

class SortingFilterScope
{
    public function __construct(
        protected readonly ?string $sortField,
        protected readonly ?string $sortDirection
    ) {
    }

    public function __invoke(Builder $query): void
    {
        if ($this->sortField || $this->sortDirection) {
            $query->orderBy($this->sortField, $this->sortDirection);
        }
    }
}
