<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class LevelController extends Controller
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

        return view('dashboard.levels', [
            'title_bar' => 'Data Level',
            'levels'    => Level::withCount('users')->latest()->paginate(100),
            'roles'     => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(403);
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
            'name' => ['required', 'unique:levels', 'min:4', 'max:255'],
        ]);
        $data['user_id'] = auth()->user()->id;
        Level::create($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function show(Level $level)
    {
        return response()->json($level);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function edit(Level $level)
    {
        $userAccess = Level::find($level->id)->access;
        $access = explode(',', $userAccess);

        $roles = Level::routes()->toArray();

        foreach ($roles as $role) {
            $roleEx = explode('.', $role);
            $actionName = Level::actionName($roleEx[1])['name'];
            $roleArr[] = [
                'name'  => $actionName,
                'group' => Str::replace('_', ' ', $roleEx[0]),
                'route' => $role
            ];
        }

        $grouped = collect($roleArr)->groupBy('group')->toArray();

        return view('dashboard.leveledit', [
            'title_bar'     => 'Perbarui Level',
            'level'         => $level,
            'access'        => $access,
            'roles'         => $grouped
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Level $level)
    {
        $data = $request->validate([
            'name' => $request->name !== $level->name ? ['required', 'unique:levels', 'min:4', 'max:255'] : ['required', 'min:4', 'max:255']
        ]);
        if ($request->roles) {
            $data['access'] = implode(',', $request->roles);
        }
        $data['user_id'] = auth()->user()->id;
        Level::where('id', $level->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function destroy(Level $level)
    {
        if ($level->users->count() === 0) {
            Level::destroy($level->id);
            return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil dihapus!</div>');
        }
    }
}
