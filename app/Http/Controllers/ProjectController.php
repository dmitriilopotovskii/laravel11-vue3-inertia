<?php

namespace App\Http\Controllers;

use App\Data\ProjectData;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\LaravelData\PaginatedDataCollection;

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     */
    public function index()
    {

        // Initialize the query builder with the Project model and  apply filters
        $query = Project::OfNameFilter(request('name'))->OfStatusFilter(request('status'));

        // Get the sort field from the request, default to 'created_at'
        $sortField = request('sort_field', 'created_at');

        // Get the sort direction from the request, default to 'desc'
        $sortDirection = request('sort_direction', 'desc');

        // Retrieve paginated projects based on query, sorting, and pagination
        $projects = $query->orderBy($sortField, $sortDirection)
            ->paginate(10);

        // Transform and format the project data
        $projectsData = ProjectData::collect($projects, PaginatedDataCollection::class)
            ->except('updated_by', 'created_by.email');

        // Render the project index view using Inertia with the formatted project data
        return Inertia::render('Project/Index', [
            'projects' => $projectsData,
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
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
