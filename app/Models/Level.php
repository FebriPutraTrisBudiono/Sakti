<?php

namespace App\Models;

use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Level extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public static function routes()
    {
        $routeCollection = Route::getRoutes();
        $routes = [];
        foreach ($routeCollection as $value) {
            if ($value->uri()) {
                $nameExplode = explode('/', $value->uri());
                if (count($nameExplode) > 1 && $nameExplode[0] == 'dashboard') {
                    if ($value->getName()) {
                        $routes[] = $value->getName();
                    }
                }
            }
        }
        return collect($routes)->sort()->values();
    }

    public static function actionName($action)
    {
        $data = [
            [
                'id'        => 1,
                'action'    => 'index',
                'name'      => 'View'
            ],
            [
                'id'        => 2,
                'action'    => 'create',
                'name'      => 'Add'
            ],
            [
                'id'        => 3,
                'action'    => 'edit',
                'name'      => 'Edit'
            ],
            [
                'id'        => 4,
                'action'    => 'show',
                'name'      => 'Detail'
            ],
            [
                'id'        => 5,
                'action'    => 'store',
                'name'      => 'Insert'
            ],
            [
                'id'        => 6,
                'action'    => 'update',
                'name'      => 'Update'
            ],
            [
                'id'        => 7,
                'action'    => 'destroy',
                'name'      => 'Delete'
            ],
            [
                'id'        => 8,
                'action'    => 'confirmation',
                'name'      => 'confirmation'
            ],
            [
                'id'        => 9,
                'action'    => 'upload',
                'name'      => 'upload'
            ],
            [
                'id'        => 10,
                'action'    => 'download',
                'name'      => 'Download'
            ],
            [
                'id'        => 11,
                'action'    => 'view',
                'name'      => 'View'
            ],
            [
                'id'        => 12,
                'action'    => 'validasi',
                'name'      => 'Validasi Status'
            ],
            [
                'id'        => 13,
                'action'    => 'validasiupdate',
                'name'      => 'Validasi Status Update'
            ],
            [
                'id'        => 14,
                'action'    => 'prosessertifikasi',
                'name'      => 'Proses Sertifikasi'
            ],
            [
                'id'        => 15,
                'action'    => 'destroyprosessertifikasi',
                'name'      => 'Delete Proses Sertifikasi'
            ]
        ];

        return collect($data)->where('action', $action)->first();
    }
}
