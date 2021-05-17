<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    protected $hidden = ["created_at", "updated_at"];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
