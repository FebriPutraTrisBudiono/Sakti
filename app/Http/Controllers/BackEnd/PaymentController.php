<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Mail\ConfirmationSuccess;
use App\Models\Client;
use App\Models\Level;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function index()
    {
        $bagian = Level::where('id', auth()->user()->level_id)->first();
        $roles = explode(',', $bagian['access']);

        return view('dashboard.payments', [
            'title_bar' => 'Pembayaran',
            'payments'  => Payment::latest()->paginate(100),
            'roles'     => $roles
        ]);
    }

    public function show(Request $request)
    {
        $payment = Payment::with(['user'])->find($request->id);
        return response()->json($payment);
    }

    public function confirmation(Payment $payment, Request $request)
    {
        $data = $request->validate([
            'status' => 'required'
        ]);

        Payment::where('id', $payment->id)->update($data);
        $payment = Payment::with(['user', 'fee', 'bank'])->find($payment->id);
        if ($request->status != 1) {
            User::where('id', $payment->user->id)->update(['status' => $payment->status == 2 ? 1 : 0]);
            Mail::to($payment->user->email)->send(new ConfirmationSuccess($payment));
        }

        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil disimpan!</div>');
    }

    public function destroy(Payment $payment)
    {
        Payment::destroy($payment->id);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Berhasil dihapus!</div>');
    }
}
