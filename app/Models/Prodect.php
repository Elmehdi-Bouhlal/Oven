<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodect extends Model
{
    use HasFactory;
    protected $table = 'info_prodect';
    protected $fillable=[
        'name',
        'prix',
        'description',
        'img_url'
    ];
}
