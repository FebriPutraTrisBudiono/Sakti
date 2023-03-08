<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Level;
use App\Models\Client;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Kajianclient;
use Illuminate\Http\Request;
use App\Models\Rencanaclient;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Perjanjianclient;
use App\Models\permohonansertifikasi;
use App\Models\Stage1checkaudit;
use App\Models\Stage2checkaudit;
use App\Models\Stage2laporanaudit;
use App\Models\Stage2rencanaaudit;
use App\Http\Controllers\Controller;
use App\Mail\Status;
use App\Mail\Statusupdate;
use App\Models\Logawalcertification;
use App\Models\Stage1kajiantimaudit;
use Illuminate\Support\Facades\Mail;
use App\Models\Stage2daftarhadiraudit;
use App\Models\Stage2temuanverifcation;
use Illuminate\Support\Facades\Storage;
use App\Models\Stage1penunjukantimaudit;
use App\Models\Memopenerbitansertifikasi;
use App\Models\Permohonan;
use App\Models\Stage2ketidaksesuaianpage;
use App\Models\Reviewkeputusansertifikasi;
use App\Models\Stage2surveikepuasancustomer;
use App\Models\User;
use App\Models\Listpermohonan;

class ClientController extends Controller
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

        $coba = Stage1penunjukantimaudit::latest()->paginate(100);
        $auditor_data = [];
        foreach ($coba as $item) {
            if (auth()->user()->id == $item->nama_auditor || auth()->user()->id == $item->nama_auditor2 || auth()->user()->id == $item->nama_auditor3) {
                $auditor_data[] = $item;
            }
        }

        $auditor = [];
        $temp = '';
        for ($i = 0; $i < count($auditor_data); $i++) {
            if ($temp == '') {
                $temp = $auditor_data[$i];
                $auditor[] = $auditor_data[$i];
            } else if ($temp['client_id'] != $auditor_data[$i]->client_id) {
                $temp = $auditor_data[$i];
                $auditor[] = $auditor_data[$i];
            }
        }
        $client_data = Client::with([
            'user',
            'service'
        ])
            ->whereRelation('user', 'status', '=', 1)
            ->filter(request(['clientid', 'service', 'user', 'startdate', 'enddate', 'status']))
            ->orderBy('created_at', 'DESC')
            ->paginate(100);

        return view('dashboard.clients', [
            'title_bar' => auth()->user()->level_id == 2 ? 'Permohonan Anda' : 'Client',
            'users'     => User::where('level_id', 2)->where('status', 1)->get(),
            'clients'   => $client_data,
            'stage1penunjukantimaudit' => Stage1penunjukantimaudit::latest()->paginate(100),
            'services'  => Service::get(),
            'roles'     => $roles,
            'bagian'    => $bagian,
            'auditor'   => $auditor,
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
        $data = $request->validate([
            'user_id' => 'required',
            'service_id' => 'required',
        ]);

        $service = Service::find($request->service_id);

        $last = Client::orderBy('id', 'DESC')->get();
        $nomor = '';
        foreach ($last as $item) {
            if ($item->nomor_client != '') {
                $urutan = (int) substr($item->nomor_client, 0, 7);
                $urutan++;
                $nomor = sprintf("%07s", $urutan);
                break;
            } else {
                $nomor = '0000001';
                break;
            }
        }

        $data['nomor_client'] = $nomor;
        $data['idclient'] = $service->service_code . '-' . $nomor;
        $client = Client::create($data);

        $listpermohonan['client_id'] = $client->id;
        $listpermohonan['proses_sertifikasi'] = $service->name;
        $listpermohonan['slug'] = 'sertifikasi_awal';

        Listpermohonan::create($listpermohonan);

        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        $listpermohonan = Listpermohonan::where('client_id', $client->id)->orderBy('id', 'DESC')->get();
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);

        return view('dashboard.clientshows', [
            'title_bar' => 'Daftar Permohonan Client',
            'client'    => $client,
            'listpermohonan' => $listpermohonan,
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        Client::destroy($client->id);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil dihapus!</div>');
    }

    public function confirmation(Client $client, Request $request)
    {
        $data = $request->validate([
            'status' => 'required',
        ]);
        $data['dipending_keterangan'] = $request->dipending_keterangan;

        if ($client->status_sertifikasi == 1) {
            permohonansertifikasi::where('client_id', $client->id)->update($data);
            $log = 'Permohonan Sertifikasi';
            $clientdata = [
                'user' => $client->user,
                'client' => $client,
                'log' => $log,
                'status' => $request->status,
                'dipending_keterangandata' => $client->permohonansertifikasi->dipending_keterangan ?? '',
                'dipending_keterangan' => $request->dipending_keterangan ?? '',
            ];
            Mail::to($client->user->email)->send(new Statusupdate($clientdata));
        } elseif ($client->status_sertifikasi == 2) {
            Kajianclient::where('client_id', $client->id)->update($data);
            $log = 'Kajian Permohonan';
            $clientdata = [
                'user' => $client->user,
                'client' => $client,
                'log' => $log,
                'status' => $request->status,
                'dipending_keterangandata' => $client->kajianclient->dipending_keterangan ?? '',
                'dipending_keterangan' => $request->dipending_keterangan ?? '',
            ];
            Mail::to($client->user->email)->send(new Statusupdate($clientdata));
        } elseif ($client->status_sertifikasi == 3) {
            Perjanjianclient::where('client_id', $client->id)->update($data);
            $log = 'Kontrak Sertifikasi';
            $clientdata = [
                'user' => $client->user,
                'client' => $client,
                'log' => $log,
                'status' => $request->status,
                'dipending_keterangandata' => $client->perjanjianclient->dipending_keterangan ?? '',
                'dipending_keterangan' => $request->dipending_keterangan ?? '',
            ];
            Mail::to($client->user->email)->send(new Statusupdate($clientdata));
        } elseif ($client->status_sertifikasi == 4) {
            Rencanaclient::where('client_id', $client->id)->update($data);
            $log = 'Rencana Siklus Sertifikasi';
            $clientdata = [
                'user' => $client->user,
                'client' => $client,
                'log' => $log,
                'status' => $request->status,
                'dipending_keterangandata' => $client->rencanaclient->dipending_keterangan ?? '',
                'dipending_keterangan' => $request->dipending_keterangan ?? '',
            ];
            Mail::to($client->user->email)->send(new Statusupdate($clientdata));
        } elseif ($client->status_sertifikasi == 5) {
            Stage1kajiantimaudit::where('client_id', $client->id)->update($data);
            $log = 'Stage I Kajian Tim Audit';
            $clientdata = [
                'user' => $client->user,
                'client' => $client,
                'log' => $log,
                'status' => $request->status,
                'dipending_keterangandata' => $client->stage1kajiantimaudit->dipending_keterangan ?? '',
                'dipending_keterangan' => $request->dipending_keterangan ?? '',
            ];
            Mail::to($client->user->email)->send(new Statusupdate($clientdata));
        } elseif ($client->status_sertifikasi == 6) {
            Stage1penunjukantimaudit::where('client_id', $client->id)->update($data);
            $log = 'Stage I Penunjukan Tim Audit';
            $clientdata = [
                'user' => $client->user,
                'client' => $client,
                'log' => $log,
                'status' => $request->status,
                'dipending_keterangandata' => $client->stage1penunjukantimaudit->dipending_keterangan ?? '',
                'dipending_keterangan' => $request->dipending_keterangan ?? '',
            ];
            Mail::to($client->user->email)->send(new Statusupdate($clientdata));
        } elseif ($client->status_sertifikasi == 7) {
            Stage1checkaudit::where('client_id', $client->id)->update($data);
            $log = 'Stage I Check List Audit Stage I';
            $clientdata = [
                'user' => $client->user,
                'client' => $client,
                'log' => $log,
                'status' => $request->status,
                'dipending_keterangandata' => $client->stage1checkaudit->dipending_keterangan ?? '',
                'dipending_keterangan' => $request->dipending_keterangan ?? '',
            ];
            Mail::to($client->user->email)->send(new Statusupdate($clientdata));
        } elseif ($client->status_sertifikasi == 8) {
            Stage2rencanaaudit::where('client_id', $client->id)->update($data);
            $log = 'Stage II Rencana Audit';
            $clientdata = [
                'user' => $client->user,
                'client' => $client,
                'log' => $log,
                'status' => $request->status,
                'dipending_keterangandata' => $client->stage2rencanaaudit->dipending_keterangan ?? '',
                'dipending_keterangan' => $request->dipending_keterangan ?? '',
            ];
            Mail::to($client->user->email)->send(new Statusupdate($clientdata));
        } elseif ($client->status_sertifikasi == 9) {
            Stage2checkaudit::where('client_id', $client->id)->update($data);
            $log = 'Stage II CheckList Audit';
            $clientdata = [
                'user' => $client->user,
                'client' => $client,
                'log' => $log,
                'status' => $request->status,
                'dipending_keterangandata' => $client->stage2checkaudit->dipending_keterangan ?? '',
                'dipending_keterangan' => $request->dipending_keterangan ?? '',
            ];
            Mail::to($client->user->email)->send(new Statusupdate($clientdata));
        } elseif ($client->status_sertifikasi == 10) {
            Stage2daftarhadiraudit::where('client_id', $client->id)->update($data);
            $log = 'Stage II Daftar Hadir Audit';
            $clientdata = [
                'user' => $client->user,
                'client' => $client,
                'log' => $log,
                'status' => $request->status,
                'dipending_keterangandata' => $client->stage2daftarhadiraudit->dipending_keterangan ?? '',
                'dipending_keterangan' => $request->dipending_keterangan ?? '',
            ];
            Mail::to($client->user->email)->send(new Statusupdate($clientdata));
        } elseif ($client->status_sertifikasi == 11) {
            Stage2laporanaudit::where('client_id', $client->id)->update($data);
            $log = 'Stage II Laporan Audit';
            $clientdata = [
                'user' => $client->user,
                'client' => $client,
                'log' => $log,
                'status' => $request->status,
                'dipending_keterangandata' => $client->stage2laporanaudit->dipending_keterangan ?? '',
                'dipending_keterangan' => $request->dipending_keterangan ?? '',
            ];
            Mail::to($client->user->email)->send(new Statusupdate($clientdata));
        } elseif ($client->status_sertifikasi == 12) {
            Stage2ketidaksesuaianpage::where('client_id', $client->id)->update($data);
            $log = 'Stage II Lembar Ketidaksesuaian';
            $clientdata = [
                'user' => $client->user,
                'client' => $client,
                'log' => $log,
                'status' => $request->status,
                'dipending_keterangandata' => $client->stage2ketidaksesuaianpage->dipending_keterangan ?? '',
                'dipending_keterangan' => $request->dipending_keterangan ?? '',
            ];
            Mail::to($client->user->email)->send(new Statusupdate($clientdata));
        } elseif ($client->status_sertifikasi == 13) {
            Stage2surveikepuasancustomer::where('client_id', $client->id)->update($data);
            $log = 'Stage II Survei Ketidakpuasan Pelanggan';
            $clientdata = [
                'user' => $client->user,
                'client' => $client,
                'log' => $log,
                'status' => $request->status,
                'dipending_keterangandata' => $client->stage2surveikepuasancustomer->dipending_keterangan ?? '',
                'dipending_keterangan' => $request->dipending_keterangan ?? '',
            ];
            Mail::to($client->user->email)->send(new Statusupdate($clientdata));
        } elseif ($client->status_sertifikasi == 14) {
            Stage2temuanverifcation::where('client_id', $client->id)->update($data);
            $log = 'Stage II Verifikasi Temuan';
            $clientdata = [
                'user' => $client->user,
                'client' => $client,
                'log' => $log,
                'status' => $request->status,
                'dipending_keterangandata' => $client->stage2temuanverication->dipending_keterangan ?? '',
                'dipending_keterangan' => $request->dipending_keterangan ?? '',
            ];
            Mail::to($client->user->email)->send(new Statusupdate($clientdata));
        } elseif ($client->status_sertifikasi == 15) {
            Reviewkeputusansertifikasi::where('client_id', $client->id)->update($data);
            $log = 'Review Keputusan Sertifikasi';
            $clientdata = [
                'user' => $client->user,
                'client' => $client,
                'log' => $log,
                'status' => $request->status,
                'dipending_keterangandata' => $client->reviewkeputusansertifikasi->dipending_keterangan ?? '',
                'dipending_keterangan' => $request->dipending_keterangan ?? '',
            ];
            Mail::to($client->user->email)->send(new Statusupdate($clientdata));
        } elseif ($client->status_sertifikasi == 16) {
            Memopenerbitansertifikasi::where('client_id', $client->id)->update($data);
            $log = 'Memo Penerbitan Sertifikasi';
            $clientdata = [
                'user' => $client->user,
                'client' => $client,
                'log' => $log,
                'status' => $request->status,
                'dipending_keterangandata' => $client->memopenerbitansertifikasi->dipending_keterangan ?? '',
                'dipending_keterangan' => $request->dipending_keterangan ?? '',
            ];
            Mail::to($client->user->email)->send(new Statusupdate($clientdata));
        }

        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function showconfirmation($id)
    {
        $client = Client::with(['user', 'permohonansertifikasi', 'kajianclient', 'perjanjianclient'])->firstWhere('id', $id);
        return response()->json($client);
    }

    public function deleteproses(Listpermohonan $listpermohonan)
    {
        Listpermohonan::destroy($listpermohonan->id);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil dihapus!</div>');
    }
}
