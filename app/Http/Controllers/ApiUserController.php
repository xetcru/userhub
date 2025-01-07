<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApiUserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $users = User::query()
            ->when($search, fn($query) => $query->where('name', 'like', "%$search%"))
            ->orderBy('name')
            ->paginate(10);

        return response()->json($users);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'ip' => 'nullable|ipv4',
            'comment' => 'nullable|string',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $user = User::create($validated);

        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'ip' => 'nullable|ipv4',
            'comment' => 'nullable|string',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
        }

        $user->update($validated);

        return response()->json($user);
    }

    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(['message' => 'User deleted successfully.']);
    }
}
