@extends('dashboard.template')
@section('content')
    <div class="container-xl px-4 mt-n10">
        <div class="row">
            <div class="col-lg">
                <form
                    action="/dashboard/stage1kajiantimaudits{{ $stage1kajiantimaudit ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
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

                            @if ($stage1kajiantimaudit)
                                @method('PUT')
                            @endif

                            <input type="hidden" value="{{ $client->id }}" name="client_id">
                            <input type="hidden" value="{{ $listpermohonan_id->id }}" name="listpermohonan_id">
                            <input type="hidden" value="{{ $listpermohonan_slug }}" name="listpermohonan_slug">

                            <div class="col-12 grid-margin stretch-card">
                                <div>
                                    <div class="card-body">
                                        <h4 style="text-align: center;" class="card-title border-bottom mb-4">KAJIAN
                                            TIM
                                            AUDIT
                                        </h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Klien</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control @error('nama_pimpinan') is-invalid @enderror mt-1"
                                                            id="nama_pimpinan" name="nama_pimpinan"
                                                            value="{{ old('nama_pimpinan', $permohonanclient->nama_pimpinan ?? '') }}"
                                                            readonly />
                                                        @error('nama_pimpinan')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Lingkup Sertifikasi</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control mt-1 @error('ruang_lingkup_perusahaan') is-invalid @enderror"
                                                            id="ruang_lingkup_perusahaan" name="ruang_lingkup_perusahaan"
                                                            value="{{ old('ruang_lingkup_perusahaan', $permohonanclient->ruang_lingkup_perusahaan ?? '') }}"
                                                            readonly />
                                                        @error('ruang_lingkup_perusahaan')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label>Standart</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control @error('standart') is-invalid @enderror mt-1"
                                                            id="standart" name="standart"
                                                            value="{{ old('standart', $rencanaclient->standart ?? '') }}"
                                                            readonly />
                                                        @error('standart')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group row">
                                                    <label>Kompetensi</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control @error('hasil2_answer') is-invalid @enderror"
                                                            id="hasil2_answer" name="hasil2_answer"
                                                            value="{{ old('hasil2_answer', $kajianclient->hasil2_answer ?? '') }}"
                                                            readonly />
                                                        @error('hasil2_answer')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col mb-3 mt-3">
                                            <h6 class="card-title border-bottom mb-4">USULAN TIM
                                                AUDIT</h6>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label>Lead Auditor</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('hasil3_lead1') is-invalid @enderror" name="hasil3_lead1" id="hasil3_lead1"
                                                                readonly>{{ old('hasil3_lead1', $hasil3_lead1->name ?? '') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label>Auditor</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('hasil3_auditor1') is-invalid @enderror" name="hasil3_auditor1"
                                                                id="hasil3_auditor1" readonly>{{ old('hasil3_auditor1', $hasil3_auditor1->name ?? '') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label>Tenaga Ahli</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('hasil3_tenaga1') is-invalid @enderror" name="hasil3_tenaga1" id="hasil3_tenaga1"
                                                                readonly>{{ old('hasil3_tenaga1', $hasil3_tenaga1->name ?? '') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label>Lead Auditor</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('hasil3_lead2') is-invalid @enderror" name="hasil3_lead2" id="hasil3_lead2"
                                                                readonly>{{ old('hasil3_lead2', $hasil3_lead2->name ?? '-') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label>Auditor</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('hasil3_auditor2') is-invalid @enderror" name="hasil3_auditor2"
                                                                id="hasil3_auditor2" readonly>{{ old('hasil3_auditor2', $hasil3_auditor2->name ?? '-') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label>Tenaga Ahli</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('hasil3_tenaga2') is-invalid @enderror" name="hasil3_tenaga2" id="hasil3_tenaga2"
                                                                readonly>{{ old('hasil3_tenaga2', $hasil3_tenaga2->name ?? '-') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label>Lead Auditor</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('hasil3_lead3') is-invalid @enderror" name="hasil3_lead3" id="hasil3_lead3"
                                                                readonly>{{ old('hasil3_lead3', $hasil3_lead3->name ?? '-') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label>Auditor</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('hasil3_auditor3') is-invalid @enderror" name="hasil3_auditor3"
                                                                id="hasil3_auditor3" readonly>{{ old('hasil3_auditor3', $hasil3_auditor3->name ?? '-') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label>Tenaga Ahli</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('hasil3_tenaga3') is-invalid @enderror" name="hasil3_tenaga3"
                                                                id="hasil3_tenaga3" readonly>{{ old('hasil3_tenaga3', $hasil3_tenaga3->name ?? '-') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-5">
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label>Rencana Pelaksanaan</label>
                                                    <div class="col-sm-12">
                                                        <input type="text"
                                                            class="form-control @error('rencana_pelaksanaan') is-invalid @enderror"
                                                            name="rencana_pelaksanaan" id="rencana_pelaksanaan"
                                                            value="{{ old('rencana_pelaksanaan', $stage1kajiantimaudit->rencana_pelaksanaan ?? '') }}" />
                                                        @error('rencana_pelaksanaan')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h6 class="card-title mb-3 border-bottom mb-4">KAJIAN</h6>
                                        <div class="col-sm-12 mb-3">
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-form-label">Apakah tim audit yang diusulkan
                                                    memiliki kompetensi terhadap permohonan yang diajukan
                                                </label>
                                                <div class="col-sm-3">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio"
                                                                class="form-check-input @error('kajian1_question') is-invalid @enderror"
                                                                name="kajian1_question" id="kajian1_question"
                                                                value="1"
                                                                {{ old('kajian1_question', $stage1kajiantimaudit->kajian1_question ?? '') == '1' ? 'checked' : '' }} />
                                                            Ya
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio"
                                                                class="form-check-input @error('kajian1_question') is-invalid @enderror"
                                                                name="kajian1_question" id="kajian1_question"
                                                                value="0"
                                                                {{ old('kajian1_question', $stage1kajiantimaudit->kajian1_question ?? '') == '0' ? 'checked' : '' }} />
                                                            Tidak
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mb-3">
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-form-label">Apakah tim audit membutuhkan
                                                    tenaga
                                                    ahli
                                                    dalam
                                                    pelaksanaan audit
                                                </label>
                                                <div class="col-sm-3">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio"
                                                                class="form-check-input @error('kajian2_question') is-invalid @enderror"
                                                                name="kajian2_question" id="kajian2_question"
                                                                value="1"
                                                                {{ old('kajian2_question', $stage1kajiantimaudit->kajian2_question ?? '') == '1' ? 'checked' : '' }} />
                                                            Ya
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio"
                                                                class="form-check-input @error('kajian2_question') is-invalid @enderror"
                                                                name="kajian2_question" id="kajian2_question"
                                                                value="0"
                                                                {{ old('kajian2_question', $stage1kajiantimaudit->kajian2_question ?? '') == '0' ? 'checked' : '' }} />
                                                            Tidak
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mb-3">
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-form-label">Apakah tim audit yang
                                                    ditugaskan
                                                    memiliki hubungan
                                                    dengan klien yang akan diaudit
                                                </label>
                                                <div class="col-sm-3">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio"
                                                                class="form-check-input @error('kajian3_question') is-invalid @enderror"
                                                                name="kajian3_question" id="kajian3_question"
                                                                value="1"
                                                                {{ old('kajian3_question', $stage1kajiantimaudit->kajian3_question ?? '') == '1' ? 'checked' : '' }} />
                                                            Ya
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio"
                                                                class="form-check-input @error('kajian3_question') is-invalid @enderror"
                                                                name="kajian3_question" id="kajian3_question"
                                                                value="0"
                                                                {{ old('kajian3_question', $stage1kajiantimaudit->kajian3_question ?? '') == '0' ? 'checked' : '' }} />
                                                            Tidak
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mb-3">
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-form-label">Apakah tim audit yang
                                                    ditugaskan
                                                    merupakan konsultan
                                                    yang membantu penyusunan
                                                    dokumentasi klien
                                                </label>
                                                <div class="col-sm-3">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio"
                                                                class="form-check-input @error('kajian4_question') is-invalid @enderror"
                                                                name="kajian4_question" id="kajian4_question"
                                                                value="1"
                                                                {{ old('kajian4_question', $stage1kajiantimaudit->kajian4_question ?? '') == '1' ? 'checked' : '' }} />
                                                            Ya
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio"
                                                                class="form-check-input @error('kajian4_question') is-invalid @enderror"
                                                                name="kajian4_question" id="kajian4_question"
                                                                value="0"
                                                                {{ old('kajian4_question', $stage1kajiantimaudit->kajian4_question ?? '') == '0' ? 'checked' : '' }} />
                                                            Tidak
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 mb-5">
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-form-label">Apakah tim audit pernah
                                                    melakukan
                                                    internal audit kepada
                                                    klien dalam 2 tahun terakhir
                                                </label>
                                                <div class="col-sm-3">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio"
                                                                class="form-check-input @error('kajian5_question') is-invalid @enderror"
                                                                name="kajian5_question" id="kajian5_question"
                                                                value="1"
                                                                {{ old('kajian5_question', $stage1kajiantimaudit->kajian5_question ?? '') == '1' ? 'checked' : '' }} />
                                                            Ya
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="radio"
                                                                class="form-check-input @error('kajian5_question') is-invalid @enderror"
                                                                name="kajian5_question" id="kajian5_question"
                                                                value="0"
                                                                {{ old('kajian5_question', $stage1kajiantimaudit->kajian5_question ?? '') == '0' ? 'checked' : '' }} />
                                                            Tidak
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col mb-3 mt-3">
                                            <h6 class="card-title border-bottom mb-4">USULAN TIM
                                                AUDIT</h6>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label>Lead Auditor</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('hasil3_lead1') is-invalid @enderror" name="hasil3_lead1" id="hasil3_lead1"
                                                                readonly>{{ old('hasil3_lead1', $hasil3_lead1->name ?? '') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label>Auditor</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('hasil3_auditor1') is-invalid @enderror" name="hasil3_auditor1"
                                                                id="hasil3_auditor1" readonly>{{ old('hasil3_auditor1', $hasil3_auditor1->name ?? '') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label>Tenaga Ahli</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('hasil3_tenaga1') is-invalid @enderror" name="hasil3_tenaga1"
                                                                id="hasil3_tenaga1" readonly>{{ old('hasil3_tenaga1', $hasil3_tenaga1->name ?? '') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label>Lead Auditor</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('hasil3_lead2') is-invalid @enderror" name="hasil3_lead2" id="hasil3_lead2"
                                                                readonly>{{ old('hasil3_lead2', $hasil3_lead2->name ?? '-') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label>Auditor</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('hasil3_auditor2') is-invalid @enderror" name="hasil3_auditor2"
                                                                id="hasil3_auditor2" readonly>{{ old('hasil3_auditor2', $hasil3_auditor2->name ?? '-') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label>Tenaga Ahli</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('hasil3_tenaga2') is-invalid @enderror" name="hasil3_tenaga2"
                                                                id="hasil3_tenaga2" readonly>{{ old('hasil3_tenaga2', $hasil3_tenaga2->name ?? '-') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label>Lead Auditor</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('hasil3_lead3') is-invalid @enderror" name="hasil3_lead3" id="hasil3_lead3"
                                                                readonly>{{ old('hasil3_lead3', $hasil3_lead3->name ?? '-') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label>Auditor</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('hasil3_auditor3') is-invalid @enderror" name="hasil3_auditor3"
                                                                id="hasil3_auditor3" readonly>{{ old('hasil3_auditor3', $hasil3_auditor3->name ?? '-') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group row">
                                                        <label>Tenaga Ahli</label>
                                                        <div class="col-sm-12">
                                                            <textarea class="form-control @error('hasil3_tenaga3') is-invalid @enderror" name="hasil3_tenaga3"
                                                                id="hasil3_tenaga3" readonly>{{ old('hasil3_tenaga3', $hasil3_tenaga3->name ?? '-') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col mb-3 mt-5">
                                            <h6 class="card-title border-bottom mb-4">TANGGAL TTD</h6>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="tanggal_ttd">Tanggal</label>
                                                        <input
                                                            class="form-control mt-1 @error('tanggal_ttd') is-invalid @enderror"
                                                            name="tanggal_ttd" type="date" id="tanggal_ttd"
                                                            value="{{ old('tanggal_ttd', $stage1kajiantimaudit->tanggal_ttd ?? '') }}" />
                                                        @error('tanggal_ttd')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="a1_nama">Nama Manager Sertifikasi</label>
                                                        <input
                                                            class="form-control mt-1 @error('nama_manager') is-invalid @enderror"
                                                            name="nama_manager" type="text" id="nama_manager"
                                                            value="{{ old('nama_manager', $stage1kajiantimaudit->nama_manager ?? '') }}" />
                                                        @error('nama_manager')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($stage1kajiantimaudit == '')
                                            @if (in_array('F-CER-39 - Kajian Tim Audit.store', $roles))
                                                <button type="submit" class="btn btn-primary mr-2">
                                                    Simpan
                                                </button>
                                            @endif
                                        @elseif ($stage1kajiantimaudit->status != 2)
                                            @if (in_array('F-CER-39 - Kajian Tim Audit.update', $roles))
                                                <button type="submit" class="btn btn-primary mr-2">
                                                    Simpan
                                                </button>
                                            @endif
                                        @endif

                                        @if ($stage1kajiantimaudit)
                                            @if (in_array('F-CER-39 - Kajian Tim Audit.download', $roles))
                                                <a href="/dashboard/stage1kajiantimaudits/download/{{ $stage1kajiantimaudit->id }}"
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
                @if ($stage1kajiantimaudit)
                    <form
                        action="/dashboard/stage1kajiantimauditsvalidasi{{ $stage1kajiantimaudit ? '/' . $client->id . '/' . $listpermohonan_id->id : '' }}"
                        method="post">
                        @csrf

                        @if ($stage1kajiantimaudit)
                            @method('PUT')
                        @endif

                        <input type="hidden" id="clientid" value="{{ $client->id ?? '' }}">
                        <input type="hidden" id="listpermohonan_id" value="{{ $listpermohonan_id->id ?? '' }}">
                        <input type="hidden" id="status" value="{{ $stage1kajiantimaudit->status ?? '' }}">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h4 class="card-title">Status</h4>
                                @if (in_array('F-CER-39 - Kajian Tim Audit.validasi', $roles))
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
                                    @if ($stage1kajiantimaudit)
                                        @if ($stage1kajiantimaudit->dipending_keterangan)
                                            <label class="mt-3">Keterangan</label>
                                            <div>
                                                <textarea class="form-control" id="" cols="30" rows="10" style="background-color: white"
                                                    disabled>{{ $stage1kajiantimaudit->dipending_keterangan }}</textarea>
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
                    let status = response.stage1kajiantimaudit.dipending_keterangan ?? '';

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
                        let status = response.stage1kajiantimaudit
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
