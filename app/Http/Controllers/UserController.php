<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\UserActions\UpsertUserAction;
use App\Data\UserData;
use App\Data\UserUpsertData;
use App\Models\Scopes\SortingFilterScope;
use App\Models\Scopes\StringColumnFilterScope;
use App\Models\User;
use Inertia\Inertia;
use Spatie\LaravelData\PaginatedDataCollection;

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
        $userData = UserData::collect($users, PaginatedDataCollection::class);

        return Inertia::render('User/Index', [
            'users' => $userData,
            'queryParams' => request()->query() ?: ['name' => ''],
            'success' => session('success'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('User/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserUpsertData $data)
    {
        $user = UpsertUserAction::execute($data);

        return to_route('users.index')
            ->with('success', "User \"$user->name\" was created");
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
    public function edit(User $user)
    {
        return inertia('User/Edit', [
            'user' => UserData::from($user),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpsertData $data)
    {
        $user = UpsertUserAction::execute($data);

        return to_route('users.index')
            ->with('success', "User \"$user->name\" was updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return to_route('users.index')
            ->with('success', "User \"$user->name\" was deleted");
    }
}
