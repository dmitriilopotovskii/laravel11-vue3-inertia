<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

readonly class StringColumnFilterScope
{
    public function __construct(
        protected ?string $name,
        protected ?string $column
    ) {
    }

    public function __invoke(Builder $query): void
    {
        $query->where($this->column, 'like', '%'.$this->name.'%');
    }
}
