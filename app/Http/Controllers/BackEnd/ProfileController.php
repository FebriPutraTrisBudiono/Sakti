<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.profile', [
            'title_bar' => 'Profil',
            'user'      => auth()->user()
        ]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'      => 'required|min:3|max:255',
            'username'  => $request->username !== $user->username ? 'required|min:3|max:255|unique:users' : 'required|min:3|max:255',
            'email'     => $request->email !== $user->email ? 'required|min:3|max:255|email:dns|unique:users' : 'required|min:3|max:255|email:dns',
            'photo' => ['image', 'file', 'max:2048']
        ]);

        $data['address'] = $request->address;
        $data['telp'] = $request->telp;
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::delete($user->photo);
            }
            $data['photo'] = $request->photo->store('uploads');
        }

        User::where('id', $user->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }
}
