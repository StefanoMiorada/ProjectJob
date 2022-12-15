<?php

namespace App\Http\Controllers;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ControllerAnnunci extends Controller
{
    public function index(){
        session_start();
        $dl = new DataLayer();
        $lista_annunci=$dl->listaAnnunci();
        $tipo_contratto = $dl->get_enum_values('Annuncio','tipo_contratto');
        $conteggio_contratti = $dl->conta_tipi_contratto();
        if (isset($_SESSION['logged'])) {
            $user = $dl->getUser($_SESSION["loggedName"]);
            $is_azienda = $dl->getis_azienda($_SESSION["loggedName"]);
            return view('annunci.annunciDiLavoro')->with('listaAnnunci',$lista_annunci)->with('logged', true)->with('loggedName', $_SESSION['loggedName'])
            ->with('is_azienda',$is_azienda)->with('tipo_contratto',$tipo_contratto)->with('conteggio_contratti',$conteggio_contratti)
            ->with('utente',$user);
        }   
        else {
            return view('annunci.annunciDiLavoro')->with('listaAnnunci',$lista_annunci)->with('logged', false)
            ->with('tipo_contratto',$tipo_contratto)->with('conteggio_contratti',$conteggio_contratti);
        } 
        
    }
    public function edit($id){
        session_start();
        $dl = new DataLayer();
        if(isset($_SESSION["loggedName"])){
            $userID = $dl->getUserID($_SESSION["loggedName"]);
            $annuncio = $dl->getAnnuncioByID($id);
            $is_azienda = $dl->getis_azienda($_SESSION["loggedName"]);
            $tipo_contratto = $dl->get_enum_values('Annuncio','tipo_contratto');
            if ($is_azienda==1){
                return view('azienda.modificaAnnuncio')->with('logged', true)->with('loggedName', $_SESSION["loggedName"])->with('annuncio', $annuncio)->with('tipo_contratto',$tipo_contratto)->with('id_azienda',$userID);
            }
            else{
                return view('azienda.errPaginaAzienda')->with('logged', true)->with('loggedName', $_SESSION['loggedName']);
            }
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
            $is_azienda = $dl->getis_azienda($_SESSION["loggedName"]);
            if ($is_azienda==1){
                $dl->modificaAnnuncio($id, $request->input('posizione'), $request->input('luogo')
                                        , $request->input('dettagli'), $request->input('richieste'), $request->input('tipo_contratto'));
                Session::flash('successEdit', 'Here is your success message');
                return Redirect::to(route('paginaAzienda.index'));
            }
            else{
                return view('azienda.errPaginaAzienda')->with('logged', true)->with('loggedName', $_SESSION['loggedName']);
            }
        }
        else{
            return view('azienda.errPaginaAzienda')->with('logged', false);
        }
    }

    public function create(){
        session_start();
        $dl = new DataLayer();
        if(isset($_SESSION["loggedName"])){
            $userID = $dl->getUserID($_SESSION["loggedName"]);
            $is_azienda = $dl->getis_azienda($_SESSION["loggedName"]);
            $tipo_contratto = $dl->get_enum_values('Annuncio','tipo_contratto');
            if ($is_azienda==1){
                return view('azienda.modificaAnnuncio')->with('logged', true)->with('loggedName', $_SESSION["loggedName"])->with('tipo_contratto',$tipo_contratto)->with('id_azienda',$userID);
            }
            else{
                return view('azienda.errPaginaAzienda')->with('logged', true)->with('loggedName', $_SESSION['loggedName']);
            }
        }
        else{
            return view('azienda.errPaginaAzienda')->with('logged', false);
        }
    }

    public function store(Request $request){
        session_start();
        $dl = new DataLayer();
        if(isset($_SESSION["loggedName"])){
            $userID = $dl->getUserID($_SESSION["loggedName"]);
            $is_azienda = $dl->getis_azienda($_SESSION["loggedName"]);
            if ($is_azienda==1){
                $dl->aggiungiAnnuncio($request->input('posizione'), $request->input('luogo'), $request->input('dettagli'),
                                    $request->input('richieste'), $request->input('tipo_contratto'), $userID);
                Session::flash('successCreate', 'Here is your success message');
                return Redirect::to(route('paginaAzienda.index'));
            }
            else{
                return view('azienda.errPaginaAzienda')->with('logged', true)->with('loggedName', $_SESSION['loggedName']);
            }
        }
        else{
            return view('azienda.errPaginaAzienda')->with('logged', false);
        }
    }

