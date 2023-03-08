<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Client;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\Listpermohonan;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $client_data = Client::with([
            'user',
            'service'
        ])
            ->whereRelation('user', 'status', '=', 1)
            ->filter(request(['clientid', 'service', 'user', 'startdate', 'enddate', 'status']))
            ->orderBy('created_at', 'DESC')
            ->paginate(100);

        $setting = Setting::where('id', 1)->first();
        return view('frontend.home', [
            'title_bar' => $setting->name,
            'clients'   => false,
            'setting'   => $setting
        ]);
    }

    public function show()
    {
        if (request(['clientid'])['clientid'] != '') {
            $client_data = Client::with([
                'user',
                'service'
            ])
                ->whereRelation('user', 'status', '=', 1)
                ->filter(request(['clientid', 'service', 'user', 'startdate', 'enddate', 'status']))
                ->orderBy('created_at', 'DESC')
                ->paginate(100);
        } else {
            $client_data = false;
        }

        $setting = Setting::where('id', 1)->first();
        return view('frontend.home', [
            'title_bar' => $setting->name,
            'clients'   => $client_data,
            'setting'   => $setting
        ]);
    }

    public function listpermohonan(Client $client)
    {
        $listpermohonan = Listpermohonan::where('client_id', $client->id)->orderBy('id', 'DESC')->get();

        return view('frontend.tracking', [
            'title_bar'         => 'Daftar Permohonan Client',
            'client'            => $client,
            'listpermohonan'    => $listpermohonan,
        ]);
    }
}
