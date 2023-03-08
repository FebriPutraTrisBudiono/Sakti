<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\RegistrationFee;

class RegistrationFeeController extends Controller
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

        return view('dashboard.fees', [
            'title_bar' => 'Data Fee',
            'fees'      => RegistrationFee::with('user')
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
            'name'  => ['required', 'min:3', 'max:255', 'unique:registration_fees'],
            'fee'   => ['required', 'min:3', 'max:255']
        ]);
        $data['fee'] = Str::replace(['.', ','], ['', '.'], $request->fee);
        $data['user_id'] = auth()->user()->id;
        RegistrationFee::create($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RegistrationFee  $registrationfee
     * @return \Illuminate\Http\Response
     */
    public function show(RegistrationFee $registrationfee)
    {
        return response()->json($registrationfee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RegistrationFee  $registrationfee
     * @return \Illuminate\Http\Response
     */
    public function edit(RegistrationFee $registrationfee)
    {
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RegistrationFee  $registrationfee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegistrationFee $registrationfee)
    {
        $data = $request->validate([
            'name'      => $request->name !== $registrationfee->name ? ['required', 'min:3', 'max:255', 'unique:registration_fees'] : ['required', 'min:3', 'max:255'],
            'fee'   => ['required', 'min:3', 'max:255']
        ]);
        $data['fee'] = Str::replace(['.', ','], ['', '.'], $request->fee);
        $data['user_id'] = auth()->user()->id;
        RegistrationFee::where('id', $registrationfee->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RegistrationFee  $registrationfee
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegistrationFee $registrationfee)
    {
        RegistrationFee::destroy($registrationfee->id);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil dihapus!</div>');
    }
}
