<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property Carbon|null $due_date
 * @property string $status
 * @property string|null $image_path
 * @property int $created_by
 * @property int $updated_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Task> $tasks
 *
 * @method static \Database\Factories\ProjectFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUpdatedBy($value)
 *
 * @mixin \Eloquent
 */
class Project extends Model
{
    use HasFactory;

    public function tasks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function createdBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Filters the query by the given name.
     *
     * @param  Builder  $query  The query builder instance.
     * @param  string|null  $name  The name to filter by.
     * @return Builder The modified query builder instance.
     */
    public function scopeOfNameFilter(Builder $query, ?string $name): Builder
    {
        return $query->where('name', 'like', '%'.$name.'%');
    }

    /**
     * Filters the query by the given status.
     *
     * @param  Builder  $query  The query builder instance.
     * @param  string|null  $status  The status to filter by.
     * @return Builder The modified query builder instance.
     */
    public function scopeOfStatusFilter(Builder $query, ?string $status): Builder
    {
        if (ProjectStatus::tryfrom($status)) {
            return $query->where('status', $status);
        }

        return $query;
    }

    /**
     * Filters the query by the given sorting criteria.
     *
     * @param  Builder  $query  The query builder instance.
     * @param  string|null  $sortDirection  The direction of sorting. Defaults to 'desc'.
     * @param  string|null  $sortField  The field to sort by. Defaults to 'created_at'.
     * @return Builder The modified query builder instance.
     */
    public function scopeOfSortingFilter(
        Builder $query,
        ?string $sortDirection = 'desc',
        ?string $sortField = 'created_at'
    ): Builder {
        //dd($sortField, $sortDirection);

        return ($sortField || $sortDirection) ? $query->orderBy($sortField, $sortDirection) : $query;
    }
}
