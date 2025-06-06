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
                    ->orWhere('branch', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%")
                    ->orWhere('role', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->paginate(10);

        return view('users.index', compact('users'));
    }
    // Filter search auto di tabel
    // public function search(Request $request)
    // {
    //     $query = $request->query('query');
    //     $filter = $request->query('filter', 'name');

    //     $allowedFilters = ['name', 'email', 'branch', 'nik', 'role'];
    //     if (!in_array($filter, $allowedFilters)) {
    //         return response()->json([], 400);
    //     }

    //     $users = User::where($filter, 'LIKE', "%{$query}%")
    //         ->select('id', 'nik', 'name', 'email', 'role', 'branch')
    //         ->orderBy($filter)
    //         ->limit(50)
    //         ->get();

    //     return response()->json($users);
    // }
    public function search(Request $request)
    {
        $query = $request->query('query');
        $filter = $request->query('filter');

        $users = User::query()
            ->when($filter && $query, function ($q) use ($filter, $query) {
                $q->where($filter, 'like', "%{$query}%");
            })
            ->select('id', 'nik', 'name', 'role', 'role_desc', 'branch', 'email', 'phone') // ⬅ PASTIKAN SEMUA KOLOM DIBUTUHKAN
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
            'nik' => 'required|string|max:20|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|email|ends_with:@pinusmerahabadi.co.id|unique:users',
            'branch' => 'required|string|max:255',
            'role' => 'required|string|max:50',
            'role_desc' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'nik' => $request->nik,
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'role_desc' => $request->role_desc,
            'phone' => $request->phone,
            'branch' => $request->branch,
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
            'nik' => "string|max:20|unique:users,nik,{$user->id}",
            'name' => 'required|string|max:255',
            'email' => "required|email|ends_with:@pinusmerahabadi.co.id|unique:users,email,$user->id",
            'branch' => 'required|string|max:255',
            'role' => 'string|max:50',
            'role_desc' => 'string|max:255',
            'phone' => 'string|max:20',
        ]);

        $user->update($request->only('nik', 'name', 'email', 'branch', 'role', 'role_desc', 'phone'));

        return redirect()->route('users.index')->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
