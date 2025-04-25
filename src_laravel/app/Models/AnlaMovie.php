<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnlaMovie extends Model
{
    use HasFactory;

    protected $table = 'movies';

    protected $fillable = ['id', 'judul', 'sinopsis', 'category_id', 'tahun', 'pemain', 'foto_sampul'];

    public $incrementing = false;
    protected $keyType = 'string';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
