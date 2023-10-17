<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index', [
            'users' => User::all(),
            'roles' =>Role::all()
        ]);
    }

    public function store(UserRequest $request)
    {
        User::create($request->all());
        return back()->with('success', 'User berhasil ditambahkan!');
    }

    public function update(Request $request, User $user)
    {
        // $validatedData = Validator::make($request->all(), [
        //     'nama' => ['required', 'string'],
        //     'nik' => 'required|string|unique:users,nik',
        //     'jabatan' => ['required'],
        //     'role' => ['required'],
        // ],
        // $messages = [
        //     'nik.unique' => 'NIK ada dong'
        // ]);
        $validatedData = $request->validate(
            [
                'nama' => ['required', 'string'],
                'nik' => 'required|string|unique:users,nik,' . $user->id,
                'role_id' => ['required'],
            ]);

        User::where('id', $user->id)->update([
            'nama' => $validatedData['nama'],
            'nik' => $validatedData['nik'],
            'role_id' => $validatedData['role_id'],
        ]);

        return back()->with('success', 'User berhasil diupdate!');
    }

    public function destroy(User $user)
    {
        User::destroy($user->id);
        return back()->with('success', 'User berhasil dihapus');
    }
}
