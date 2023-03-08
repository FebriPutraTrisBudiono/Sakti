<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Listpermohonan;
use App\Models\Log1surveilance;
use App\Models\Log2surveilance;
use App\Models\Perjanjianclient;
use App\Models\Logawalcertification;
use App\Models\Logresertifikasi;
use App\Models\Permohonansertifikasi;

class LogapiController extends Controller
{
    public function show($id)
    {
        $log = Logawalcertification::where('client_id', $id)->get();
        $client = Client::with(['user'])->where('id', $id)->first();
        $status = Logawalcertification::where('client_id', $id)->orderBy('id', 'DESC')->first();

        $listpermohonan_data = Listpermohonan::where('client_id', $client->id)->orderBy('id', 'DESC')->get();
        $sertifikasiawal = [];
        $surveilance1 = [];
        $surveilance2 = [];
        $resertifikasi = [];
        foreach ($listpermohonan_data as $item) {
            if ($item->proses_sertifikasi == 'Sertifikasi Awal ISO 9001/21001') {
                $sertifikasiawal[] = $item;
            } elseif ($item->proses_sertifikasi == 'Surveilance I') {
                $surveilance1[] = $item;
            } elseif ($item->proses_sertifikasi == 'Surveilance II') {
                $surveilance2[] = $item;
            } elseif ($item->proses_sertifikasi == 'Re Sertifikasi') {
                $resertifikasi[] = $item;
            }
        }

        $data = [
            'log'               => $log,
            'status'            => $status,
            'client'            => $client,
            'sertifikasiawal'   => $sertifikasiawal ? $sertifikasiawal[0] : '',
            'surveilance1'      => $surveilance1 ? $surveilance1[0] : '',
            'surveilance2'      => $surveilance2 ? $surveilance2[0] : '',
            'resertifikasi'     => $resertifikasi ? $resertifikasi[0] : '',
            'name_sertifikasiawal'   => 'Sertifikasi Awal ISO 9001/21001',
            'name_surveilance1'      => 'Surveilance I',
            'name_surveilance2'      => 'Surveilance II',
            'name_resertifikasi'     => 'Re Sertifikasi',
        ];

        return response()->json($data);
    }

    public function status($id, $listpermohonan)
    {
        $log = Logawalcertification::where('client_id', $id)->get();
        $client = Client::with(['user'])->where('id', $id)->first();
        $status = Logawalcertification::where('client_id', $id)->orderBy('id', 'DESC')->first();

        $log = Logawalcertification::where('client_id', $id)->get();
        $client = Client::with(['user'])->where('id', $id)->first();
        $permohonansertifikasi = Permohonansertifikasi::where('client_id', $id)->get();
        $perjanjianclient = Perjanjianclient::where('client_id', $id)->get();

        $data = [
            'log'                           => $log,
            'status'                        => $status,
            'client'                        => $client,
            'permohonansertifikasi'         => $permohonansertifikasi->where('listpermohonan_id', $listpermohonan)->first(),
            'perjanjianclient'              => $perjanjianclient->where('listpermohonan_id', $listpermohonan)->first(),
        ];
        return response()->json($data);
    }

