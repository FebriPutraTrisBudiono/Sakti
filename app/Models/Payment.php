<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function fee()
    {
        return $this->belongsTo(RegistrationFee::class, 'fee_id', 'id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function approval()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }

    public static function generateInv()
    {
        $last = Payment::orderBy('id', 'DESC')->first();
        if ($last) {
            $lastNumb = $last ? intval(str_replace('GL-', '', $last->number)) : 0;
            $valNumb = intval($lastNumb) + 1;
            $nomor = 'INV-' . str_pad($valNumb, 6, "0", STR_PAD_LEFT);
            return $nomor;
        } else {
            return 'INV-000001';
        }
    }
}
