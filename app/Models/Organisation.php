<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organisation extends Model
{
    use HasFactory;
    protected $table = 'organisation';

    protected $fillable = [
        'cle',
        'nom',
        'adresse',
        'code_postal',
        'ville',
        'statut',
    ];

/* If you want to use the scope, you should use Elequant instead Query Building,

then you can uncomment the code below. */

    /* public function contacts() : HasMany {
        return $this->hasMany(Contact::class, 'organisation_id');
        } */

}
