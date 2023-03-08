<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Mail\NotifikasiExpired;
use Illuminate\Mail\Attachment;
use App\Models\Lognotifikasiexpired;
use App\Models\Penerbitansertifikat;
use Illuminate\Support\Facades\Mail;

class LognotifikasiexpiredController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lognotifikasiexpired = Lognotifikasiexpired::with('penerbitansertifikat')->orderBy('id', 'DESC')->latest()->paginate(100);
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);
        // dd($lognotifikasiexpired);
        return view('dashboard.lognotifikasiexpired', [
            'title_bar' => 'Log Notifikasi Expired',
            'lognotifikasiexpired' => $lognotifikasiexpired,
            'roles' => $roles,
        ]);
    }

    public function lognotifikasiexpired()
    {
        $penerbitansertifikat = Penerbitansertifikat::with('client', 'listpermohonan')->where('tgl_kadaluarsasertifikat', '>=', date('Y-m-d'))->orderBy('id', 'DESC')->get();
        $setting = Setting::firstWhere('id', 1);
        foreach ($penerbitansertifikat as $item) {
            $tgl_expired = $item->tgl_kadaluarsasertifikat;
            $date1 = date_create(date('Y-m-d', strtotime($tgl_expired))); //mis. tgl chekin
            $date2 = date_create(date('Y-m-d')); //mis. tgl chekout
            $diff = date_diff($date1, $date2); //menyimpan didalam fungsi date_diff
            $jumlah_hari = $diff->format("%d%"); //menampilkan jumlah hari

            // get email
            $email = 'febriarc@gmail.com';

            $data = [
                'client_id' => $item->client_id,
                'penerbitsertifikat_id' => $item->id,
                'listpermohonan_id' => $item->listpermohonan->id,
                'keterangan' => $item->client->service->name . ' akan expired pada ' . $jumlah_hari . ' hari'
            ];

            $dataemail = [
                'client' => $item->client->user->name,
                'jumlah_hari' => $jumlah_hari,
                'listpermohonan' => $item->listpermohonan->proses_sertifikasi,
                'tgl_expired' => $item->tgl_kadaluarsasertifikat,
            ];

            $pdf = public_path('storage/' . $setting->uploadberkas);

            if ($jumlah_hari == 60) {
                $data['status'] = 1;
                Mail::send('email.notifikasiexpired', $dataemail, function ($message) use ($dataemail, $pdf, $email, $setting) {
                    $message->to($email)
                        ->cc($setting->email)
                        ->subject($dataemail['client'], $dataemail['jumlah_hari'], $dataemail['listpermohonan'], $dataemail['tgl_expired'])
                        ->attach($pdf, array(
                            'as' => 'Laporan.pdf',
                            'mime' => 'application/pdf'
                        ));
                });
                Lognotifikasiexpired::create($data);
            } else if ($jumlah_hari == 30) {
                $data['status'] = 1;
                Mail::send('email.notifikasiexpired', $dataemail, function ($message) use ($dataemail, $pdf, $email, $setting) {
                    $message->to($email)
                        ->cc($setting->email)
                        ->subject($dataemail['client'], $dataemail['jumlah_hari'], $dataemail['listpermohonan'], $dataemail['tgl_expired'])
                        ->attach($pdf, array(
                            'as' => 'Laporan.pdf',
                            'mime' => 'application/pdf'
                        ));
                });
                Lognotifikasiexpired::create($data);
            } else if ($jumlah_hari == 14) {
                $data['status'] = 1;
                Mail::send('email.notifikasiexpired', $dataemail, function ($message) use ($dataemail, $pdf, $email, $setting) {
                    $message->to($email)
                        ->cc($setting->email)
                        ->subject($dataemail['client'], $dataemail['jumlah_hari'], $dataemail['listpermohonan'], $dataemail['tgl_expired'])
                        ->attach($pdf, array(
                            'as' => 'Laporan.pdf',
                            'mime' => 'application/pdf'
                        ));
                });
                Lognotifikasiexpired::create($data);
            } else if ($jumlah_hari == 0) {
                $data['status'] = 0;
                Mail::send('email.notifikasiexpired', $dataemail, function ($message) use ($dataemail, $pdf, $email, $setting) {
                    $message->to($email)
                        ->cc($setting->email)
                        ->subject($dataemail['client'], $dataemail['jumlah_hari'], $dataemail['listpermohonan'], $dataemail['tgl_expired'])
                        ->attach($pdf, array(
                            'as' => 'Laporan.pdf',
                            'mime' => 'application/pdf'
                        ));
                });
                Lognotifikasiexpired::create($data);
            }
        }

        return true;
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
}
