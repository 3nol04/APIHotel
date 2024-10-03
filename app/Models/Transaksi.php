<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory,HasUuids;

    protected $primaryKey = 'id_transaksi';
    protected $guarded = ['id_transaksi'];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class , 'id_kamar');
    }
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class , 'id_Pelanggan');
    }


}
