<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Level;
use Illuminate\Http\Request;

class BankController extends Controller
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

        return view('dashboard.banks', [
            'title_bar' => 'Data Bank',
            'banks'     => Bank::with('user')
                ->latest()->paginate(100),
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
            'name'      => ['required', 'min:3', 'max:255', 'unique:banks'],
            'bank_name' => ['required', 'min:3', 'max:255'],
            'number'    => ['required', 'min:3', 'max:255'],
        ]);
        $data['user_id'] = auth()->user()->id;
        Bank::create($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        return response()->json($bank);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
    {
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bank $bank)
    {
        $data = $request->validate([
            'name'      => $request->name !== $bank->name ? ['required', 'min:3', 'max:255', 'unique:banks'] : ['required', 'min:3', 'max:255'],
            'bank_name' => 'required|min:3|max:255',
            'number'    => 'required|min:3|max:255'
        ]);
        $data['user_id'] = auth()->user()->id;
        Bank::where('id', $bank->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        Bank::destroy($bank->id);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil dihapus!</div>');
    }
}
