<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
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

        return view('dashboard.menus', [
            'title_bar' => 'Manajemen Menu',
            'menus'     => Menu::orderBy('sort', 'ASC')->get(),
            'mainMenus' => Menu::where('child', NULL)->get(),
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
            'name'  => ['required', 'unique:menus', 'min:3', 'max:100']
        ]);
        $data['link'] = $request->link ? $request->link : '#';
        $data['child'] = $request->child ? $request->child : NULL;
        $data['sort'] = $request->sort ? $request->sort : 1;
        Menu::create($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        return response()->json($menu);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'name'  => ($request->name !== $menu->name ? ['required', 'unique:menus', 'min:3', 'max:100'] : ['required', 'min:3', 'max:100'])
        ]);
        $data['link'] = $request->link ? $request->link : '#';
        $data['child'] = $request->child ? $request->child : NULL;
        $data['sort'] = $request->sort ? $request->sort : 1;
        Menu::where('id', $menu->id)->update($data);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil disimpan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        Menu::destroy($menu->id);
        return back()->with('msg', '<div class="alert small alert-success alert-dismissible fade show" role="alert">Data berhasil dihapus.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
    }
}
