<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contact';

    protected $fillable = [
        'cle',
        'organisation_id',
        'e_mail',
        'nom',
        'prenom',
        'telephone_fixe',
        'service',
        'fonction', 
        
    ];

/* If you want to use the scope, you should use Elequant instead Query Building,

then you can uncomment the code below. */

/*     // filter search
    public function scopeFilter($query, array $filter) {

        //if not a search do nothing
        if($filter['search'] ?? false) {
            $query->where('contact.nom', 'like', '%' . request('search') . '%')
            ->orWhere('contact.prenom', 'like', '%' . request('search') . '%')
            ->orWhere('contact.organisationNom', 'like', '%' . request('search') . '%');
        }
    
    } */


 /*    public function organisation() : BelongsTo{
        return $this->belongsTo(Organisation::class, 'organisation_id');
    } */

}

