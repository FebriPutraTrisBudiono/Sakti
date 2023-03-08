<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listpermohonan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function penerbitansertifikat()
    {
        return $this->belongsTo(Penerbitansertifikat::class, 'listpermohonan_id', 'id');
    }
}
