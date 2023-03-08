<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Level;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Cviebrock\EloquentSluggable\Services\SlugService;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);

        $users = User::filter(request(['q', 'level', 'status']))
            ->orderBy('id', 'ASC')
            ->latest()
            ->paginate(100);

        return view('dashboard.users', [
            'title_bar' => 'Data User',
            'users'     => $users,
            'roles'     => $roles,
            'levels'     => Level::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.usercreate', [
            'title_bar' => 'User Baru',
            'levels'    => Level::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|min:3|max:255',
            'username'  => 'required|min:3|max:255|unique:users',
            'email'     => 'required|min:3|max:255|email:dns|unique:users',
            'address'   => 'min:3',
            'telp'      => 'min:3|max:15',
            'level_id'  => 'required',
            'password'  => 'required|min:3|max:255',
            'status'    => 'required'
        ]);
        $data['password'] = Hash::make($request->password);
        $data['email_verified_at'] = now();
        $data['remember_token'] = Str::random(10);
        User::create($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboard.useredit', [
            'title_bar' => 'Perbarui User',
            'user'      => $user,
            'levels'    => Level::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'      => 'required|min:3|max:255',
            'username'  => $request->username !== $user->username ? 'required|min:3|max:255|unique:users' : 'required|min:3|max:255',
            'email'     => $request->email !== $user->email ? 'required|min:3|max:255|email:dns|unique:users' : 'required|min:3|max:255|email:dns',
            'level_id'  => 'required',
            'status'    => 'required'
        ]);
        $data['address'] = $request->address;
        $data['telp'] = $request->telp;
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        $data['remember_token'] = Str::random(10);
        User::where('id', $user->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->id !== 1) {
            User::destroy($user->id);
            return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil dihapus!</div>');
        }
    }

    public function createUsername(Request $request)
    {
        $username = SlugService::createSlug(User::class, 'username', $request->name);
        return response()->json(['username' => $username]);
    }
}
