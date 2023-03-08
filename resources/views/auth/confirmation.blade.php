@extends('auth.template')
@section('content')
    <div class="container-xl px-4">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header justify-content-center">
                        <h3 class="fw-light my-0">{{ $title_bar }}</h3>
                    </div>
                    <div class="card-body">
                        {!! session('msg') !!}
                        <form action="/payment/confirmation/{{ $user->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @if ($payment)
                                @method('PUT')
                                <input type="hidden" name="id" id="id" value="{{ $payment->id }}">
                                <input type="hidden" name="status" id="status" value="{{ $payment->status }}">
                            @endif
                            <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                            <input type="hidden" name="fee_id" id="fee_id" value="{{ $fee->id }}">
                            <div class="mb-3">
                                <label class="small mb-1" for="name">Atas Nama</label>
                                <input readonly class="form-control @error('name') is-invalid @enderror" name="name"
                                    id="name" type="text" placeholder="Nama" value="{{ old('name', $user->name) }}"
                                    autofocus />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="fee">Biaya Registrasi</label>
                                <input readonly class="form-control @error('fee') is-invalid @enderror" id="fee"
                                    name="fee" type="text" placeholder="fee" value="{{ $fee->fee }}"
                                    onkeyup="strToNum('fee')" />
                                @error('fee')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="bank_id">Tujuan Pembayaran</label>
                                <select name="bank_id" id="bank_id"
                                    class="form-control @error('bank_id') is-invalid @enderror">
                                    <option value="">:: Pilih ::</option>
                                    @foreach ($banks as $row)
                                        <option value="{{ $row->id }}"
                                            {{ old('bank_id', $payment ? $payment->bank_id : '') == $row->id ? 'selected' : '' }}>
                                            {{ $row->bank_name }}
                                            {{ $row->number }} A/n.
                                            {{ $row->name }}</option>
                                    @endforeach
                                </select>
                                @error('bank_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="trx_amount">Jumlah Transfer</label>
                                <input class="form-control @error('trx_amount') is-invalid @enderror" id="trx_amount"
                                    name="trx_amount" type="text" placeholder="Jumlah Transfer"
                                    value="{{ old('trx_amount', $payment ? $payment->trx_amount : '') }}"
                                    onkeyup="strToNum('trx_amount')" />
                                @error('trx_amount')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    @if ($payment)
                                        <img src="{{ $payment->proof ? '/storage/' . $payment->proof : '/assets/img/noimage.jpeg' }}"
                                            class="img-thumbnail imagePreview" width="100px">
                                    @else
                                        <img src="/assets/img/noimage.jpeg" class="img-thumbnail imagePreview"
                                            width="100px">
                                    @endif
                                </div>
                                <div class="col-md-10 mb-3">
                                    <div class="form-group">
                                        <label for="proof">Bukti Transfer</label>
                                        <div class="input-group">
                                            <input type="file" name="proof" id="proof"
                                                class="form-control @error('proof') is-invalid @enderror"
                                                onchange="previewImage('proof', 'imagePreview')">
                                            @error('proof')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="message">Keterangan</label>
                                <textarea class="form-control @error('message') is-invalid @enderror" name="message" id="message" rows="5">{{ old('message', $payment ? $payment->notes : '') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="d-flex align-items-center justify-content-end mt-4 mb-0">
                                <a href="/auth" class="btn btn-danger">Kembali</a>
                                @if ($payment)
                                    <button type="submit" class="btn btn-primary ms-3">Perbarui</button>
                                @else
                                    <button type="submit" class="btn btn-primary ms-3">Konfirmasi</button>
                                @endif
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <div class="small text-muted text-uppercase">
                            &copy; {{ date('Y') }} - SAKTI INDONESIA
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
