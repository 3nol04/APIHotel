<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Pelanggan extends Authenticatable
{

    use HasFactory,HasUuids,HasApiTokens;

    protected $table = 'pelanggans';
    protected $primaryKey = 'id_pelanggan';
    protected $guarded = ['id_pelanggan'];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_pelanggan', 'id_pelanggan');
    }

}
