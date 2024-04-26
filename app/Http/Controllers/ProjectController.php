<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Data\ProjectData;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\TaskResource;
use App\Models\Project;
use App\Models\Scopes\SortingFilterScope;
use App\Models\Scopes\StatusFilterScope;
use App\Models\Scopes\StringColumnFilterScope;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\LaravelData\PaginatedDataCollection;
use Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     */
    public function index()
    {
        // Initialize the query builder with the Project model and  apply filters from request
        $query = Project::query()
            ->filter(
                new StringColumnFilterScope(request('name'), 'name'),
                new StatusFilterScope(request('status')),
                new SortingFilterScope(request('sort_field'), request('sort_direction'))
            );

        // Retrieve paginated projects based on query, sorting, and pagination
        $projects = $query->with('createdBy')->
        paginate(10);
        // Transform and format the project data
        $projectsData = ProjectData::collect($projects, PaginatedDataCollection::class)
            ->except('updated_by', 'created_by.email', 'tasks');

        // Render the project index view using Inertia with the formatted project data
        return Inertia::render('Project/Index', [
            'projects' => $projectsData,
            'queryParams' => request()->query() ?: ['name' => ''],
            'success' => session('success'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Project/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created project in the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Extract project data from the request
        $data = ProjectData::from($request);

        // Create a new project instance
        $project = new Project();

        // Assign values to the project attributes
        $project->name = $data->name;
        $project->description = $data->description;
        $project->due_date = $data->due_date;
        $project->status = $data->status;

        // Store the project image if provided
        $project->image_path = $request->hasFile('image') ? $request->file('image')->store('project/'.Str::random(),
            'public') : null;

        // Set the created_by and updated_by values
        $project->created_by = Auth::id();
        $project->updated_by = Auth::id();

        // Save the project to the database
        $project->save();

        // Redirect to the projects index page with a success message
        return to_route('projects.index')
            ->with('success', 'Project was created');
    }

    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function show(
        Project $project
    ) {
        // Retrieve the project with the specified id
        $project = Project::query()
            ->select([
                'id', 'name', 'created_at', 'created_by',
                'updated_by', 'status', 'image_path',
            ])
            ->where('id', $project->id)
            ->first();

        // Retrieve and filter the tasks associated with the project
        $tasks = Task::OfNameFilter(request('name'))
            ->OfStatusFilter(request('status'))
            ->OfSortingFilter(request('sort_direction'),
                request('sort_field'))
            ->where('project_id', $project->id)
            ->get();

        // Convert the project and tasks to resources
        $projectResource = new ProjectResource($project);
        $tasksResource = TaskResource::collection($tasks);

        // Render the view using Inertia
        return Inertia::render('Project/Show', [
            'project' => $projectResource,
            'tasks' => $tasksResource,
            'queryParams' => request()->query() ?: ['name' => ''],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return inertia('Project/Edit', [
            'project' => ProjectData::from($project)->except('updated_by', 'created_by', 'tasks'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        Project $project
    ) {
        // Extract and validate project data from the request
        $data = ProjectData::from($request);
        // Assign values to the project attributes
        $project->name = $data->name;
        $project->description = $data->description;
        $project->due_date = $data->due_date;
        $project->status = $data->status;
        if ($request->hasFile('image')) {
            if ($project->image_path) {
                Storage::disk('public')->deleteDirectory(dirname($project->image_path));
            }
            $project->image_path = $request->file('image')->store('project/'.Str::random(),
                'public');
        }

        // Set the updated_by values
        $project->updated_by = Auth::id();
        // Save the project to the database
        $project->save();

        return to_route('projects.index')
            ->with('success', "Project \"$project->name\" was updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Project $project
    ) {
        $name = $project->name;
        $project->delete();
        if ($project->image_path) {
            Storage::disk('public')->deleteDirectory(dirname($project->image_path));
        }

        return to_route('projects.index')
            ->with('success', "Project \"$name\" was deleted");
    }
}
