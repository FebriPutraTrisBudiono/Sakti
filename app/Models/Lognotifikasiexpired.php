<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lognotifikasiexpired extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function penerbitansertifikat()
    {
        return $this->belongsTo(Penerbitansertifikat::class, 'penerbitsertifikat_id', 'id')->with('client', 'listpermohonan');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id')->with('user');
    }
}
