<?php

namespace App\Http\Controllers;

use App\Models\Scopes\SortingFilterScope;
use App\Models\Scopes\StringColumnFilterScope;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query()
            ->filter(
                new StringColumnFilterScope(request('name'), 'name'),
                new StringColumnFilterScope(request('email'), 'email'),
                new SortingFilterScope(request('sort_field'), request('sort_direction'))
            )
            ->paginate(10);

        return Inertia::render('User/Index', [
            'users' => $users,
            'queryParams' => request()->query() ?: ['name' => ''],
            'success' => session('success'),
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