    public function destroy($id){
        session_start();
        $dl = new DataLayer();
        if(isset($_SESSION["loggedName"])){
            $is_azienda = $dl->getis_azienda($_SESSION["loggedName"]);
            if($is_azienda==1){
                $dl->rimuoviAnnuncio($id);
                Session::flash('successDelete', 'Here is your success message');
                return Redirect::to(route('paginaAzienda.index'));
            }
            else{
                return view('azienda.errPaginaAzienda')->with('logged', true)->with('loggedName', $_SESSION['loggedName']);
            }
        }
        else{
            return view('azienda.errPaginaAzienda')->with('logged', false);
        }
        
    }

    public function confirmDestroy($id){
        session_start();
        $dl = new DataLayer();
        $annuncio = $dl->getAnnuncioByID($id);
        if(isset($_SESSION["loggedName"])){
            $is_azienda = $dl->getis_azienda($_SESSION["loggedName"]);
            if ($annuncio !== null) {
                if($is_azienda == 1){
                return view('azienda.rimuoviAnnuncio')->with('logged', true)
                    ->with('loggedName', $_SESSION["loggedName"])
                    ->with('annuncio', $annuncio); 
                }
                else{
                    return view('azienda.errPaginaAzienda')->with('logged', true)->with('loggedName', $_SESSION['loggedName']);
                }
            
            }else {
                if($is_azienda==1){
                    return view('azienda.erroreRimozione')->with('logged', true)
                    ->with('loggedName', $_SESSION["loggedName"]);
                }
                else{
                    return view('azienda.errPaginaAzienda')->with('logged', true)->with('loggedName', $_SESSION['loggedName']);
                }  
            }
        }
        else{
            return view('azienda.errPaginaAzienda')->with('logged', false);
        }
        
    }

    public function dettagliCandidature($id){
        session_start();
        $dl = new DataLayer();
        $annuncio = $dl->getAnnuncioByID($id);
        if(isset($_SESSION["loggedName"])){
            $is_azienda = $dl->getis_azienda($_SESSION["loggedName"]);
            $dettagliUtentiCandidature = DB::table('Candidatura')
                ->where('id_annuncio',$id)
                ->leftjoin('User', 'Candidatura.id_utente', '=', 'User.id')
                ->select('User.username','User.email','User.nome','User.cognome', 'Candidatura.*')
                ->get();
            if($is_azienda == 1){
                return view('azienda.dettagliCandidature')->with('logged', true)
                ->with('loggedName', $_SESSION["loggedName"])
                ->with('annuncio', $annuncio)->with('dettagliUtentiCandidature',$dettagliUtentiCandidature); 
            }
            else{
                return view('azienda.errPaginaAzienda')->with('logged', true)->with('loggedName', $_SESSION['loggedName']);
            }
        }
        else{
            return view('azienda.errPaginaAzienda')->with('logged', false);
        }
    }

    public function candidaturaAnnuncio($id){
        session_start();
        $dl = new DataLayer();
        $annuncio = $dl->getAnnuncioByID($id);
        $is_azienda = $dl->getis_azienda($_SESSION["loggedName"]);
        if(isset($_SESSION["loggedName"])){
            if($is_azienda==1){
                return Redirect::to(route('paginaAzienda.index'));
            }
            else{
                return view('annunci.candidatura')->with('logged',true)->with('loggedName', $_SESSION['loggedName'])
                ->with('annuncio',$annuncio);
            }
        }
        else{
            //
        }
    }

    public function inviaCandidatura(Request $request, $id){
        session_start();
        $dl = new DataLayer();
        //$annuncio = $dl->getAnnuncioByID($id);
        $is_azienda = $dl->getis_azienda($_SESSION["loggedName"]);
        $userID = $dl->getUserID($_SESSION["loggedName"]);

        if ($is_azienda==0){
            
            $filenameWithExt = $request->file('cv_path')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cv_path')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension; 
            $path = $request->file('cv_path')->storeAs('public/files', $fileNameToStore);

            $dl->aggiungiCandidatura($request->input('letteraMotivazionale'), $fileNameToStore , $userID, $id);
            Session::flash('success', 'Here is your success message');
            return Redirect::to(route('annunci.index'));
        }
        else{
            return view('azienda.errPaginaAzienda')->with('logged', true)->with('loggedName', $_SESSION['loggedName']);
        }
    }
}
