<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerbitansertifikat extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id')->with('service', 'user');
    }
    public function listpermohonan()
    {
        return $this->belongsTo(Listpermohonan::class, 'listpermohonan_id', 'id');
    }
}
