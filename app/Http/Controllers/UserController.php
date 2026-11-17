<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    // Menampilkan daftar user
    public function index()
    {
    if (!Auth::check()) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Silakan login terlebih dahulu'])
                ->onlyInput('email');
        }


        $users = User::latest()->paginate(15);
        return view('admin.user.index', compact('users'));


    }


    // Menampilkan form tambah user
    public function create()
    {
        return view('admin.user.create');
    }


    // Menyimpan user baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                'unique:users,name',
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
            'role' => [
                'required',
                'string',
                'in:Super Admin,Pelanggan,Mitra',
            ],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama maksimal 100 karakter.',
            'name.unique' => 'Nama sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);


        // Mengenkripsi password
        $validated['password'] = Hash::make($validated['password']);


        // Menyimpan user baru
        User::create($validated);


        return redirect()
            ->route('user.index')
            ->with('success', 'User berhasil ditambahkan.');
    }


    // Menampilkan form edit user
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }


    // Memperbarui data user
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('users', 'name')->ignore($user->id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama maksimal 100 karakter.',
            'name.unique' => 'Nama sudah digunakan user lain.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan user lain.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);


        // Password hanya diubah jika kolomnya diisi
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }


        // Memperbarui data user
        $user->update($validated);


        return redirect()
            ->route('user.index')
            ->with('success', 'User berhasil diperbarui.');
    }


    // Menghapus user
    public function destroy(User $user)
    {
        $user->delete();


        return redirect()
            ->route('user.index')
            ->with('success', 'User berhasil dihapus.');
    }


    // Menampilkan detail user
    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }
}
