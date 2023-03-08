<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sluggable(): array
    {
        return [
            'username' => [
                'source'    => 'name',
                'separator' => ''
            ]
        ];
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'id', 'user_id');
    }

    public function approvals()
    {
        return $this->hasMany(Payment::class, 'id', 'admin_id');
    }

    public function stage1penunjukantimaudit()
    {
        return $this->hasMany(Stage1penunjukantimaudit::class, 'nama_auditor', 'id');
    }

    public function scopeFilter($query, array $filters)
    {
        // menggunakan when arrow function
        if (isset($filters['status']) && $filters['status'] == '1') {
            $query->where('status', '=', 1);
        } elseif (isset($filters['status']) && $filters['status'] == '0') {
            $query->where('status', '=', 0);
        }

        $query->when(
            $filters['level'] ?? false,
            fn ($query, $level) => $query->where('level_id', $level)
        );

        $query->when(
            $filters['q'] ?? false,
            fn ($query, $search) => $query
                ->where('name', 'like', '%' . $search . '%')
        );
    }
}
