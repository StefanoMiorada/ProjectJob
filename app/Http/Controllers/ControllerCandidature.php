<?php

namespace App\Http\Controllers;
use App\Models\DataLayer;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ControllerCandidature extends Controller
{
    public function index(){
        session_start();
        $dl = new DataLayer();
        if (isset($_SESSION['logged'])) {
            $is_azienda = $dl->getis_azienda($_SESSION["loggedName"]);
            $id = $dl->getUserID($_SESSION["loggedName"]);
            $user = $dl->getUser($_SESSION["loggedName"]);
            $candidature_utente=$dl->getCandidatureUtente($id);
            $annunci=$dl->listaAnnunci();
            if ($is_azienda == 0){
                return view('mieCandidature')->with('logged', true)->with('loggedName', $_SESSION['loggedName'])->with('is_azienda',$is_azienda)
                ->with('candidature',$candidature_utente)->with('annunci',$annunci)->with('utente',$user);
            } 
        }     
    }

    public function destroy($id){
        session_start();
        $dl = new DataLayer();
        if(isset($_SESSION["loggedName"])){
            $is_azienda = $dl->getis_azienda($_SESSION["loggedName"]);
            if($is_azienda==0){
                $dl->rimuoviCandidatura($id);
                return Redirect::to(route('candidature.index'));
            }
        }        
    }

    public function confirmDestroy($id){
        session_start();
        $dl = new DataLayer();
        $candidatura = $dl->getCandidaturaByID($id);
        $annuncio = $dl->getAnnuncioByID($candidatura->id_annuncio);
        if(isset($_SESSION["loggedName"])){
            $is_azienda = $dl->getis_azienda($_SESSION["loggedName"]);
            if ($candidatura !== null) {
                if($is_azienda == 0){
                return view('rimuoviCandidatura')->with('logged', true)
                    ->with('loggedName', $_SESSION["loggedName"])
                    ->with('candidatura', $candidatura)->with('annuncio',$annuncio); 
                }
            }
        }
    }

    public function edit($id){
        session_start();
        $dl = new DataLayer();
        if(isset($_SESSION["loggedName"])){
            $userID = $dl->getUserID($_SESSION["loggedName"]);
            $candidatura = $dl->getCandidaturaById($id);
            $is_azienda = $dl->getis_azienda($_SESSION["loggedName"]);
            return view('modificaCandidatura')->with('logged', true)->with('loggedName', $_SESSION["loggedName"])->with('candidatura', $candidatura);
        }
        else{
            return view('azienda.errPaginaAzienda')->with('logged', false);
        }
        
    }

    public function update(Request $request, $id)
    {
        session_start();
        $dl = new DataLayer();
        if(isset($_SESSION["loggedName"])){
            $userID = $dl->getUserID($_SESSION["loggedName"]);
            $filenameWithExt = $request->file('cv_path')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cv_path')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension; 
            $path = $request->file('cv_path')->storeAs('public/files', $fileNameToStore);

            $dl->modificaCandidatura($id, $request->input('lettera_motivazionale'),$fileNameToStore);
            Session::flash('successEdit', 'Here is your success message');
            return Redirect::to(route('candidature.index'));
        }
        else{
            return view('azienda.errPaginaAzienda')->with('logged', false);
        }
    }


}