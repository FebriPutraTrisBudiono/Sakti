<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Level;
use App\Models\Client;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Logawalcertification;
use App\Models\Penerbitansertifikat;

class DashboardController extends Controller
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

        $getUser =  auth()->user();
        $getClient = Client::where('user_id', $getUser->id)->first();

        if ($getClient) {
            $log = Logawalcertification::where('client_id', $getClient->id)->get();
            $client = Client::where('id', $getClient->id)->orderBy('created_at', 'DESC')
                ->paginate(100);
            $client_data = Client::with([
                'user',
                'service'
            ])
                ->whereRelation('user', 'status', '=', 1)
                ->orderBy('created_at', 'DESC')
                ->paginate(100);

            return view('dashboard.index', [
                'title_bar' => 'Dashboard',
                'clients'   => $client,
                'client_data'   => $client_data,
                'roles'     => $roles,
                'log'     => $log,
                'client'     => $getClient->id,
                'userCount'     => User::count(),
                'clientCount'     => Client::count(),
                'paymentCount'     => Payment::count(),
            ]);
        }
        return view('dashboard.index', [
            'title_bar' => 'Dashboard',
            'roles'     => $roles,
            'log'     => $log ?? '',
            'userCount'     => User::count(),
            'clientCount'     => Client::count(),
            'paymentCount'     => Payment::count(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function notifikasiexpired()
    {
        $penerbitansertifikat = Penerbitansertifikat::with('client')->where('tgl_kadaluarsasertifikat', '>=', date('Y-m-d'))->get();
        foreach ($penerbitansertifikat as $item) {
            $tgl_expired = $item->tgl_kadaluarsasertifikat;
            $date1 = date_create(date('Y-m-d', strtotime($tgl_expired))); //mis. tgl chekin
            $date2 = date_create(date('Y-m-d')); //mis. tgl chekout
            $diff = date_diff($date1, $date2); //menyimpan didalam fungsi date_diff
            $jumlah_hari = $diff->format("%d%"); //menampilkan jumlah hari

            if ($jumlah_hari == 60) {
                $results[] = [
                    'expired' => 60,
                    'data' => $item
                ];
            } else if ($jumlah_hari == 30) {
                $results[] = [
                    'expired' => 30,
                    'data' => $item
                ];
            } else if ($jumlah_hari == 14) {
                $results[] = [
                    'expired' => 14,
                    'data' => $item
                ];
            }
        }

        return $results;
    }
}
