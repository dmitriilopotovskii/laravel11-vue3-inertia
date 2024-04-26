<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;

class StringColumnFilterScope
{
    public function __construct(
        protected readonly ?string $name,
        protected readonly ?string $column
    ) {
    }

    public function __invoke(Builder $query): void
    {
        $query->where($this->column, 'like', '%'.$this->name.'%');
    }
}
