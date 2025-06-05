<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    // public function index()
    // {
    //     $users = User::all();
    //     return view('users.index', compact('users'));
    // }
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('kode_depo', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->paginate(10);

        return view('users.index', compact('users'));
    }
    // Filter search auto di tabel
    public function search(Request $request)
    {
        $query = $request->query('query');
        $filter = $request->query('filter', 'name');

        $allowedFilters = ['name', 'email', 'kode_depo'];
        if (!in_array($filter, $allowedFilters)) {
            return response()->json([], 400);
        }

        $users = User::where($filter, 'LIKE', "%{$query}%")
            ->select('id', 'name', 'email', 'kode_depo')
            ->orderBy($filter)
            ->limit(50)
            ->get();

        return response()->json($users);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|ends_with:@pma.co.id|unique:users',
            'kode_depo' => 'required|string|max:255',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'kode_depo' => $request->kode_depo,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    //     public function edit($id)
    // {
    //     $user = User::findOrFail($id);
    //     return view('users.edit', compact('user'));
    // }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|ends_with:@pma.co.id|unique:users,email,$user->id",
            'kode_depo' => 'required|string|max:255',
        ]);

        $user->update($request->only('name', 'email', 'kode_depo'));

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