    public function log($id, $logid)
    {
        $client = Client::with(['user'])->where('id', $id)->first();
        $status = Logawalcertification::where('client_id', $id)->orderBy('id', 'DESC')->first();

        $listpermohonan_id = Listpermohonan::where('client_id', $client->id)->orderBy('id', 'DESC')->get();

        $sertifikasiawal_data = [];
        $surveilance1_data = [];
        $surveilance2_data = [];
        $resertifikasi_data = [];
        foreach ($listpermohonan_id as $item) {
            if ($item->proses_sertifikasi == 'Sertifikasi Awal ISO 9001/21001') {
                $sertifikasiawal_data[] = $item;
            } elseif ($item->proses_sertifikasi == 'Surveilance I') {
                $surveilance1_data[] = $item;
            } elseif ($item->proses_sertifikasi == 'Surveilance II') {
                $surveilance2_data[] = $item;
            } elseif ($item->proses_sertifikasi == 'Re Sertifikasi') {
                $resertifikasi_data[] = $item;
            }
        }

        $sertifikasiawal = $sertifikasiawal_data[0] ?? '';
        $surveilance1 = $surveilance1_data[0] ?? '';
        $surveilance2 = $surveilance2_data[0] ?? '';
        $resertifikasi = $resertifikasi_data[0] ?? '';

        $logsertifikasiawal = $sertifikasiawal ? Logawalcertification::where('listpermohonan_id', $sertifikasiawal->id)->get() : '';
        $log1surveilance = $surveilance1 ? Log1surveilance::where('listpermohonan_id', $surveilance1->id)->get() : '';
        $log2surveilance = $surveilance2 ? Log2surveilance::where('listpermohonan_id', $surveilance2->id)->get() : '';
        $logresertifikasi = $resertifikasi ? Logresertifikasi::where('listpermohonan_id', $resertifikasi->id)->get() : '';

        if ($logsertifikasiawal) {
            $logsertifikasiawal_data = [];
            foreach ($logsertifikasiawal as $row) {
                if ($row->tahapan_sertifikasi == 'Permohonan Sertifikasi' || $row->tahapan_sertifikasi == 'Kajian Permohonan' || $row->tahapan_sertifikasi == 'Perjanjian Sertifikasi' || $row->tahapan_sertifikasi == 'Stage I Check List Audit Stage I' || $row->tahapan_sertifikasi == 'Stage II Rencana Audit' || $row->tahapan_sertifikasi == 'Stage II Laporan Audit' || $row->tahapan_sertifikasi == 'Stage II Lembar Ketidaksesuaian' || $row->tahapan_sertifikasi == 'Stage II Verifikasi Temua' || $row->tahapan_sertifikasi == 'Review Keputusan Sertifikasi' || $row->tahapan_sertifikasi == 'Penerbitan Sertifikat') {
                    $logsertifikasiawal_data[] = $row;
                }
            }
        }

        if ($log1surveilance) {
            $log1surveilance_data = [];
            foreach ($log1surveilance as $row) {
                if ($row->tahapan_sertifikasi == 'Audit - Rencana Audit' || $row->tahapan_sertifikasi == 'Audit - Laporan Audit' || $row->tahapan_sertifikasi == 'Audit - Lembar Ketidaksesuaian' || $row->tahapan_sertifikasi == 'Audit - Survei Kepuasan Pelanggan' || $row->tahapan_sertifikasi == 'Keputusan Sertifikasi - Verifikasi Temuan' || $row->tahapan_sertifikasi == 'Surat Keputusan Surveilance 1') {
                    $log1surveilance_data[] = $row;
                }
            }
        }

        if ($log2surveilance) {
            $log2surveilance_data = [];
            foreach ($log2surveilance as $row) {
                if ($row->tahapan_sertifikasi == 'Audit - Rencana Audit' || $row->tahapan_sertifikasi == 'Audit - Laporan Audit' || $row->tahapan_sertifikasi == 'Audit - Lembar Ketidaksesuaian' || $row->tahapan_sertifikasi == 'Audit - Survei Kepuasan Pelanggan' || $row->tahapan_sertifikasi == 'Keputusan Sertifikasi - Verifikasi Temuan' || $row->tahapan_sertifikasi == 'Surat Keputusan Surveilance 2') {
                    $log2surveilance_data[] = $row;
                }
            }
        }

        if ($logresertifikasi) {
            $logresertifikasi_data = [];
            foreach ($logresertifikasi as $row) {
                if ($row->tahapan_sertifikasi == 'Permohonan Sertifikasi' || $row->tahapan_sertifikasi == 'Kajian Permohonan' || $row->tahapan_sertifikasi == 'Perjanjian Sertifikasi' || $row->tahapan_sertifikasi == 'Stage I Check List Audit Stage I' || $row->tahapan_sertifikasi == 'Stage II Rencana Audit' || $row->tahapan_sertifikasi == 'Stage II Laporan Audit' || $row->tahapan_sertifikasi == 'Stage II Lembar Ketidaksesuaian' || $row->tahapan_sertifikasi == 'Stage II Verifikasi Temua' || $row->tahapan_sertifikasi == 'Review Keputusan Sertifikasi' || $row->tahapan_sertifikasi == 'Penerbitan Sertifikat') {
                    $logresertifikasi_data[] = $row;
                }
            }
        }

        if ($logid == 'sertifikasi_awal') {
            $data = [
                'logsertifikasiawal'            => $logsertifikasiawal_data ?? '',
                'status'                        => $status,
                'client'                        => $client,
                'permohonansertifikasi'         => $logsertifikasiawal ? $client->permohonansertifikasi_data($sertifikasiawal->id)->first() : '',
                'kajianclient'                  => $logsertifikasiawal ? $client->kajianclient_data($sertifikasiawal->id)->first() : '',
                'perjanjianclient'              => $logsertifikasiawal ? $client->perjanjianclient_data($sertifikasiawal->id)->first() : '',
                'rencanaclient'                 => $logsertifikasiawal ? $client->rencanaclient_data($sertifikasiawal->id)->first() : '',
                'stage1kajiantimaudit'          => $logsertifikasiawal ? $client->stage1kajiantimaudit_data($sertifikasiawal->id)->first() : '',
                'stage1penunjukantimaudit'      => $logsertifikasiawal ? $client->stage1penunjukantimaudit_data($sertifikasiawal->id)->first() : '',
                'stage1checkaudit'              => $logsertifikasiawal ? $client->stage1checkaudit_data($sertifikasiawal->id)->first() : '',
                'stage2rencanaaudit'            => $logsertifikasiawal ? $client->stage2rencanaaudit_data($sertifikasiawal->id)->first() : '',
                'stage2checkaudit'              => $logsertifikasiawal ? $client->stage2checkaudit_data($sertifikasiawal->id)->first() : '',
                'stage2daftarhadiraudit'        => $logsertifikasiawal ? $client->stage2daftarhadiraudit_data($sertifikasiawal->id)->first() : '',
                'stage2laporanaudit'            => $logsertifikasiawal ? $client->stage2laporanaudit_data($sertifikasiawal->id)->first() : '',
                'stage2ketidaksesuaianpage'     => $logsertifikasiawal ? $client->stage2ketidaksesuaianpage_data($sertifikasiawal->id)->first() : '',
                'stage2surveikepuasancustomer'  => $logsertifikasiawal ? $client->stage2surveikepuasancustomer_data($sertifikasiawal->id)->first() : '',
                'stage2temuanverication'        => $logsertifikasiawal ? $client->stage2temuanverifcation_data($sertifikasiawal->id)->first() : '',
                'reviewkeputusansertifikasi'    => $logsertifikasiawal ? $client->reviewkeputusansertifikasi_data($sertifikasiawal->id)->first() : '',
                'memopenerbitansertifikasi'     => $logsertifikasiawal ? $client->memopenerbitansertifikasi_data($sertifikasiawal->id)->first() : '',
                'penerbitansertifikat'          => $logsertifikasiawal ? $client->penerbitansertifikat_data($sertifikasiawal->id)->first() : '',
            ];
        } else if ($logid == 'surveilance1') {
            $data = [
                'log1surveilance'               => $log1surveilance_data ?? '',
                'status'                        => $status,
                'client'                        => $client,
                'stage1kajiantimaudit'          => $log1surveilance ? $client->stage1kajiantimaudit_data($surveilance1->id)->first() : '',
                'stage1penunjukantimaudit'      => $log1surveilance ? $client->stage1penunjukantimaudit_data($surveilance1->id)->first() : '',
                'stage2rencanaaudit'            => $log1surveilance ? $client->stage2rencanaaudit_data($surveilance1->id)->first() : '',
                'stage2checkaudit'              => $log1surveilance ? $client->stage2checkaudit_data($surveilance1->id)->first() : '',
                'stage2daftarhadiraudit'        => $log1surveilance ? $client->stage2daftarhadiraudit_data($surveilance1->id)->first() : '',
                'stage2laporanaudit'            => $log1surveilance ? $client->stage2laporanaudit_data($surveilance1->id)->first() : '',
                'stage2ketidaksesuaianpage'     => $log1surveilance ? $client->stage2ketidaksesuaianpage_data($surveilance1->id)->first() : '',
                'stage2surveikepuasancustomer'  => $log1surveilance ? $client->stage2surveikepuasancustomer_data($surveilance1->id)->first() : '',
                'stage2temuanverication'        => $log1surveilance ? $client->stage2temuanverifcation_data($surveilance1->id)->first() : '',
                'penerbitansertifikat'          => $log1surveilance ? $client->penerbitansertifikat_data($surveilance1->id)->first() : '',
            ];
        } else if ($logid == 'surveilance2') {
            $data = [
                'log2surveilance'               => $log2surveilance_data ?? '',
                'status'                        => $status,
                'client'                        => $client,
                'stage1kajiantimaudit'          => $log2surveilance ? $client->stage1kajiantimaudit_data($surveilance2->id)->first() : '',
                'stage1penunjukantimaudit'      => $log2surveilance ? $client->stage1penunjukantimaudit_data($surveilance2->id)->first() : '',
                'stage2rencanaaudit'            => $log2surveilance ? $client->stage2rencanaaudit_data($surveilance2->id)->first() : '',
                'stage2checkaudit'              => $log2surveilance ? $client->stage2checkaudit_data($surveilance2->id)->first() : '',
                'stage2daftarhadiraudit'        => $log2surveilance ? $client->stage2daftarhadiraudit_data($surveilance2->id)->first() : '',
                'stage2laporanaudit'            => $log2surveilance ? $client->stage2laporanaudit_data($surveilance2->id)->first() : '',
                'stage2ketidaksesuaianpage'     => $log2surveilance ? $client->stage2ketidaksesuaianpage_data($surveilance2->id)->first() : '',
                'stage2surveikepuasancustomer'  => $log2surveilance ? $client->stage2surveikepuasancustomer_data($surveilance2->id)->first() : '',
                'stage2temuanverication'        => $log2surveilance ? $client->stage2temuanverifcation_data($surveilance2->id)->first() : '',
                'penerbitansertifikat'          => $log2surveilance ? $client->penerbitansertifikat_data($surveilance2->id)->first() : '',
            ];
        } else if ($logid == 'resertifikasi') {
            $data = [
                'logresertifikasi'              => $logresertifikasi_data ?? '',
                'status'                        => $status,
                'client'                        => $client,
                'permohonansertifikasi'         => $logresertifikasi ? $client->permohonansertifikasi_data($resertifikasi->id)->first() : '',
                'kajianclient'                  => $logresertifikasi ? $client->kajianclient_data($resertifikasi->id)->first() : '',
                'perjanjianclient'              => $logresertifikasi ? $client->perjanjianclient_data($resertifikasi->id)->first() : '',
                'rencanaclient'                 => $logresertifikasi ? $client->rencanaclient_data($resertifikasi->id)->first() : '',
                'stage1kajiantimaudit'          => $logresertifikasi ? $client->stage1kajiantimaudit_data($resertifikasi->id)->first() : '',
                'stage1penunjukantimaudit'      => $logresertifikasi ? $client->stage1penunjukantimaudit_data($resertifikasi->id)->first() : '',
                'stage1checkaudit'              => $logresertifikasi ? $client->stage1checkaudit_data($resertifikasi->id)->first() : '',
                'stage2rencanaaudit'            => $logresertifikasi ? $client->stage2rencanaaudit_data($resertifikasi->id)->first() : '',
                'stage2checkaudit'              => $logresertifikasi ? $client->stage2checkaudit_data($resertifikasi->id)->first() : '',
                'stage2daftarhadiraudit'        => $logresertifikasi ? $client->stage2daftarhadiraudit_data($resertifikasi->id)->first() : '',
                'stage2laporanaudit'            => $logresertifikasi ? $client->stage2laporanaudit_data($resertifikasi->id)->first() : '',
                'stage2ketidaksesuaianpage'     => $logresertifikasi ? $client->stage2ketidaksesuaianpage_data($resertifikasi->id)->first() : '',
                'stage2surveikepuasancustomer'  => $logresertifikasi ? $client->stage2surveikepuasancustomer_data($resertifikasi->id)->first() : '',
                'stage2temuanverication'        => $logresertifikasi ? $client->stage2temuanverifcation_data($resertifikasi->id)->first() : '',
                'reviewkeputusansertifikasi'    => $logresertifikasi ? $client->reviewkeputusansertifikasi_data($resertifikasi->id)->first() : '',
                'memopenerbitansertifikasi'     => $logresertifikasi ? $client->memopenerbitansertifikasi_data($resertifikasi->id)->first() : '',
                'penerbitansertifikat'          => $logresertifikasi ? $client->penerbitansertifikat_data($resertifikasi->id)->first() : '',
            ];
        }

        return response()->json($data);
    }

