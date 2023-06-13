<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class domainController extends Controller
{
    public function listazas(Request $req){
        $domain = "";
        $aktiv = "";
        $wheres = [];
        if($req->get('aktiv') != ""){

            $aktiv = $req->get('aktiv');

            if($req->get('aktiv') == "lejart"){
                $wheres[] = ['lejarati_ido','<',date('Y-m-d')];
                
            }
            if($req->get('aktiv') == "aktiv"){
                $wheres[] = ['lejarati_ido','>=',date('Y-m-d')];
            } 
        }

        if($req->get('domain') != ""){
            $domain = $req->get('domain');
            $wheres[] = ['domain_nev','like','%'.$domain.'%'];
        }
        
        if($req->get('domain') == "" && $req->get('aktiv') == ""){
            $domainek = DB::table('domainek')->paginate(2);
            $alap = 1;
        }else{
            $alap = 0;
            $domainek = DB::table('domainek')->where($wheres)->paginate(30);
        }
        
        return view("welcome",["domainek" => $domainek,"domain" => $domain,"aktiv" => $aktiv,"alap" => $alap]);
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


    public function domainTorlesMegerosites(Request $req){
        $data['modal-title'] = "Domain Törlés";
        $data['modal-body'] = "Biztosan törölni szeretnéd a domain nevet?";
        $data['modal-footer'] = '<button type="button" class="btn btn-dark" data-bs-dismiss="modal">Mégsem</button>';
        $data['modal-footer'] .= '<button type="button" class="btn btn-danger" onclick="torlesDomain('.$req->domainId.');">Törlés</button>';
        
        return response()->json($data);
        
    }


    public function domainTorles(Request $req){
        $data['error'] = false;
        $data['errorMsg'] = "";

        $validalas = Validator::make($req->all(),
            [
                "domainId" => "required"
            ],
            [
                "domainId.required" => "Hiányzó domain ID"
            ]
        );

        if($validalas->fails()){
            $data['error'] = true;
            $data['errorMsg'] = $validalas->messages();
        }else{
            DB::delete("DELETE FROM domainek WHERE d_id=?",[$req->domainId]);
        }

        return response()->json($data);
    }


    public function hosszabbitasMegerosites(Request $req){
        $data['modal-title'] = "Domain Hosszabbítás";
        $data['modal-body'] = "Biztosan meg szeretnéd hosszabbítani a domain nevet?";
        $data['modal-footer'] = '<button type="button" class="btn btn-dark" data-bs-dismiss="modal">Mégsem</button>';
        $data['modal-footer'] .= '<button type="button" class="btn btn-danger" onclick="domainHosszabitas('.$req->domainId.');">Hosszabbítás</button>';
        
        return response()->json($data);
    }


    public function domainHosszabbitas(Request $req){
        $data['error'] = false;
        $data['errorMsg'] = "";

        $validalas = Validator::make($req->all(),
            [
                "domainId" => "required"
            ],
            [
                "domainId.required" => "Az id megadása kötelező!"
            ]
        );

        if($validalas->fails()){
            $data['error'] = true;
            $data['errorMsg'] = $validalas->messages();
        }else{
            DB::update("UPDATE domainek SET lejarati_ido=DATE_ADD(lejarati_ido, INTERVAL 1 YEAR) WHERE d_id=?",[$req->domainId]);
            $domainAdatok = DB::table('domainek')->where('d_id',$req->domainId)->first();
            $data['hosszabbitott_datum'] = $domainAdatok->lejarati_ido;
        }
        return response()->json($data);
    }

}
