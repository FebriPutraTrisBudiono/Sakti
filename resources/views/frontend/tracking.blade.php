@extends('frontend.template')
@section('content')
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center pt-5">
            <div class="container position-relative pt-5">
                <div class="row d-flex justify-content-center pt-5">
                    <div class="col-lg-6 text-center">
                        <h2>{{ $title_bar }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <nav>
            <div class="container">
                <ol class="text-muted">
                    <li><a href="/">Beranda</a></li>
                    <li>{{ $title_bar }}</li>
                </ol>
            </div>
        </nav>
    </div>

    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <form action="/tracking/show" method="get" class="bg-light p-3 rounded">
                <div style="padding: 20px">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <label for="clientid" class="small">ID Client</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="ID Client"
                                    aria-label="Recipient's username" aria-describedby="basic-addon2" name="clientid"
                                    id="clientid" value="{{ request('clientid') }}">
                                <div class="input-group-append ms-1">
                                    <button class="btn btn-primary" type="submit">Cari</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                    @if ($clients != false)
                        @if ($clients->first() == '')
                            <div class="row mt-2">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <div class="card"
                                        style="text-align: center; background-color:rgb(255, 0, 0); border:none; color:white; box-shadow: 0 4px 10px 0 rgb(0, 0, 0);">
                                        <div class="ms-3 me-3">
                                            Maaf ID Client tidak terdaftar
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                        @endif
                        @foreach ($clients as $item)
                            <?php
                            $penerbitansertifikat = \App\Models\Penerbitansertifikat::where('client_id', $item->id)->get();
                            ?>
                            @if ($penerbitansertifikat->first() == '')
                                <div class="row mt-2">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <div class="card"
                                            style="text-align: center; background-color:rgb(251, 255, 0); border:none; box-shadow: 0 4px 10px 0 rgb(0, 0, 0);">
                                            <div class="ms-3 me-3">
                                                Maaf Sertifikat anda belum terbit.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>
                            @endif
                            @foreach ($penerbitansertifikat as $row)
                                <?php $listpermohonan = \App\Models\Listpermohonan::where('id', $row->listpermohonan_id)->first(); ?>
                                <div class="row mt-2">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <div class="card"
                                            style="text-align: justify; background-color:rgb(0, 93, 223); border:none; color:white; box-shadow: 0 4px 10px 0 rgb(0, 0, 0);">
                                            <div style="padding: 15px 16px ;">
                                                Benar bahwa ID Client dengan Nomor <b>{{ $item->idclient }}</b> adalah
                                                Client
                                                dari
                                                Sakti
                                                Indonesia, an.
                                                <b>{{ $item->permohonansertifikasi_data($row->client_id)->first()->nama_perusahaan }}</b>
                                                dengan Sertifikat <b>{{ $listpermohonan->proses_sertifikasi ?? '' }}</b>
                                                yang telah
                                                tersertifikasi sejak tanggal
                                                <b>{{ date('d-m-Y', strtotime($row->created_at)) }}</b> sampai dengan
                                                <b>{{ date('d-m-Y', $row->tgl_kedaluarsa) }}</b>.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>
                            @endforeach
                        @endforeach
                        {{-- <div class="table-responsive mt-4">
                    <table id="customTable" class="table table-bordered small" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>TANGGAL</th>
                                <th>ID CLIENT</th>
                                <th>NAMA CLIENT</th>
                                <th>JENIS LAYANAN</th>
                                <th>TELPON</th>
                                <th>JENIS SERTIFIKAT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $row)
                                <?php
                                $penerbitansertifikat_data = new App\Models\Penerbitansertifikat();
                                $penerbitansertifikat = $penerbitansertifikat_data
                                    ::where('client_id', $row->id)
                                    ->orderBy('id', 'DESC')
                                    ->first();
                                $listpermohonan_data = new App\Models\Listpermohonan();
                                $listpermohonan = $listpermohonan_data::where('id', $penerbitansertifikat ? $penerbitansertifikat->listpermohonan_id : '')->first();
                                $data = $row->penerbitansertifikat_data($listpermohonan->id ?? '')->first();
                                $datenow = date('Y-m-d');
                                $dateexpired = $data->tgl_kadaluarsasertifikat ?? '';
                                ?>
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date_format($row->created_at, 'd/m/Y') }}</td>
                                    <td>
                                        <a href="/tracking/show/{{ $row->id }}" style="color: blue">
                                            {{ $row->service->service_code }}-{{ $row->nomor_client }}
                                        </a>
                                    </td>
                                    <td>{{ $row->user->name }}</td>
                                    <td>{{ $row->service->name }}</td>
                                    <td>{{ $row->user->telp }}</td>
                                    <td>
                                        @if ($listpermohonan != '')
                                            @if ($listpermohonan->slug == 'sertifikasi_awal')
                                                @if (strtotime($datenow) >= strtotime($dateexpired))
                                                    Expired
                                                @else
                                                    <span class="badge bg-success">Sertifikasi Awal</span>
                                                @endif
                                            @elseif ($listpermohonan->slug == 'surveilance1')
                                                @if (strtotime($datenow) >= strtotime($dateexpired))
                                                    Expired
                                                @else
                                                    <span class="badge bg-success">Surveilance I</span>
                                                @endif
                                            @elseif ($listpermohonan->slug == 'surveilance2')
                                                @if (strtotime($datenow) >= strtotime($dateexpired))
                                                    Expired
                                                @else
                                                    <span class="badge bg-success">Surveilance II</span>
                                                @endif
                                            @elseif ($listpermohonan->slug == 'resertifikasi')
                                                @if (strtotime($datenow) >= strtotime($dateexpired))
                                                    Expired
                                                @else
                                                    <span class="badge bg-success">Re Sertifikasi</span>
                                                @endif
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-start mb-5">
                    {{ $clients->links() }}
                </div> --}}
                    @endif
                </div>
            </form>
        </div>
    </section>
@endsection