    public function clientlog($id, $listpermohonan)
    {
        $client = Client::with(['user'])->where('id', $id)->first();
        $status = Logawalcertification::where('client_id', $id)->orderBy('id', 'DESC')->first();

        $listpermohonan_id = Listpermohonan::where('id', $listpermohonan)->first();

        $sertifikasiawal_data = [];
        $surveilance1_data = [];
        $surveilance2_data = [];
        $resertifikasi_data = [];

        if ($listpermohonan_id->slug == 'sertifikasi_awal') {
            $sertifikasiawal_data = $listpermohonan_id;
        } elseif ($listpermohonan_id->slug == 'surveilance1') {
            $surveilance1_data = $listpermohonan_id;
        } elseif ($listpermohonan_id->slug == 'surveilance2') {
            $surveilance2_data = $listpermohonan_id;
        } elseif ($listpermohonan_id->slug == 'resertifikasi') {
            $resertifikasi_data = $listpermohonan_id;
        }

        $sertifikasiawal = $sertifikasiawal_data ?? '';
        $surveilance1 = $surveilance1_data ?? '';
        $surveilance2 = $surveilance2_data ?? '';
        $resertifikasi = $resertifikasi_data ?? '';

        $logsertifikasiawal = $sertifikasiawal ? Logawalcertification::where('listpermohonan_id', $sertifikasiawal->id)->get() : '';
        $log1surveilance = $surveilance1 ? Log1surveilance::where('listpermohonan_id', $surveilance1->id)->get() : '';
        $log2surveilance = $surveilance2 ? Log2surveilance::where('listpermohonan_id', $surveilance2->id)->get() : '';
        $logresertifikasi = $resertifikasi ? Logresertifikasi::where('listpermohonan_id', $resertifikasi->id)->get() : '';

        if ($logsertifikasiawal) {
            $logsertifikasiawal_data = [];
            foreach ($logsertifikasiawal as $row) {
                if ($row->tahapan_sertifikasi == 'Permohonan Sertifikasi' || $row->tahapan_sertifikasi == 'Kajian Permohonan' || $row->tahapan_sertifikasi == 'Perjanjian Sertifikasi' || $row->tahapan_sertifikasi == 'Stage I Check List Audit Stage I' || $row->tahapan_sertifikasi == 'Stage II Rencana Audit' || $row->tahapan_sertifikasi == 'Stage II Laporan Audit' || $row->tahapan_sertifikasi == 'Stage II Lembar Ketidaksesuaian' || $row->tahapan_sertifikasi == 'Stage II Verifikasi Temua' || $row->tahapan_sertifikasi == 'Review Keputusan Sertifikasi' || $row->tahapan_sertifikasi == 'Penerbitan Sertifikat') {
                    $logsertifikasiawal_data[] = $row;
                }
            }
        }

        if ($log1surveilance) {
            $log1surveilance_data = [];
            foreach ($log1surveilance as $row) {
                if ($row->tahapan_sertifikasi == 'Audit - Rencana Audit' || $row->tahapan_sertifikasi == 'Audit - Laporan Audit' || $row->tahapan_sertifikasi == 'Audit - Lembar Ketidaksesuaian' || $row->tahapan_sertifikasi == 'Audit - Survei Kepuasan Pelanggan' || $row->tahapan_sertifikasi == 'Keputusan Sertifikasi - Verifikasi Temuan' || $row->tahapan_sertifikasi == 'Surat Keputusan Surveilance 1') {
                    $log1surveilance_data[] = $row;
                }
            }
        }

        if ($log2surveilance) {
            $log2surveilance_data = [];
            foreach ($log2surveilance as $row) {
                if ($row->tahapan_sertifikasi == 'Audit - Rencana Audit' || $row->tahapan_sertifikasi == 'Audit - Laporan Audit' || $row->tahapan_sertifikasi == 'Audit - Lembar Ketidaksesuaian' || $row->tahapan_sertifikasi == 'Audit - Survei Kepuasan Pelanggan' || $row->tahapan_sertifikasi == 'Keputusan Sertifikasi - Verifikasi Temuan' || $row->tahapan_sertifikasi == 'Surat Keputusan Surveilance 2') {
                    $log2surveilance_data[] = $row;
                }
            }
        }

        if ($logresertifikasi) {
            $logresertifikasi_data = [];
            foreach ($logresertifikasi as $row) {
                if ($row->tahapan_sertifikasi == 'Permohonan Sertifikasi' || $row->tahapan_sertifikasi == 'Kajian Permohonan' || $row->tahapan_sertifikasi == 'Perjanjian Sertifikasi' || $row->tahapan_sertifikasi == 'Stage I Check List Audit Stage I' || $row->tahapan_sertifikasi == 'Stage II Rencana Audit' || $row->tahapan_sertifikasi == 'Stage II Laporan Audit' || $row->tahapan_sertifikasi == 'Stage II Lembar Ketidaksesuaian' || $row->tahapan_sertifikasi == 'Stage II Verifikasi Temua' || $row->tahapan_sertifikasi == 'Review Keputusan Sertifikasi' || $row->tahapan_sertifikasi == 'Penerbitan Sertifikat') {
                    $logresertifikasi_data[] = $row;
                }
            }
        }

        if ($listpermohonan_id->slug == 'sertifikasi_awal') {
            $data = [
                'logsertifikasiawal'            => $logsertifikasiawal_data,
                'status'                        => $status,
                'client'                        => $client,
                'permohonansertifikasi'         => $client->permohonansertifikasi_data($sertifikasiawal->id)->first(),
                'kajianclient'                  => $client->kajianclient_data($sertifikasiawal->id)->first(),
                'perjanjianclient'              => $client->perjanjianclient_data($sertifikasiawal->id)->first(),
                'rencanaclient'                 => $client->rencanaclient_data($sertifikasiawal->id)->first(),
                'stage1kajiantimaudit'          => $client->stage1kajiantimaudit_data($sertifikasiawal->id)->first(),
                'stage1penunjukantimaudit'      => $client->stage1penunjukantimaudit_data($sertifikasiawal->id)->first(),
                'stage1checkaudit'              => $client->stage1checkaudit_data($sertifikasiawal->id)->first(),
                'stage2rencanaaudit'            => $client->stage2rencanaaudit_data($sertifikasiawal->id)->first(),
                'stage2checkaudit'              => $client->stage2checkaudit_data($sertifikasiawal->id)->first(),
                'stage2daftarhadiraudit'        => $client->stage2daftarhadiraudit_data($sertifikasiawal->id)->first(),
                'stage2laporanaudit'            => $client->stage2laporanaudit_data($sertifikasiawal->id)->first(),
                'stage2ketidaksesuaianpage'     => $client->stage2ketidaksesuaianpage_data($sertifikasiawal->id)->first(),
                'stage2surveikepuasancustomer'  => $client->stage2surveikepuasancustomer_data($sertifikasiawal->id)->first(),
                'stage2temuanverication'         => $client->stage2temuanverifcation_data($sertifikasiawal->id)->first(),
                'reviewkeputusansertifikasi'    => $client->reviewkeputusansertifikasi_data($sertifikasiawal->id)->first(),
                'memopenerbitansertifikasi'     => $client->memopenerbitansertifikasi_data($sertifikasiawal->id)->first(),
                'penerbitansertifikat'          => $client->penerbitansertifikat_data($sertifikasiawal->id)->first(),
            ];
        } else if ($listpermohonan_id->slug == 'surveilance1') {
            $data = [
                'log1surveilance'               => $log1surveilance_data,
                'status'                        => $status,
                'client'                        => $client,
                'stage1kajiantimaudit'          => $client->stage1kajiantimaudit_data($surveilance1->id)->first(),
                'stage1penunjukantimaudit'      => $client->stage1penunjukantimaudit_data($surveilance1->id)->first(),
                'stage2rencanaaudit'            => $client->stage2rencanaaudit_data($surveilance1->id)->first(),
                'stage2checkaudit'              => $client->stage2checkaudit_data($surveilance1->id)->first(),
                'stage2daftarhadiraudit'        => $client->stage2daftarhadiraudit_data($surveilance1->id)->first(),
                'stage2laporanaudit'            => $client->stage2laporanaudit_data($surveilance1->id)->first(),
                'stage2ketidaksesuaianpage'     => $client->stage2ketidaksesuaianpage_data($surveilance1->id)->first(),
                'stage2surveikepuasancustomer'  => $client->stage2surveikepuasancustomer_data($surveilance1->id)->first(),
                'stage2temuanverication'         => $client->stage2temuanverifcation_data($surveilance1->id)->first(),
                'penerbitansertifikat'          => $client->penerbitansertifikat_data($surveilance1->id)->first(),
            ];
        } else if ($listpermohonan_id->slug == 'surveilance2') {
            $data = [
                'log2surveilance'               => $log2surveilance_data,
                'status'                        => $status,
                'client'                        => $client,
                'stage1kajiantimaudit'          => $client->stage1kajiantimaudit_data($surveilance2->id)->first(),
                'stage1penunjukantimaudit'      => $client->stage1penunjukantimaudit_data($surveilance2->id)->first(),
                'stage2rencanaaudit'            => $client->stage2rencanaaudit_data($surveilance2->id)->first(),
                'stage2checkaudit'              => $client->stage2checkaudit_data($surveilance2->id)->first(),
                'stage2daftarhadiraudit'        => $client->stage2daftarhadiraudit_data($surveilance2->id)->first(),
                'stage2laporanaudit'            => $client->stage2laporanaudit_data($surveilance2->id)->first(),
                'stage2ketidaksesuaianpage'     => $client->stage2ketidaksesuaianpage_data($surveilance2->id)->first(),
                'stage2surveikepuasancustomer'  => $client->stage2surveikepuasancustomer_data($surveilance2->id)->first(),
                'stage2temuanverication'        => $client->stage2temuanverifcation_data($surveilance2->id)->first(),
                'penerbitansertifikat'          => $client->penerbitansertifikat_data($surveilance2->id)->first(),
            ];
        } else if ($listpermohonan_id->slug == 'resertifikasi') {
            $data = [
                'logresertifikasi'              => $logresertifikasi_data,
                'status'                        => $status,
                'client'                        => $client,
                'permohonansertifikasi'         => $client->permohonansertifikasi_data($resertifikasi->id)->first(),
                'kajianclient'                  => $client->kajianclient_data($resertifikasi->id)->first(),
                'perjanjianclient'              => $client->perjanjianclient_data($resertifikasi->id)->first(),
                'rencanaclient'                 => $client->rencanaclient_data($resertifikasi->id)->first(),
                'stage1kajiantimaudit'          => $client->stage1kajiantimaudit_data($resertifikasi->id)->first(),
                'stage1penunjukantimaudit'      => $client->stage1penunjukantimaudit_data($resertifikasi->id)->first(),
                'stage1checkaudit'              => $client->stage1checkaudit_data($resertifikasi->id)->first(),
                'stage2rencanaaudit'            => $client->stage2rencanaaudit_data($resertifikasi->id)->first(),
                'stage2checkaudit'              => $client->stage2checkaudit_data($resertifikasi->id)->first(),
                'stage2daftarhadiraudit'        => $client->stage2daftarhadiraudit_data($resertifikasi->id)->first(),
                'stage2laporanaudit'            => $client->stage2laporanaudit_data($resertifikasi->id)->first(),
                'stage2ketidaksesuaianpage'     => $client->stage2ketidaksesuaianpage_data($resertifikasi->id)->first(),
                'stage2surveikepuasancustomer'  => $client->stage2surveikepuasancustomer_data($resertifikasi->id)->first(),
                'stage2temuanverication'        => $client->stage2temuanverifcation_data($resertifikasi->id)->first(),
                'reviewkeputusansertifikasi'    => $client->reviewkeputusansertifikasi_data($resertifikasi->id)->first(),
                'memopenerbitansertifikasi'     => $client->memopenerbitansertifikasi_data($resertifikasi->id)->first(),
                'penerbitansertifikat'          => $client->penerbitansertifikat_data($resertifikasi->id)->first(),
            ];
        }

        return response()->json($data);
    }
}
