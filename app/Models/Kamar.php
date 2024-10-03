<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kamar';

    protected $guarded = ['id',];

    public function kategori()
    {
        return $this->belongsTo(Category::class , 'category_id');
    }
}
