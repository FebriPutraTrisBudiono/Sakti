<?php

namespace App\Http\Controllers\BackEnd;

use App\Models\Bank;
use App\Models\User;
use App\Models\Client;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Setting;
use App\Rules\ReCaptcha;
use App\Mail\Confirmation;
use App\Mail\Registration;
use Illuminate\Support\Str;
use App\Mail\ForgotPassword;
use Illuminate\Http\Request;
use App\Models\Listpermohonan;
use App\Mail\ConfirmationAdmin;
use App\Models\RegistrationFee;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class LoginController extends Controller
{

    public function index()
    {
        $setting = Setting::where('id', 1)->first();
        return view('auth.index', [
            'title_bar' => 'Login',
            'setting'   =>  $setting
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|min:3|max:255',
            'password' => 'required|min:3|max:255',
            'g-recaptcha-response'  => ['required', new ReCaptcha]
        ]);

        $client = Client::firstWhere('idclient', $request->username);
        $user = $client != '' ? User::with('clients')->firstWhere('id', $client->user_id) : '';

        $login_type = $user == '' ? 'username' : 'id';

        if (Auth::attempt([
            $login_type  => $login_type == 'username' ? $request->username : $user->id,
            'password'  => $request->password,
            'status'    => 1
        ])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withInput()->with('msg', '<div class="alert small alert-danger small" role="alert">Username atau Password Salah!</div>');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/auth');
    }

    public function registration()
    {
        $setting = Setting::where('id', 1)->first();
        return view('auth.registration', [
            'title_bar' => 'Pendaftaran',
            'services'  => Service::all(),
            'setting'   =>  $setting
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'                  => 'required|min:3|max:255',
            'username'              => 'required|min:3|max:255|unique:users',
            'email'                 => 'required|min:3|max:255|email:dns|unique:users',
            'telp'                  => 'required|min:3|max:15',
            'password'              => 'required|min:3|max:255',
            'service_id'            => 'required',
            'g-recaptcha-response'  => ['required', new ReCaptcha]
        ]);

        $data['name'] = $request->name;
        $data['username'] = $request->username;
        $data['email'] = $request->email;
        $data['telp'] = $request->telp;
        $data['level_id'] = 2;
        $data['password'] = Hash::make($request->password);
        $data['email_verified_at'] = now();
        $data['remember_token'] = Str::random(10);
        // Save to database
        $saved = User::create($data);

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
        $client_data['user_id'] = $saved->id;
        $client_data['service_id'] = $request->service_id;
        $client_data['nomor_client'] = $nomor;
        $client_data['idclient'] = $service->service_code . '-' . $nomor;
        // Save to database
        $client = Client::create($client_data);

        $listpermohonan['client_id'] = $client->id;
        $listpermohonan['proses_sertifikasi'] = $service->name;
        $listpermohonan['slug'] = 'sertifikasi_awal';
        // Save to database
        Listpermohonan::create($listpermohonan);

        if ($saved) {
            $saved['fee'] = RegistrationFee::find(1);
            $saved['banks'] = Bank::all();
            Mail::to($saved->email)->send(new Registration($saved));
        }
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Pendaftaran berhasil!</div>');
    }

    public function confirmation(User $user)
    {
        $payment = Payment::where('user_id', $user->id)->orderBy('id', 'DESC')->first();
        return view('auth.confirmation', [
            'title_bar' => 'Konfirmasi Pembayaran',
            'user'      => $user,
            'fee'       => RegistrationFee::find(1),
            'banks'     => Bank::all(),
            'payment'   => $payment ? $payment : null
        ]);
    }

    public function confirmed(User $user, Request $request)
    {
        $data = $request->validate([
            'user_id'       => 'required',
            'fee_id'        => 'required',
            'bank_id'       => 'required',
            'trx_amount'    => 'required'
        ]);

        if ($request->hasFile('proof')) {
            $data['proof'] = $request->proof->store('payments');
        }

        $last = Payment::orderBy('id', 'DESC')->first();
        if ($last) {
            $urutan = (int) substr($last->number, 4, 10);
            $urutan++;
            $huruf = 'INV-';
            $nomor = $huruf . sprintf("%07s", $urutan);
        } else {
            $nomor = 'INV-' . '0000001';
        }

        $data['number'] = $nomor;
        $data['trx_amount'] = Str::replace(['.', ','], ['', '.'], $request->trx_amount);
        $data['trx_date'] = now();
        $data['notes'] = $request->message;
        $data['status'] = 1;
        $created = Payment::create($data);

        // send email to user
        $result = Payment::with(['user', 'fee', 'bank'])->where('number', $created->number)->first();
        Mail::to($result->user->email)->send(new Confirmation($result));

        // send email to admin
        $result['admin'] = User::find(1);
        Mail::to($result['admin']->email)->send(new ConfirmationAdmin($result));
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Konfirmasi pembayaran berhasil dikirim!</div>');
    }

    public function confirmupdate(User $user, Request $request)
    {
        $data = $request->validate([
            'id'            => 'required',
            'user_id'       => 'required',
            'fee_id'        => 'required',
            'bank_id'       => 'required',
            'trx_amount'    => 'required',
            'status'        => 'required'
        ]);

        if ($request->hasFile('proof')) {
            $pay = Payment::find($request->id);
            if ($pay->proof) {
                Storage::delete($pay->proof);
            }
            $data['proof'] = $request->proof->store('payments');
        }

        $data['trx_amount'] = Str::replace(['.', ','], ['', '.'], $request->trx_amount);
        $data['notes'] = $request->message;
        Payment::where('id', $request->id)->update($data);
        return back()->with('msg', '<div class="alert alert-success small" role="alert">Konfirmasi pembayaran berhasil diperbarui!</div>');
    }

    public function forgot()
    {
        return view('auth.forgot', [
            'title_bar' => 'Lupa Password'
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'username'              => 'required|min:3|max:255',
            'g-recaptcha-response'  => ['required', new ReCaptcha]
        ]);

        $data['username'] = $request->username;
        $data['status'] = 1;
        $user = User::firstWhere($data);
        if ($user) {
            // sendmail
            Mail::to($user->email)->send(new ForgotPassword($user));

            return back()->with('msg', '<div class="alert alert-success small" role="alert">Konfirmasi lupa password telah berhasil terkirim ke <strong>' . $user->email . '</strong></div>');
        } else {
            return back()->with('msg', '<div class="alert alert-danger small" role="alert">Username tidak terdaftar!</div>');
        }
    }

    public function newpassword(Request $request)
    {
        $data = $request->validate([
            'username'          => 'required|min:3|max:255',
            'remember_token'    => 'required|min:10|max:255'
        ]);
        $data['status'] = 1;
        $user = User::firstWhere($data);
        if ($user) {
            return view('auth.newpassword', [
                'title_bar' => 'Buat Password Baru',
                'user'      => $user
            ]);
        } else {
            return redirect('/auth/forgot')->with('msg', '<div class="alert alert-danger small" role="alert">Username atau token tidak valid!</div>');
        }
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'username'              => $request->username !== $user->username ? 'required|min:3|max:255|unique:users' : 'required|min:3|max:255',
            'email'                 => $request->email !== $user->email ? 'required|email:dns|min:5|max:255|unique:users' : 'required|email:dns|min:5|max:255',
            'password'              => 'required|min:3|max:255',
            'g-recaptcha-response'  => ['required', new ReCaptcha]
        ]);

        $data['email']  = $request->email !== $user->email ? $request->email : $user->email;
        $data['username'] = $request->username !== $user->username ? SlugService::createSlug(User::class, 'username', $user->name) : $user->username;
        $data['password'] = Hash::make($request->password);
        $data['remember_token'] = Str::random(10);
        User::where('id', $user->id)->update($data);
        return redirect('/auth')->with('msg', '<div class="alert alert-success small" role="alert">Password berhasil diubah, silahkan login!</div>');
    }
}
