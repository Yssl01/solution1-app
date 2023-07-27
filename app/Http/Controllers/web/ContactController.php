<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ContactController extends Controller
{

    /*      
     Get data with Query Building,
     Here we don't use the scoop's search because we can use Eloquent Collection  as long as the foreign key
     dosn't exist between the contact and organisation tables,
     if we want to use a collection we should alter table to add a foreign key */
    //
    public function index(Request $request){

        if( $request->search ){
                $contacts = DB::table('contact')
                ->join('organisation', 'organisation.id', '=', 'contact.organisation_id')
                ->select('contact.id','contact.nom', 'contact.prenom', 'organisation.nom as organisationNom', 'organisation.statut')
                ->where('contact.nom', 'like', '%'. $request->search.'%' )
                ->orWhere('contact.prenom', 'like', '%'. $request->search.'%' )
                ->orWhere('organisation.nom', 'like', '%'. $request->search.'%' )
                ->paginate(10);
        }
        else{
                $contacts = DB::table('contact')
                ->join('organisation', 'organisation.id', '=', 'contact.organisation_id')
                ->select('contact.id','contact.nom', 'contact.prenom', 'organisation.nom as organisationNom', 'organisation.statut')
                ->paginate(10);
        }

        return view('index', ['contacts' => $contacts ] );
    }
    //
    public function create(Request $request) {
 
        $Fields_contact = $request->validate([
            'nom'=> ['required','min:3', 'regex:/^[a-zA-zéèàçÉÈÀÇÃ]+$/u'],
            'prenom'=> ['required','min:3', 'regex:/^[a-zA-zéèàçÉÈÀÇÃ]+$/u'],
            'email'=> ['required', 'email'],
        ]);
        $Fields_contact['nom'] = ucwords($Fields_contact['nom']);
        $Fields_contact['prenom'] = ucwords($Fields_contact['prenom']);
        $Fields_contact['email'] =strtolower($Fields_contact['email']);
        //
        $Fields_organisation = $request->validate([
            'entreprise'=>['required', 'min:3','regex:/^[a-zA-z0-9,.\'" éèàçÉÈÀÇ]+$/u'],
            'adresse'=> ['required'],
            'code_postal'=>['required', 'min:3','regex:/^[0-9]+$/u'],
            'ville'=> ['required'],
            'statut'=> ['required'],
        ]);
        $Fields_organisation['entreprise'] = ucwords($Fields_organisation['entreprise']);
        $Fields_organisation['ville'] = ucwords($Fields_organisation['ville']);
        //
        if ( $request['confirmation'] != "true" ){
            if (DB::table('contact')->where('nom', $Fields_contact['nom'] )->where('prenom', $Fields_contact['prenom'])->exists()) {
                return ['Un contact existe déjà avec le même prénom et le même nom.'];
            }
    
            if (DB::table('organisation')->where('nom', $Fields_organisation['entreprise'])->exists()) {
                return ['Une entreprise existe déjà avec le même nom.'];
            }
        }

        $organisation_saved = DB::table('organisation')->insert([
            'cle' => str::random(32),
            'nom' => $Fields_organisation['entreprise'],
            'adresse' => $Fields_organisation['adresse'],
            'code_postal' => $Fields_organisation['code_postal'],
            'ville' => $Fields_organisation['ville'],
            'statut' => $Fields_organisation['statut'],
        ]);//
        
        if( $organisation_saved ){
             $id_organisation = DB::table('organisation')
              ->select('id')
              ->orderBy('id', 'DESC')->first();
              DB::table('contact')->insert([
                'cle' => str::random(32),
                'organisation_id'=> $id_organisation->id,
                'e_mail' => $Fields_contact['email'],
                'nom' => $Fields_contact['nom'],
                'prenom' => $Fields_contact['prenom'],
                'telephone_fixe' => 'xxx xxx xxx',
                'service' => 'service',
                'fonction' => 'fonction', 
            ]);//
        } 

        return ['success'];
    }
    //
    public function show(Request $request){

        $contact = DB::table('contact')
        ->join('organisation', 'organisation.id', '=', 'contact.organisation_id')
        ->select('contact.nom', 'contact.prenom', 'contact.e_mail', 'organisation.nom as organisationNom',
        'organisation.adresse', 'organisation.code_postal', 'organisation.ville', 'organisation.statut')
        ->where('contact.id', $request['contact_id'])
        ->get();

        return [ 'contact' => $contact ];
    }
    //
    public function Update(Request $request) {

   
        $Fields_contact = $request->validate([
            'nom'=> ['required','min:3', 'regex:/^[a-zA-zéèàçÉÈÀÇÃ]+$/u'],
            'prenom'=> ['required','min:3', 'regex:/^[a-zA-zéèàçÉÈÀÇÃ]+$/u'],
            'email'=> ['required', 'email'],
        ]);
        $Fields_contact['nom'] = ucwords($Fields_contact['nom']);
        $Fields_contact['prenom'] = ucwords($Fields_contact['prenom']);
        $Fields_contact['email'] =strtolower($Fields_contact['email']);
        //
        $Fields_organisation = $request->validate([
            'entreprise'=>['required', 'min:3','regex:/^[a-zA-z0-9,.\' éèàçÉÈÀÇ]+$/u'],
            'adresse'=> ['required'],
            'code_postal'=>['required', 'min:3','regex:/^[0-9]+$/u'],
            'ville'=> ['required'],
            'statut'=> ['required'],
        ]);
        $Fields_organisation['entreprise'] = ucwords($Fields_organisation['entreprise']);
        $Fields_organisation['ville'] = ucwords($Fields_organisation['ville']);
        //
        $id=$request['contact_id'];
        $organisation= DB::table('contact')
        ->select('organisation_id')
        ->where('id', $id )->first();

        DB::table('organisation')
        ->where('id', $organisation->organisation_id)
        ->update([
            'nom' => $Fields_organisation['entreprise'],
            'adresse' => $Fields_organisation['adresse'],
            'code_postal' => $Fields_organisation['code_postal'],
            'ville' => $Fields_organisation['ville'],
            'statut' => $Fields_organisation['statut'],
        ]);//

        DB::table('contact')
        ->where('id', $request['contact_id'])
        ->update([
                'e_mail' => $Fields_contact['email'],
                'nom' => $Fields_contact['nom'],
                'prenom' => $Fields_contact['prenom'],
        ]);//
 
        return ['success'];
    }
    //
    public function Delete(Request $request) {
        $id= $request['contact_id'];
        $organisation= DB::table('contact')
        ->select('organisation_id')
        ->where('id', $id )->first();

        DB::table('organisation')->where('id', $organisation->organisation_id)->delete();
        DB::table('contact')->where('id', $id)->delete();
        return ['success'];
    }


}
