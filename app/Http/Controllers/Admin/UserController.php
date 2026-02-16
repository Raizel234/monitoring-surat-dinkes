<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;

        $users = User::query()
            ->when($q, function ($query) use ($q) {
                $query->where('name', 'like', "%$q%")
                      ->orWhere('email', 'like', "%$q%")
                      ->orWhere('instansi', 'like', "%$q%")
                      ->orWhere('jabatan', 'like', "%$q%");
            })
            ->orderBy('role')
            ->orderBy('name')
            ->paginate(10);

        return view('admin.users.index', compact('users', 'q'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => ['required', Rule::in(['admin', 'pegawai','atasan'])],
            'instansi' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
        ]);

        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dibuat.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required','email','max:255', Rule::unique('users','email')->ignore($user->id)],
            'password' => 'nullable|string|min:6',
            'role' => ['required', Rule::in(['admin', 'pegawai','atasan'])],
            'instansi' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
        ]);

        // kalau password kosong, jangan update password
        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diupdate.');
    }

    public function destroy(User $user)
    {
        // proteksi: admin tidak bisa hapus dirinya sendiri
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        $user->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }
}
