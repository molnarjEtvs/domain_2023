<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class domainController extends Controller
{
    public function listazas(){
        $domainek = DB::table('domainek')->paginate(30);
        return view("welcome",["domainek" => $domainek]);
    }

    public function domainForm(){
        return view("domainform");
    }

    public function domainRogzites(Request $req){
        $req->validate(
            [
                "domain_nev" => "required|min:3|max:30|unique:domainek,domain_nev", //Formailag még ellenőrizni kell
                "domain_nev_human" => "required|min:3|max:30|unique:domainek,domain_nev_human", //Formailag még ellenőrizni kell
                "lejarati_ido" => "required|date_format:Y-m-d" 
            ],
            [
                "domain_nev.required" => "A mező kitöltése kötelező!",
                "domain_nev.min" => "Minimum 3 karaktert meg kell adnod",
                "domain_nev.max" => "Maximum 30 karaktert lehet megadni",
                "domain_nev.unique" => "Ez a domain név már rögzítésre került!",     

                "domain_nev_human.required" => "A mező kitöltése kötelező!",
                "domain_nev_human.min" => "Minimum 3 karaktert meg kell adnod",
                "domain_nev_human.max" => "Maximum 30 karaktert lehet megadni",
                "domain_nev_human.unique" => "Ez a domain név már rögzítésre került!",
                
                "lejarati_ido.required" => "A mező kitöltése kötelező!",
                "lejarati_ido.date_format" => "Az alábbi formátumban kell megadnod: YYYY-mm-hh"      
            ]
        );
        $domain_nev = trim($req->domain_nev);
        $domain_nev_human = trim($req->domain_nev_human);

        DB::insert("INSERT INTO domainek (domain_nev, domain_nev_human, lejarati_ido, rogzitesi_ido) VALUES (?,?,?,?)",[$domain_nev,$domain_nev_human,$req->lejarati_ido,date('Y-m-d H:i:s')]);
        return redirect(Route('domainRogzites'))->with('rogzitve','Rögzítés sikeres!');


    }
}
