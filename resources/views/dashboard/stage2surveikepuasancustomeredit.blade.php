@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <form
                    action="/dashboard/stage2surveikepuasancustomers{{ $stage2surveikepuasancustomer ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
                    method="post">
                    <div class="card mb-4">
                        <div class="card-header text-uppercase">
                            <a href="/dashboard/client/{{ $client->id }}" class="me-2"><i
                                    class="fas fa-arrow-circle-left"></i></a>
                            {{ $listpermohonan_id->proses_sertifikasi }}
                        </div>
                        <div class="card-body">
                            @include('dashboard.navbarstatus')

                            {!! session('msg') !!}
                            @csrf

                            @if ($stage2surveikepuasancustomer)
                                @method('PUT')
                            @endif

                            <input type="hidden" value="{{ $client->id }}" name="client_id">
                            <input type="hidden" value="{{ $listpermohonan_id->id }}" name="listpermohonan_id">

                            <div class="col-12 grid-margin stretch-card">
                                <div>
                                    <div class="card-body">
                                        <h4 style="text-align: center;" class="card-title mb-3 border-bottom mb-4">SURVEI
                                            KEPUASAN PELANGGAN
                                        </h4>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Nama Klien</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control"
                                                            value="{{ $permohonansertifikasi->nama_pimpinan }}" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Tanggal audit</label>
                                                    <div class="col-sm-12">
                                                        <input type="date" class="form-control"
                                                            value="{{ $stage1penunjukantimaudit->tanggal_bertugas }}"
                                                            readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group row">
                                                    <label>Alamat</label>
                                                    <div class="col-sm-12">
                                                        <textarea class="form-control" name="" id="" readonly>{{ $permohonansertifikasi->alamat }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col mb-3">
                                            <h6 class="card-title border-bottom mb-3">Standar</h6>
                                            <div class="row">
                                                <div class="col-md-3 mb-3">
                                                    <div class="form-check form-check-inline">
                                                        <input
                                                            class="form-check-input @error('standart_iso') is-invalid @enderror"
                                                            type="radio" name="standart_iso" id="standart_iso"
                                                            value="ISO 9001:2015"
                                                            {{ old('standart_iso', $stage2checkaudit->standart_iso ?? '') == 'ISO 9001:2015' ? 'checked' : '' }}
                                                            disabled>
                                                        <label class="form-check-label" for="standart_iso">ISO
                                                            9001:2015</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <div class="form-check form-check-inline">
                                                        <input
                                                            class="form-check-input @error('standart_iso') is-invalid @enderror"
                                                            type="radio" name="standart_iso" id="standart_iso"
                                                            value="ISO 14001:2015"
                                                            {{ old('standart_iso', $stage2checkaudit->standart_iso ?? '') == 'ISO 14001:2015' ? 'checked' : '' }}
                                                            disabled>
                                                        <label class="form-check-label" for="standart_iso">ISO
                                                            14001:2015</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <div class="form-check form-check-inline">
                                                        <input
                                                            class="form-check-input @error('standart_iso') is-invalid @enderror"
                                                            type="radio" name="standart_iso" id="standart_iso"
                                                            value="ISO 21001:2018"
                                                            {{ old('standart_iso', $stage2checkaudit->standart_iso ?? '') == 'ISO 21001:2018' ? 'checked' : '' }}
                                                            disabled>
                                                        <label class="form-check-label" for="standart_iso">ISO
                                                            21001:2018</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <div class="form-check form-check-inline">
                                                        <input
                                                            class="form-check-input @error('standart_iso') is-invalid @enderror"
                                                            type="radio" name="standart_iso" id="standart_iso"
                                                            value="ISO 45001:2018"
                                                            {{ old('standart_iso', $stage2checkaudit->standart_iso ?? '') == 'ISO 45001:2018' ? 'checked' : '' }}
                                                            disabled>
                                                        <label class="form-check-label" for="standart_iso">ISO
                                                            45001:2018</label>
                                                    </div>
                                                </div>
                                                @error('iso')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 mb-3">
                                                    <div class="form-check form-check-inline">
                                                        @if ($client->service->iso_code == 'ISO 9001:2015' ||
                                                            $client->service->iso_code == 'ISO 14001:2015' ||
                                                            $client->service->iso_code == 'ISO 21001:2018' ||
                                                            $client->service->iso_code == 'ISO 45001:2018')
                                                            <input class="form-check-input" type="radio">
                                                            <label class="form-check-label" for="iso">....</label>
                                                        @else
                                                            <input class="form-check-input" type="radio"
                                                                name="standart_iso" id="standart_iso"
                                                                value="{{ $client->service->iso_code }}"
                                                                {{ old('standart_iso', $stage2checkaudit->standart_iso ?? '') == $client->service->iso_code ? 'checked' : '' }}
                                                                disabled>
                                                            <label class="form-check-label"
                                                                for="standart_iso">{{ $client->service->iso_code }}</label>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col mb-3">
                                            <h6 class="card-title mb-2 border-bottom mb-5">Tipe Audit</h6>
                                            <div class="col-sm-12 mb-2">
                                                <div class="form-group row">
                                                    <div class="col-sm-2">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio"
                                                                    class="form-check-input @error('audit') is-invalid @enderror"
                                                                    name="tipe_audit" id="audit" value="stage2"
                                                                    {{ old('tipe_audit', $stage2surveikepuasancustomer->tipe_audit ?? '') == 'stage2' ? 'checked' : '' }} />
                                                                STAGE II
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input"
                                                                    name="tipe_audit" id="tipe_audit" value="survailen"
                                                                    {{ old('tipe_audit', $stage2surveikepuasancustomer->tipe_audit ?? '') == 'survailen' ? 'checked' : '' }} />
                                                                SURVAILEN
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input"
                                                                    name="tipe_audit" id="tipe_audit"
                                                                    value="perluasan_lingkup"
                                                                    {{ old('tipe_audit', $stage2surveikepuasancustomer->tipe_audit ?? '') == 'perluasan_lingkup' ? 'checked' : '' }} />
                                                                PERLUASAN LINGKUP
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input"
                                                                    name="tipe_audit" id="tipe_audit" value="shortnotice"
                                                                    {{ old('tipe_audit', $stage2surveikepuasancustomer->tipe_audit ?? '') == 'shortnotice' ? 'checked' : '' }} />
                                                                SHORT NOTICE AUDIT
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input"
                                                                    name="tipe_audit" id="tipe_audit"
                                                                    value="resertifikasi"
                                                                    {{ old('tipe_audit', $stage2surveikepuasancustomer->tipe_audit ?? '') == 'resertifikasi' ? 'checked' : '' }} />
                                                                RESERTIFIKASI
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col mt-3">
                                            <h6 class="card-title border-bottom mb-3">Nama Auditor</h6>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group row">
                                                        <label for="">Auditor 1</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control"
                                                                placeholder="Auditor 1" name="auditor[]"
                                                                value="{{ old('auditor[]', $auditor[0] ?? '') }}" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="">Auditor 2</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control"
                                                                placeholder="Auditor 2" name="auditor[]"
                                                                value="{{ old('auditor[]', $auditor[1] ?? '') }}" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <div class="form-group row">
                                                            <label for="">Auditor 3</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control"
                                                                    placeholder="Auditor 3" name="auditor[]"
                                                                    value="{{ old('auditor[]', $auditor[2] ?? '') }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label for="">Auditor 4</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" class="form-control"
                                                                    placeholder="Auditor 4" name="auditor[]"
                                                                    value="{{ old('auditor[]', $auditor[3] ?? '') }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col mt-3">
                                            <h6 class="card-title border-bottom mb-3">Penilaian Pelayanan</h6>
                                            <p class="card-title">
                                                -> Kompetensi
                                            </p>
                                            <div class="row">
                                                <div class="col-md-3 mb-3">
                                                    <div class="form-group row">
                                                        <label for="">Auditor 1</label>
                                                        <div class="col-sm-12">
                                                            <select name="indikator1[]" id=""
                                                                class="form-control">
                                                                <option value="">:: Pilih ::</option>
                                                                <option value="1"
                                                                    {{ old('indikator1[]', $indikator1[0] ?? '') == '1' ? 'selected' : '' }}>
                                                                    1 = Buruk Sekali</option>
                                                                <option value="2"
                                                                    {{ old('indikator1[]', $indikator1[0] ?? '') == '2' ? 'selected' : '' }}>
                                                                    2 = Buruk</option>
                                                                <option value="3"
                                                                    {{ old('indikator1[]', $indikator1[0] ?? '') == '3' ? 'selected' : '' }}>
                                                                    3 = Cukup</option>
                                                                <option value="4"
                                                                    {{ old('indikator1[]', $indikator1[0] ?? '') == '4' ? 'selected' : '' }}>
                                                                    4 = Baik</option>
                                                                <option value="5"
                                                                    {{ old('indikator1[]', $indikator1[0] ?? '') == '5' ? 'selected' : '' }}>
                                                                    5 = Baik Sekali</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label for="">Auditor 2</label>
                                                        <div class="col-sm-12">
                                                            <select name="indikator1[]" id=""
                                                                class="form-control">
                                                                <option value="">:: Pilih ::</option>
                                                                <option value="1"
                                                                    {{ old('indikator1[]', $indikator1[1] ?? '') == '1' ? 'selected' : '' }}>
                                                                    1 = Buruk Sekali</option>
                                                                <option value="2"
                                                                    {{ old('indikator1[]', $indikator1[1] ?? '') == '2' ? 'selected' : '' }}>
                                                                    2 = Buruk</option>
                                                                <option value="3"
                                                                    {{ old('indikator1[]', $indikator1[1] ?? '') == '3' ? 'selected' : '' }}>
                                                                    3 = Cukup</option>
                                                                <option value="4"
                                                                    {{ old('indikator1[]', $indikator1[1] ?? '') == '4' ? 'selected' : '' }}>
                                                                    4 = Baik</option>
                                                                <option value="5"
                                                                    {{ old('indikator1[]', $indikator1[1] ?? '') == '5' ? 'selected' : '' }}>
                                                                    5 = Baik Sekali</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label for="">Auditor 3</label>
                                                        <div class="col-sm-12">
                                                            <select name="indikator1[]" id=""
                                                                class="form-control">
                                                                <option value="">:: Pilih ::</option>
                                                                <option value="1"
                                                                    {{ old('indikator1[]', $indikator1[2] ?? '') == '1' ? 'selected' : '' }}>
                                                                    1 = Buruk Sekali</option>
                                                                <option value="2"
                                                                    {{ old('indikator1[]', $indikator1[2] ?? '') == '2' ? 'selected' : '' }}>
                                                                    2 = Buruk</option>
                                                                <option value="3"
                                                                    {{ old('indikator1[]', $indikator1[2] ?? '') == '3' ? 'selected' : '' }}>
                                                                    3 = Cukup</option>
                                                                <option value="4"
                                                                    {{ old('indikator1[]', $indikator1[2] ?? '') == '4' ? 'selected' : '' }}>
                                                                    4 = Baik</option>
                                                                <option value="5"
                                                                    {{ old('indikator1[]', $indikator1[2] ?? '') == '5' ? 'selected' : '' }}>
                                                                    5 = Baik Sekali</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label for="">Auditor 4</label>
                                                        <div class="col-sm-12">
                                                            <select name="indikator1[]" id=""
                                                                class="form-control">
                                                                <option value="">:: Pilih ::</option>
                                                                <option value="1"
                                                                    {{ old('indikator1[]', $indikator1[3] ?? '') == '1' ? 'selected' : '' }}>
                                                                    1 = Buruk Sekali</option>
                                                                <option value="2"
                                                                    {{ old('indikator1[]', $indikator1[3] ?? '') == '2' ? 'selected' : '' }}>
                                                                    2 = Buruk</option>
                                                                <option value="3"
                                                                    {{ old('indikator1[]', $indikator1[3] ?? '') == '3' ? 'selected' : '' }}>
                                                                    3 = Cukup</option>
                                                                <option value="4"
                                                                    {{ old('indikator1[]', $indikator1[3] ?? '') == '4' ? 'selected' : '' }}>
                                                                    4 = Baik</option>
                                                                <option value="5"
                                                                    {{ old('indikator1[]', $indikator1[3] ?? '') == '5' ? 'selected' : '' }}>
                                                                    5 = Baik Sekali</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="card-title mt-3">
                                                -> Pengetahuan tentang bisnis sektor klien yang diaudit
                                            </p>
                                            <div class="row">
                                                <div class="col-md-3 mb-3">
                                                    <div class="form-group row">
                                                        <label for="">Auditor 1</label>
                                                        <div class="col-sm-12">
                                                            <select name="indikator2[]" id=""
                                                                class="form-control">
                                                                <option value="">:: Pilih ::</option>
                                                                <option value="1"
                                                                    {{ old('indikator1[]', $indikator2[0] ?? '') == '1' ? 'selected' : '' }}>
                                                                    1 = Buruk Sekali</option>
                                                                <option value="2"
                                                                    {{ old('indikator1[]', $indikator2[0] ?? '') == '2' ? 'selected' : '' }}>
                                                                    2 = Buruk</option>
                                                                <option value="3"
                                                                    {{ old('indikator1[]', $indikator2[0] ?? '') == '3' ? 'selected' : '' }}>
                                                                    3 = Cukup</option>
                                                                <option value="4"
                                                                    {{ old('indikator1[]', $indikator2[0] ?? '') == '4' ? 'selected' : '' }}>
                                                                    4 = Baik</option>
                                                                <option value="5"
                                                                    {{ old('indikator1[]', $indikator2[0] ?? '') == '5' ? 'selected' : '' }}>
                                                                    5 = Baik Sekali</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label for="">Auditor 2</label>
                                                        <div class="col-sm-12">
                                                            <select name="indikator2[]" id=""
                                                                class="form-control">
                                                                <option value="">:: Pilih ::</option>
                                                                <option value="1"
                                                                    {{ old('indikator1[]', $indikator2[1] ?? '') == '1' ? 'selected' : '' }}>
                                                                    1 = Buruk Sekali</option>
                                                                <option value="2"
                                                                    {{ old('indikator1[]', $indikator2[1] ?? '') == '2' ? 'selected' : '' }}>
                                                                    2 = Buruk</option>
                                                                <option value="3"
                                                                    {{ old('indikator1[]', $indikator2[1] ?? '') == '3' ? 'selected' : '' }}>
                                                                    3 = Cukup</option>
                                                                <option value="4"
                                                                    {{ old('indikator1[]', $indikator2[1] ?? '') == '4' ? 'selected' : '' }}>
                                                                    4 = Baik</option>
                                                                <option value="5"
                                                                    {{ old('indikator1[]', $indikator2[1] ?? '') == '5' ? 'selected' : '' }}>
                                                                    5 = Baik Sekali</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label for="">Auditor 3</label>
                                                        <div class="col-sm-12">
                                                            <select name="indikator2[]" id=""
                                                                class="form-control">
                                                                <option value="">:: Pilih ::</option>
                                                                <option value="1"
                                                                    {{ old('indikator1[]', $indikator2[2] ?? '') == '1' ? 'selected' : '' }}>
                                                                    1 = Buruk Sekali</option>
                                                                <option value="2"
                                                                    {{ old('indikator1[]', $indikator2[2] ?? '') == '2' ? 'selected' : '' }}>
                                                                    2 = Buruk</option>
                                                                <option value="3"
                                                                    {{ old('indikator1[]', $indikator2[2] ?? '') == '3' ? 'selected' : '' }}>
                                                                    3 = Cukup</option>
                                                                <option value="4"
                                                                    {{ old('indikator1[]', $indikator2[2] ?? '') == '4' ? 'selected' : '' }}>
                                                                    4 = Baik</option>
                                                                <option value="5"
                                                                    {{ old('indikator1[]', $indikator2[2] ?? '') == '5' ? 'selected' : '' }}>
                                                                    5 = Baik Sekali</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label for="">Auditor 4</label>
                                                        <div class="col-sm-12">
                                                            <select name="indikator2[]" id=""
                                                                class="form-control">
                                                                <option value="">:: Pilih ::</option>
                                                                <option value="1"
                                                                    {{ old('indikator1[]', $indikator2[3] ?? '') == '1' ? 'selected' : '' }}>
                                                                    1 = Buruk Sekali</option>
                                                                <option value="2"
                                                                    {{ old('indikator1[]', $indikator2[3] ?? '') == '2' ? 'selected' : '' }}>
                                                                    2 = Buruk</option>
                                                                <option value="3"
                                                                    {{ old('indikator1[]', $indikator2[3] ?? '') == '3' ? 'selected' : '' }}>
                                                                    3 = Cukup</option>
                                                                <option value="4"
                                                                    {{ old('indikator1[]', $indikator2[3] ?? '') == '4' ? 'selected' : '' }}>
                                                                    4 = Baik</option>
                                                                <option value="5"
                                                                    {{ old('indikator1[]', $indikator2[3] ?? '') == '5' ? 'selected' : '' }}>
                                                                    5 = Baik Sekali</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="card-title mt-3">
                                                -> Program audit
                                            </p>
                                            <div class="row">
                                                <div class="col-md-3 mb-3">
                                                    <div class="form-group row">
                                                        <label for="">Auditor 1</label>
                                                        <div class="col-sm-12">
                                                            <select name="indikator3[]" id=""
                                                                class="form-control">
                                                                <option value="">:: Pilih ::</option>
                                                                <option value="1"
                                                                    {{ old('indikator1[]', $indikator3[0] ?? '') == '1' ? 'selected' : '' }}>
                                                                    1 = Buruk Sekali</option>
                                                                <option value="2"
                                                                    {{ old('indikator1[]', $indikator3[0] ?? '') == '2' ? 'selected' : '' }}>
                                                                    2 = Buruk</option>
                                                                <option value="3"
                                                                    {{ old('indikator1[]', $indikator3[0] ?? '') == '3' ? 'selected' : '' }}>
                                                                    3 = Cukup</option>
                                                                <option value="4"
                                                                    {{ old('indikator1[]', $indikator3[0] ?? '') == '4' ? 'selected' : '' }}>
                                                                    4 = Baik</option>
                                                                <option value="5"
                                                                    {{ old('indikator1[]', $indikator3[0] ?? '') == '5' ? 'selected' : '' }}>
                                                                    5 = Baik Sekali</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label for="">Auditor 2</label>
                                                        <div class="col-sm-12">
                                                            <select name="indikator3[]" id=""
                                                                class="form-control">
                                                                <option value="">:: Pilih ::</option>
                                                                <option value="1"
                                                                    {{ old('indikator1[]', $indikator3[1] ?? '') == '1' ? 'selected' : '' }}>
                                                                    1 = Buruk Sekali</option>
                                                                <option value="2"
                                                                    {{ old('indikator1[]', $indikator3[1] ?? '') == '2' ? 'selected' : '' }}>
                                                                    2 = Buruk</option>
                                                                <option value="3"
                                                                    {{ old('indikator1[]', $indikator3[1] ?? '') == '3' ? 'selected' : '' }}>
                                                                    3 = Cukup</option>
                                                                <option value="4"
                                                                    {{ old('indikator1[]', $indikator3[1] ?? '') == '4' ? 'selected' : '' }}>
                                                                    4 = Baik</option>
                                                                <option value="5"
                                                                    {{ old('indikator1[]', $indikator3[1] ?? '') == '5' ? 'selected' : '' }}>
                                                                    5 = Baik Sekali</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label for="">Auditor 3</label>
                                                        <div class="col-sm-12">
                                                            <select name="indikator3[]" id=""
                                                                class="form-control">
                                                                <option value="">:: Pilih ::</option>
                                                                <option value="1"
                                                                    {{ old('indikator1[]', $indikator3[2] ?? '') == '1' ? 'selected' : '' }}>
                                                                    1 = Buruk Sekali</option>
                                                                <option value="2"
                                                                    {{ old('indikator1[]', $indikator3[2] ?? '') == '2' ? 'selected' : '' }}>
                                                                    2 = Buruk</option>
                                                                <option value="3"
                                                                    {{ old('indikator1[]', $indikator3[2] ?? '') == '3' ? 'selected' : '' }}>
                                                                    3 = Cukup</option>
                                                                <option value="4"
                                                                    {{ old('indikator1[]', $indikator3[2] ?? '') == '4' ? 'selected' : '' }}>
                                                                    4 = Baik</option>
                                                                <option value="5"
                                                                    {{ old('indikator1[]', $indikator3[2] ?? '') == '5' ? 'selected' : '' }}>
                                                                    5 = Baik Sekali</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label for="">Auditor 4</label>
                                                        <div class="col-sm-12">
                                                            <select name="indikator3[]" id=""
                                                                class="form-control">
                                                                <option value="">:: Pilih ::</option>
                                                                <option value="1"
                                                                    {{ old('indikator1[]', $indikator3[3] ?? '') == '1' ? 'selected' : '' }}>
                                                                    1 = Buruk Sekali</option>
                                                                <option value="2"
                                                                    {{ old('indikator1[]', $indikator3[3] ?? '') == '2' ? 'selected' : '' }}>
                                                                    2 = Buruk</option>
                                                                <option value="3"
                                                                    {{ old('indikator1[]', $indikator3[3] ?? '') == '3' ? 'selected' : '' }}>
                                                                    3 = Cukup</option>
                                                                <option value="4"
                                                                    {{ old('indikator1[]', $indikator3[3] ?? '') == '4' ? 'selected' : '' }}>
                                                                    4 = Baik</option>
                                                                <option value="5"
                                                                    {{ old('indikator1[]', $indikator3[3] ?? '') == '5' ? 'selected' : '' }}>
                                                                    5 = Baik Sekali</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="card-title mt-3">
                                                -> Kesesuaian pelaksanan program audit
                                            </p>
                                            <div class="row">
                                                <div class="col-md-3 mb-3">
                                                    <div class="form-group row">
                                                        <label for="">Auditor 1</label>
                                                        <div class="col-sm-12">
                                                            <select name="indikator4[]" id=""
                                                                class="form-control">
                                                                <option value="">:: Pilih ::</option>
                                                                <option value="1"
                                                                    {{ old('indikator1[]', $indikator4[0] ?? '') == '1' ? 'selected' : '' }}>
                                                                    1 = Buruk Sekali</option>
                                                                <option value="2"
                                                                    {{ old('indikator1[]', $indikator4[0] ?? '') == '2' ? 'selected' : '' }}>
                                                                    2 = Buruk</option>
                                                                <option value="3"
                                                                    {{ old('indikator1[]', $indikator4[0] ?? '') == '3' ? 'selected' : '' }}>
                                                                    3 = Cukup</option>
                                                                <option value="4"
                                                                    {{ old('indikator1[]', $indikator4[0] ?? '') == '4' ? 'selected' : '' }}>
                                                                    4 = Baik</option>
                                                                <option value="5"
                                                                    {{ old('indikator1[]', $indikator4[0] ?? '') == '5' ? 'selected' : '' }}>
                                                                    5 = Baik Sekali</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label for="">Auditor 2</label>
                                                        <div class="col-sm-12">
                                                            <select name="indikator4[]" id=""
                                                                class="form-control">
                                                                <option value="">:: Pilih ::</option>
                                                                <option value="1"
                                                                    {{ old('indikator1[]', $indikator4[1] ?? '') == '1' ? 'selected' : '' }}>
                                                                    1 = Buruk Sekali</option>
                                                                <option value="2"
                                                                    {{ old('indikator1[]', $indikator4[1] ?? '') == '2' ? 'selected' : '' }}>
                                                                    2 = Buruk</option>
                                                                <option value="3"
                                                                    {{ old('indikator1[]', $indikator4[1] ?? '') == '3' ? 'selected' : '' }}>
                                                                    3 = Cukup</option>
                                                                <option value="4"
                                                                    {{ old('indikator1[]', $indikator4[1] ?? '') == '4' ? 'selected' : '' }}>
                                                                    4 = Baik</option>
                                                                <option value="5"
                                                                    {{ old('indikator1[]', $indikator4[1] ?? '') == '5' ? 'selected' : '' }}>
                                                                    5 = Baik Sekali</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label for="">Auditor 3</label>
                                                        <div class="col-sm-12">
                                                            <select name="indikator4[]" id=""
                                                                class="form-control">
                                                                <option value="">:: Pilih ::</option>
                                                                <option value="1"
                                                                    {{ old('indikator1[]', $indikator4[2] ?? '') == '1' ? 'selected' : '' }}>
                                                                    1 = Buruk Sekali</option>
                                                                <option value="2"
                                                                    {{ old('indikator1[]', $indikator4[2] ?? '') == '2' ? 'selected' : '' }}>
                                                                    2 = Buruk</option>
                                                                <option value="3"
                                                                    {{ old('indikator1[]', $indikator4[2] ?? '') == '3' ? 'selected' : '' }}>
                                                                    3 = Cukup</option>
                                                                <option value="4"
                                                                    {{ old('indikator1[]', $indikator4[2] ?? '') == '4' ? 'selected' : '' }}>
                                                                    4 = Baik</option>
                                                                <option value="5"
                                                                    {{ old('indikator1[]', $indikator4[2] ?? '') == '5' ? 'selected' : '' }}>
                                                                    5 = Baik Sekali</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label for="">Auditor 4</label>
                                                        <div class="col-sm-12">
                                                            <select name="indikator4[]" id=""
                                                                class="form-control">
                                                                <option value="">:: Pilih ::</option>
                                                                <option value="1"
                                                                    {{ old('indikator1[]', $indikator4[3] ?? '') == '1' ? 'selected' : '' }}>
                                                                    1 = Buruk Sekali</option>
                                                                <option value="2"
                                                                    {{ old('indikator1[]', $indikator4[3] ?? '') == '2' ? 'selected' : '' }}>
                                                                    2 = Buruk</option>
                                                                <option value="3"
                                                                    {{ old('indikator1[]', $indikator4[3] ?? '') == '3' ? 'selected' : '' }}>
                                                                    3 = Cukup</option>
                                                                <option value="4"
                                                                    {{ old('indikator1[]', $indikator4[3] ?? '') == '4' ? 'selected' : '' }}>
                                                                    4 = Baik</option>
                                                                <option value="5"
                                                                    {{ old('indikator1[]', $indikator4[3] ?? '') == '5' ? 'selected' : '' }}>
                                                                    5 = Baik Sekali</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="card-title mt-3">
                                                -> Respon terhadap pertanyaan
                                            </p>
                                            <div class="row">
                                                <div class="col-md-3 mb-3">
                                                    <div class="form-group row">
                                                        <label for="">Auditor 1</label>
                                                        <div class="col-sm-12">
                                                            <select name="indikator5[]" id=""
                                                                class="form-control">
                                                                <option value="">:: Pilih ::</option>
                                                                <option value="1"
                                                                    {{ old('indikator1[]', $indikator5[0] ?? '') == '1' ? 'selected' : '' }}>
                                                                    1 = Buruk Sekali</option>
                                                                <option value="2"
                                                                    {{ old('indikator1[]', $indikator5[0] ?? '') == '2' ? 'selected' : '' }}>
                                                                    2 = Buruk</option>
                                                                <option value="3"
                                                                    {{ old('indikator1[]', $indikator5[0] ?? '') == '3' ? 'selected' : '' }}>
                                                                    3 = Cukup</option>
                                                                <option value="4"
                                                                    {{ old('indikator1[]', $indikator5[0] ?? '') == '4' ? 'selected' : '' }}>
                                                                    4 = Baik</option>
                                                                <option value="5"
                                                                    {{ old('indikator1[]', $indikator5[0] ?? '') == '5' ? 'selected' : '' }}>
                                                                    5 = Baik Sekali</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label for="">Auditor 2</label>
                                                        <div class="col-sm-12">
                                                            <select name="indikator5[]" id=""
                                                                class="form-control">
                                                                <option value="">:: Pilih ::</option>
                                                                <option value="1"
                                                                    {{ old('indikator1[]', $indikator5[1] ?? '') == '1' ? 'selected' : '' }}>
                                                                    1 = Buruk Sekali</option>
                                                                <option value="2"
                                                                    {{ old('indikator1[]', $indikator5[1] ?? '') == '2' ? 'selected' : '' }}>
                                                                    2 = Buruk</option>
                                                                <option value="3"
                                                                    {{ old('indikator1[]', $indikator5[1] ?? '') == '3' ? 'selected' : '' }}>
                                                                    3 = Cukup</option>
                                                                <option value="4"
                                                                    {{ old('indikator1[]', $indikator5[1] ?? '') == '4' ? 'selected' : '' }}>
                                                                    4 = Baik</option>
                                                                <option value="5"
                                                                    {{ old('indikator1[]', $indikator5[1] ?? '') == '5' ? 'selected' : '' }}>
                                                                    5 = Baik Sekali</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label for="">Auditor 3</label>
                                                        <div class="col-sm-12">
                                                            <select name="indikator5[]" id=""
                                                                class="form-control">
                                                                <option value="">:: Pilih ::</option>
                                                                <option value="1"
                                                                    {{ old('indikator1[]', $indikator5[2] ?? '') == '1' ? 'selected' : '' }}>
                                                                    1 = Buruk Sekali</option>
                                                                <option value="2"
                                                                    {{ old('indikator1[]', $indikator5[2] ?? '') == '2' ? 'selected' : '' }}>
                                                                    2 = Buruk</option>
                                                                <option value="3"
                                                                    {{ old('indikator1[]', $indikator5[2] ?? '') == '3' ? 'selected' : '' }}>
                                                                    3 = Cukup</option>
                                                                <option value="4"
                                                                    {{ old('indikator1[]', $indikator5[2] ?? '') == '4' ? 'selected' : '' }}>
                                                                    4 = Baik</option>
                                                                <option value="5"
                                                                    {{ old('indikator1[]', $indikator5[2] ?? '') == '5' ? 'selected' : '' }}>
                                                                    5 = Baik Sekali</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label for="">Auditor 4</label>
                                                        <div class="col-sm-12">
                                                            <select name="indikator5[]" id=""
                                                                class="form-control">
                                                                <option value="">:: Pilih ::</option>
                                                                <option value="1"
                                                                    {{ old('indikator1[]', $indikator5[3] ?? '') == '1' ? 'selected' : '' }}>
                                                                    1 = Buruk Sekali</option>
                                                                <option value="2"
                                                                    {{ old('indikator1[]', $indikator5[3] ?? '') == '2' ? 'selected' : '' }}>
                                                                    2 = Buruk</option>
                                                                <option value="3"
                                                                    {{ old('indikator1[]', $indikator5[3] ?? '') == '3' ? 'selected' : '' }}>
                                                                    3 = Cukup</option>
                                                                <option value="4"
                                                                    {{ old('indikator1[]', $indikator5[3] ?? '') == '4' ? 'selected' : '' }}>
                                                                    4 = Baik</option>
                                                                <option value="5"
                                                                    {{ old('indikator1[]', $indikator5[3] ?? '') == '5' ? 'selected' : '' }}>
                                                                    5 = Baik Sekali</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="card-title mt-3">
                                                -> Penilaian secara keseluruhan untuk auditor yang ditugaskan
                                            </p>
                                            <div class="row">
                                                <div class="col-md-3 mb-3">
                                                    <div class="form-group row">
                                                        <label for="">Auditor 1</label>
                                                        <div class="col-sm-12">
                                                            <select name="indikator6[]" id=""
                                                                class="form-control">
                                                                <option value="">:: Pilih ::</option>
                                                                <option value="1"
                                                                    {{ old('indikator1[]', $indikator6[0] ?? '') == '1' ? 'selected' : '' }}>
                                                                    1 = Buruk Sekali</option>
                                                                <option value="2"
                                                                    {{ old('indikator1[]', $indikator6[0] ?? '') == '2' ? 'selected' : '' }}>
                                                                    2 = Buruk</option>
                                                                <option value="3"
                                                                    {{ old('indikator1[]', $indikator6[0] ?? '') == '3' ? 'selected' : '' }}>
                                                                    3 = Cukup</option>
                                                                <option value="4"
                                                                    {{ old('indikator1[]', $indikator6[0] ?? '') == '4' ? 'selected' : '' }}>
                                                                    4 = Baik</option>
                                                                <option value="5"
                                                                    {{ old('indikator1[]', $indikator6[0] ?? '') == '5' ? 'selected' : '' }}>
                                                                    5 = Baik Sekali</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label for="">Auditor 2</label>
                                                        <div class="col-sm-12">
                                                            <select name="indikator6[]" id=""
                                                                class="form-control">
                                                                <option value="">:: Pilih ::</option>
                                                                <option value="1"
                                                                    {{ old('indikator1[]', $indikator6[1] ?? '') == '1' ? 'selected' : '' }}>
                                                                    1 = Buruk Sekali</option>
                                                                <option value="2"
                                                                    {{ old('indikator1[]', $indikator6[1] ?? '') == '2' ? 'selected' : '' }}>
                                                                    2 = Buruk</option>
                                                                <option value="3"
                                                                    {{ old('indikator1[]', $indikator6[1] ?? '') == '3' ? 'selected' : '' }}>
                                                                    3 = Cukup</option>
                                                                <option value="4"
                                                                    {{ old('indikator1[]', $indikator6[1] ?? '') == '4' ? 'selected' : '' }}>
                                                                    4 = Baik</option>
                                                                <option value="5"
                                                                    {{ old('indikator1[]', $indikator6[1] ?? '') == '5' ? 'selected' : '' }}>
                                                                    5 = Baik Sekali</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label for="">Auditor 3</label>
                                                        <div class="col-sm-12">
                                                            <select name="indikator6[]" id=""
                                                                class="form-control">
                                                                <option value="">:: Pilih ::</option>
                                                                <option value="1"
                                                                    {{ old('indikator1[]', $indikator6[2] ?? '') == '1' ? 'selected' : '' }}>
                                                                    1 = Buruk Sekali</option>
                                                                <option value="2"
                                                                    {{ old('indikator1[]', $indikator6[2] ?? '') == '2' ? 'selected' : '' }}>
                                                                    2 = Buruk</option>
                                                                <option value="3"
                                                                    {{ old('indikator1[]', $indikator6[2] ?? '') == '3' ? 'selected' : '' }}>
                                                                    3 = Cukup</option>
                                                                <option value="4"
                                                                    {{ old('indikator1[]', $indikator6[2] ?? '') == '4' ? 'selected' : '' }}>
                                                                    4 = Baik</option>
                                                                <option value="5"
                                                                    {{ old('indikator1[]', $indikator6[2] ?? '') == '5' ? 'selected' : '' }}>
                                                                    5 = Baik Sekali</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label for="">Auditor 4</label>
                                                        <div class="col-sm-12">
                                                            <select name="indikator6[]" id=""
                                                                class="form-control">
                                                                <option value="">:: Pilih ::</option>
                                                                <option value="1"
                                                                    {{ old('indikator1[]', $indikator6[3] ?? '') == '1' ? 'selected' : '' }}>
                                                                    1 = Buruk Sekali</option>
                                                                <option value="2"
                                                                    {{ old('indikator1[]', $indikator6[3] ?? '') == '2' ? 'selected' : '' }}>
                                                                    2 = Buruk</option>
                                                                <option value="3"
                                                                    {{ old('indikator1[]', $indikator6[3] ?? '') == '3' ? 'selected' : '' }}>
                                                                    3 = Cukup</option>
                                                                <option value="4"
                                                                    {{ old('indikator1[]', $indikator6[3] ?? '') == '4' ? 'selected' : '' }}>
                                                                    4 = Baik</option>
                                                                <option value="5"
                                                                    {{ old('indikator1[]', $indikator6[3] ?? '') == '5' ? 'selected' : '' }}>
                                                                    5 = Baik Sekali</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col mt-3 mb-3">
                                            <h6 class="card-title border-bottom mb-3">Mohon beri keterangan apabila
                                                penilaian auditor dibawah skala 3:</h6>
                                            <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="10">{{ old('keterangan', $stage2surveikepuasancustomer->keterangan ?? '') }}</textarea>
                                        </div>

                                        <div class="col mt-5">
                                            <h6 class="card-title border-bottom mb-4">TTD</h6>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="tempat_ttd">Tempat</label>
                                                        <input
                                                            class="form-control mt-1 @error('tempat_ttd') is-invalid @enderror"
                                                            name="tempat_ttd" type="text" id="tempat_ttd"
                                                            value="{{ old('tempat_ttd', $stage2surveikepuasancustomer->tempat_ttd ?? '') }}" />
                                                        @error('tempat_ttd')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="tgl_ttd">Tanggal</label>
                                                        <input
                                                            class="form-control mt-1 @error('tgl_ttd') is-invalid @enderror"
                                                            name="tgl_ttd" type="date" id="tgl_ttd"
                                                            value="{{ old('tgl_ttd', $stage2surveikepuasancustomer->tgl_ttd ?? '') }}" />
                                                        @error('tgl_ttd')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="nama_ttd">Nama</label>
                                                        <input
                                                            class="form-control mt-1 @error('nama_ttd') is-invalid @enderror"
                                                            name="nama_ttd" type="text" id="nama_ttd"
                                                            value="{{ old('nama_ttd', $stage2surveikepuasancustomer->nama_ttd ?? '') }}" />
                                                        @error('nama_ttd')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <div class="form-group">
                                                        <label for="nama_organisasi">Nama Organisasi </label>
                                                        <input
                                                            class="form-control mt-1 @error('nama_organisasi') is-invalid @enderror"
                                                            name="nama_organisasi" type="text" id="nama_organisasi"
                                                            value="{{ old('nama_organisasi', $stage2surveikepuasancustomer->nama_organisasi ?? '') }}" />
                                                        @error('nama_organisasi')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($stage2surveikepuasancustomer == '')
                                            @if (in_array('F-CER-10 - Survei Kepuasan Pelanggan.store', $roles))
                                                <button type="submit" class="btn btn-primary mr-2">
                                                    Simpan
                                                </button>
                                            @endif
                                        @elseif ($stage2surveikepuasancustomer->status != 2)
                                            @if (in_array('F-CER-10 - Survei Kepuasan Pelanggan.update', $roles))
                                                <button type="submit" class="btn btn-primary mr-2">
                                                    Simpan
                                                </button>
                                            @endif
                                        @endif

                                        @if ($stage2surveikepuasancustomer)
                                            @if (in_array('F-CER-10 - Survei Kepuasan Pelanggan.download', $roles))
                                                <a href="/dashboard/stage2surveikepuasancustomers/download/{{ $stage2surveikepuasancustomer->id }}"
                                                    class="btn btn-secondary" target='_blank'>
                                                    Download
                                                </a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @if ($stage2surveikepuasancustomer)
                    <form
                        action="/dashboard/stage2surveikepuasancustomersvalidasi{{ $stage2surveikepuasancustomer ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
                        method="post">
                        @csrf

                        @if ($stage2surveikepuasancustomer)
                            @method('PUT')
                        @endif

                        <input type="hidden" id="clientid" value="{{ $client->id ?? '' }}">
                        <input type="hidden" id="listpermohonan_id" value="{{ $listpermohonan_id->id ?? '' }}">
                        <input type="hidden" id="status" value="{{ $stage2surveikepuasancustomer->status ?? '' }}">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h4 class="card-title">Status</h4>
                                @if (in_array('F-CER-10 - Survei Kepuasan Pelanggan.validasi', $roles))
                                    <select name="status" id="status"
                                        class="form-control mt-1 @error('status') is-invalid @enderror">
                                        <option value="">:: Pilih ::</option>
                                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Menunggu
                                        </option>
                                        <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Diterima
                                        </option>
                                        <option value="3" {{ old('status') == '3' ? 'selected' : '' }}>Dipending
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <label class="mt-3">Keterangan</label>
                                    <div id="dipending_keterangan">
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3">Simpan Status</button>
                                @else
                                    <select id="status"
                                        class="form-control mt-1 @error('status') is-invalid @enderror" disabled>
                                        <option value="">:: Pilih ::</option>
                                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Menunggu
                                        </option>
                                        <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Diterima
                                        </option>
                                        <option value="3" {{ old('status') == '3' ? 'selected' : '' }}>Dipending
                                        </option>
                                    </select>
                                    @if ($stage2surveikepuasancustomer)
                                        @if ($stage2surveikepuasancustomer->dipending_keterangan)
                                            <label class="mt-3">Keterangan</label>
                                            <div>
                                                <textarea class="form-control" id="" cols="30" rows="10" style="background-color: white"
                                                    disabled>{{ $stage2surveikepuasancustomer->dipending_keterangan }}</textarea>
                                            </div>
                                            <button name="status" value="1" type="submit"
                                                class="btn btn-warning mt-3">Simpan
                                                Status Revisi</button>
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let id = $('#clientid').val();
        let listpermohonan_id = $('#listpermohonan_id').val();
        let statusid = $('#status').val();
        $.ajax({
            url: '/dashboard/statusapi/' + id + '/' + listpermohonan_id,
            method: 'get',
            dataType: 'json',
            success: function(response) {
                console.log(response);
                $('#status option[value="' + statusid + '"]').prop('selected', true);

                if (statusid == 3) {
                    $('#dipending_keterangan').html('');
                    let status = response.stage2surveikepuasancustomer.dipending_keterangan ?? '';

                    $('#dipending_keterangan').append(`
                        <textarea class='form-control' name='dipending_keterangan' cols="30" rows="10">` +
                        status + `</textarea>
                `);
                } else {
                    $('#dipending_keterangan').html('-');
                }
            }
        });

        $(document).on('change', '#status', function() {
            const idstatus = $(this).val();
            let listpermohonan_id = $('#listpermohonan_id').val();
            // console.log(idstatus);
            $.ajax({
                url: '/dashboard/statusapi/' + id + '/' + listpermohonan_id,
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    if (idstatus == 3) {
                        $('#dipending_keterangan').html('');
                        let status = response.stage2surveikepuasancustomer
                            .dipending_keterangan ?? '';

                        $('#dipending_keterangan').append(`
                                <textarea class='form-control' name='dipending_keterangan' cols="30" rows="10">` +
                            status + `</textarea>
                        `);
                    } else {
                        $('#dipending_keterangan').html('-');
                    }
                }
            });
        });
    </script>
@endsection
