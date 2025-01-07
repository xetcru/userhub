<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WebUserController extends Controller
{
    /*public function index(Request $request)
    {
        $search = $request->input('search', '');
        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy('name')
            ->paginate(10);

        return view('users.index', compact('users', 'search'));
    }//*/
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $sortColumn = $request->input('sort', 'id'); // По умолчанию сортировка по ID
        $sortDirection = $request->input('direction', 'asc'); // По умолчанию ASC

        // Ограничение сортировки допустимыми колонками
        $allowedSorts = ['id', 'name', 'email'];
        if (!in_array($sortColumn, $allowedSorts)) {
            $sortColumn = 'id';
        }

        // Получение данных
        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy($sortColumn, $sortDirection)
            ->paginate(10)
            ->appends(['search' => $search, 'sort' => $sortColumn, 'direction' => $sortDirection]);

        return view('users.index', compact('users', 'search', 'sortColumn', 'sortDirection'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('users.create');
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

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
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
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
