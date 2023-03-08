<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DaftarhadirapiController extends Controller
{
    public function show($id)
    {
        $log = \App\Models\Logawalcertification::where('client_id', $id)->get();
        $permohonan = \App\Models\Permohonanclient::where('client_id', $id)->first();
        $kajian = \App\Models\Kajianclient::where('client_id', $id)->first();
        $data = [
            'log' => $log,
            'permohonan' => $permohonan,
            'kajian' => $kajian,
        ];
        return response()->json($data);
    }
}
