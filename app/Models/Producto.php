<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = "productos";

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'url_imagen',
        'like',
        'dislike',
        'user_id'
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }
}
