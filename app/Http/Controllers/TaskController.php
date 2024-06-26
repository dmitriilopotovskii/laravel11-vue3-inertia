<?php

namespace App\Http\Controllers;

use App\Data\TaskData;
use App\Models\Scopes\SortingFilterScope;
use App\Models\Scopes\StatusFilterScope;
use App\Models\Scopes\StringColumnFilterScope;
use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\LaravelData\PaginatedDataCollection;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Initialize the query builder with the Task model and  apply filters
        /// Retrieve paginated tasks based on query, sorting, and pagination
        $tasks = Task::query()
            ->select([
                'id', 'name', 'description', 'image_path', 'status', 'priority', 'due_date',
                'created_by', 'project_id', 'created_at', 'updated_at',
            ])
            ->with('createdBy', 'project')
            ->filter(
                new StringColumnFilterScope(request('name'), 'name'),
                new StatusFilterScope(request('status')),
                new SortingFilterScope(request('sort_field'), request('sort_direction'))
            )->paginate(10);

        // Transform and format the task data
        $tasksData = TaskData::collect($tasks, PaginatedDataCollection::class);

        // Render the task index view using Inertia with the formatted task data
        return Inertia::render('Task/Index', [
            'tasks' => $tasksData,
            'queryParams' => request()->query() ?: ['name' => ''],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $task = Task::query()->
        select([
            'id', 'name', 'description', 'due_date', 'status', 'priority', 'image_path', 'created_at',
        ])->where('id', $id)
            ->first();
        ray(TaskData::from($task));

        return inertia('Task/Edit', [
            'task' => TaskData::from($task),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        ray($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
