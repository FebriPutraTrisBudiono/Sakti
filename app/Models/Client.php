<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function permohonansertifikasi()
    {
        return $this->hasMany(Permohonansertifikasi::class, 'client_id', 'id');
    }

    public function permohonansertifikasi_data($id)
    {
        return $this->permohonansertifikasi()->where('listpermohonan_id', '=', $id);
    }

    public function kajianclient()
    {
        return $this->hasMany(Kajianclient::class, 'client_id', 'id');
    }

    public function kajianclient_data($id)
    {
        return $this->kajianclient()->where('listpermohonan_id', '=', $id);
    }

    public function perjanjianclient()
    {
        return $this->hasMany(Perjanjianclient::class, 'client_id', 'id');
    }

    public function perjanjianclient_data($id)
    {
        return $this->perjanjianclient()->where('listpermohonan_id', '=', $id);
    }

    public function rencanaclient()
    {
        return $this->hasMany(Rencanaclient::class, 'client_id', 'id');
    }

    public function rencanaclient_data($id)
    {
        return $this->rencanaclient()->where('listpermohonan_id', '=', $id);
    }

    public function stage1kajiantimaudit()
    {
        return $this->hasMany(Stage1kajiantimaudit::class, 'client_id', 'id');
    }

    public function stage1kajiantimaudit_data($id)
    {
        return $this->stage1kajiantimaudit()->where('listpermohonan_id', '=', $id);
    }

    public function stage1penunjukantimaudit()
    {
        return $this->hasMany(Stage1penunjukantimaudit::class, 'client_id', 'id');
    }

    public function stage1penunjukantimaudit_data($id)
    {
        return $this->stage1penunjukantimaudit()->where('listpermohonan_id', '=', $id);
    }

    public function stage1checkaudit()
    {
        return $this->hasMany(Stage1checkaudit::class, 'client_id', 'id');
    }

    public function stage1checkaudit_data($id)
    {
        return $this->stage1checkaudit()->where('listpermohonan_id', '=', $id);
    }

    public function stage2rencanaaudit()
    {
        return $this->hasMany(Stage2rencanaaudit::class, 'client_id', 'id');
    }

    public function stage2rencanaaudit_data($id)
    {
        return $this->stage2rencanaaudit()->where('listpermohonan_id', '=', $id);
    }

    public function stage2checkaudit()
    {
        return $this->hasMany(Stage2checkaudit::class, 'client_id', 'id');
    }

    public function stage2checkaudit_data($id)
    {
        return $this->stage2checkaudit()->where('listpermohonan_id', '=', $id);
    }

    public function stage2daftarhadiraudit()
    {
        return $this->hasMany(Stage2daftarhadiraudit::class, 'client_id', 'id');
    }

    public function stage2daftarhadiraudit_data($id)
    {
        return $this->stage2daftarhadiraudit()->where('listpermohonan_id', '=', $id);
    }

    public function stage2laporanaudit()
    {
        return $this->hasMany(Stage2laporanaudit::class, 'client_id', 'id');
    }

    public function stage2laporanaudit_data($id)
    {
        return $this->stage2laporanaudit()->where('listpermohonan_id', '=', $id);
    }

    public function stage2ketidaksesuaianpage()
    {
        return $this->hasMany(Stage2ketidaksesuaianpage::class, 'client_id', 'id');
    }

    public function stage2ketidaksesuaianpage_data($id)
    {
        return $this->stage2ketidaksesuaianpage()->where('listpermohonan_id', '=', $id);
    }

    public function stage2surveikepuasancustomer()
    {
        return $this->hasMany(Stage2surveikepuasancustomer::class, 'client_id', 'id');
    }

    public function stage2surveikepuasancustomer_data($id)
    {
        return $this->stage2surveikepuasancustomer()->where('listpermohonan_id', '=', $id);
    }

    public function stage2temuanverication()
    {
        return $this->hasMany(Stage2temuanverifcation::class, 'client_id', 'id');
    }

    public function stage2temuanverifcation_data($id)
    {
        return $this->stage2temuanverication()->where('listpermohonan_id', '=', $id);
    }

    public function logawalsertifikasi()
    {
        return $this->hasMany(Logawalcertification::class, 'id', 'client_id');
    }

    public function reviewkeputusansertifikasi()
    {
        return $this->hasMany(Reviewkeputusansertifikasi::class, 'client_id', 'id');
    }

    public function reviewkeputusansertifikasi_data($id)
    {
        return $this->reviewkeputusansertifikasi()->where('listpermohonan_id', '=', $id);
    }

    public function memopenerbitansertifikasi()
    {
        return $this->hasMany(Memopenerbitansertifikasi::class, 'client_id', 'id');
    }

    public function memopenerbitansertifikasi_data($id)
    {
        return $this->memopenerbitansertifikasi()->where('listpermohonan_id', '=', $id);
    }

    public function evaluasisatusiklussertifikasi()
    {
        return $this->hasMany(Evaluasisatusiklussertifikasi::class, 'client_id', 'id');
    }
    public function evaluasisatusiklussertifikasi_data($id)
    {
        return $this->evaluasisatusiklussertifikasi()->where('listpermohonan_id', '=', $id);
    }

    public function penerbitansertifikat()
    {
        return $this->hasMany(Penerbitansertifikat::class, 'client_id', 'id');
    }

    public function penerbitansertifikat_data($id)
    {
        return $this->penerbitansertifikat()->where('listpermohonan_id', '=', $id);
    }

    public function lognotifikasiexpired()
    {
        return $this->hasMany(Lognotifikasiexpired::class, 'client_id', 'id');
    }

    public function permohonans()
    {
        return $this->hasMany(Permohonan::class, 'id', 'client_id');
    }

    public static function statuses()
    {
        $statuses = [
            ['id' => 1, 'name' => 'Menunggu'],
            ['id' => 2, 'name' => 'Diterima'],
            ['id' => 3, 'name' => 'Dipending']
        ];
        return collect($statuses);
    }

    public function scopeFilter($query, array $filters)
    {
        // menggunakan when arrow function
        $query->when(($filters['startdate'] ?? false) && ($filters['enddate'] ?? false) ? [$filters['startdate'], $filters['enddate']] : false,
            fn ($query, $dates) => $query->whereDate('created_at', '>=', Carbon::createFromFormat('Y-m-d', $dates[0]))
                ->whereDate('created_at', '<=', Carbon::createFromFormat('Y-m-d', $dates[1]))
        );

        $query->when(
            $filters['service'] ?? false,
            fn ($query, $service) => $query->where('service_id', $service)
        );

        $query->when(
            $filters['user'] ?? false,
            fn ($query, $user) => $query->where('user_id', $user)
        );

        $query->when(
            $filters['clientid'] ?? false,
            fn ($query, $search) => $query
                ->where('idclient', 'like', $search)
                ->OrWhereRelation('service', 'service_code', 'like', '%' . $search . '%')
        );

        if (isset($filters['status']) && $filters['status'] == '1') {
            $query->whereRelation('lognotifikasiexpired', 'status', '=', 1);
        } elseif (isset($filters['status']) && $filters['status'] == '0') {
            $query->whereRelation('lognotifikasiexpired', 'status', '=', 0);
        }
    }
}
