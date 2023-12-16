<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier_model extends Model
{
    use HasFactory;
    protected $table = 'panier';
    protected $fillable=[
        'name_produit',
        'img_produit',
        'prix',
        'description',
        'quantite',
        'utilisateur',
        'id',
        'nouvelle_colonne'
    ];
}
