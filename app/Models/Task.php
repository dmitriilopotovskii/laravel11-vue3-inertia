<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $image_path
 * @property string $status
 * @property string $priority
 * @property string|null $due_date
 * @property int $assigned_user_id
 * @property int $created_by
 * @property int $updated_by
 * @property int $project_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\TaskFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereAssignedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Task whereUpdatedBy($value)
 *
 * @mixin \Eloquent
 */
class Task extends Model
{
    use HasFactory;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

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

    public function scopeOfSortingFilter(
        Builder $query,
        ?string $sortDirection = 'desc',
        ?string $sortField = 'created_at'
    ): Builder {
        //dd($sortField, $sortDirection);

        return ($sortField || $sortDirection) ? $query->orderBy($sortField, $sortDirection) : $query;
    }
}
