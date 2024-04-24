<?php

namespace App\Http\Controllers;

use App\Data\TaskData;
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
        $query = Task::OfNameFilter(request('name'))->OfStatusFilter(request('status'));

        // Get the sort field from the request, default to 'created_at'
        $sortField = request('sort_field', 'created_at');

        // Get the sort direction from the request, default to 'desc'
        $sortDirection = request('sort_direction', 'desc');

        // Retrieve paginated tasks based on query, sorting, and pagination
        $tasks = $query->orderBy($sortField, $sortDirection)
            ->paginate(10);

        // Transform and format the task data
        $tasksData = TaskData::collect($tasks, PaginatedDataCollection::class)
            ->except('updated_by', 'assigned_user');

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
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
