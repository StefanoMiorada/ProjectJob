<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;

class ControllerPaginaAzienda extends Controller
{
    public function index(){
        session_start();
        $dl = new DataLayer();
        $conteggio_contratti = $dl->conta_tipi_contratto();
        if(!isset($_SESSION['logged'])){
            return view('auth.auth')->with('logged', false)->with('source',"paginaAzienda");
        }
        if (isset($_SESSION['logged'])) {
            $userID = $dl->getUserID($_SESSION["loggedName"]);
            $user = $dl->getUser($_SESSION["loggedName"]);
            $lista_annunci=$dl->listaAnnunciAzienda($userID);
            $is_azienda = $dl->getis_azienda($_SESSION["loggedName"]);
            $tipo_contratto = $dl->get_enum_values('Annuncio','tipo_contratto');
            if ($is_azienda==1){
                return view('azienda.paginaAzienda')->with('listaAnnunci',$lista_annunci)->with('logged', true)->with('loggedName', $_SESSION['loggedName'])->with('tipo_contratto',$tipo_contratto)->with('conteggio_contratti',$conteggio_contratti)->with('utente',$user);
            }
            else{
                return view('azienda.errPaginaAzienda')->with('logged', true)->with('loggedName', $_SESSION['loggedName']);
            }    
        }        
    }    
}
