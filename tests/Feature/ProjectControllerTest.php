<?php

use App\Models\Project;
use Illuminate\Http\UploadedFile;
use Inertia\Testing\AssertableInertia as Assert;

it('Authenticated users can see projects /projects', function () {
    $user = user()->create();
    $response = test()
        ->actingAs($user)
        ->get('/projects');
    $response->assertOk();
});
test('Not authenticated users can not see projects /projects', function () {
    $response = $this->get('/projects');

    $response->assertStatus(302);
});
test('response contains 12 project data items, with the first project having an ID of 1 and not having "updated_by" and "created_by.email" properties',
    function () {
        $user = user()->create();
        Project::factory()
            ->count(12)
            ->create();
        test()
            ->actingAs($user)
            ->get('/projects/')
            ->assertInertia(fn (Assert $page) => $page
                ->component('Project/Index')
                ->where('projects.meta.total', 12)
                ->where('projects.data.0.id', 1)
                ->missingAll('projects.data.0.updated_by', 'projects.data.0.created_by.email')
                ->hasAll('projects.data.0.id', 'projects.data.0.name', 'projects.data.0.description',
                    'projects.data.0.due_date', 'projects.data.0.created_at', 'projects.data.0.status',
                    'projects.data.0.image_path')
            );
    });
test('create', function () {
});
test('show', function () {
});
test('destroy', function () {
});
test('update', function () {
});
test('edit', function () {
});

it('Authenticated users can store projects', function () {
    $user = user()->create();
    test()
        ->actingAs($user)
        ->post('/projects', [
            'name' => 'Test Project',
            'description' => 'Test Project Description',
            'due_date' => '2022-12-31',
            'status' => 'in_progress',
            'image' => UploadedFile::fake()->image('project.png'),
        ])
        ->assertRedirect()
        ->assertSessionHasNoErrors();

    $project = Project::where('name', 'Test Project')->first();
    expect($project)->toBeInstanceOf(Project::class)
        ->and($project->name)->toBe('Test Project')
        ->and($project->description)->toBe('Test Project Description')
        ->and($project->due_date)->toBe('2022-12-31')
        ->and($project->status)->toBe('in_progress')
        ->and($project->image_path)->not()->toBeNull();
});
