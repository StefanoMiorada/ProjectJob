<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;

class FrontController extends Controller
{
    public function getHome()
    {
        session_start();
        $dl = new DataLayer();
        $lista_annunci=$dl->listaAnnunci();
        $num_aziende=$dl->numAziende();
        $num_utenti=$dl->numUtenti();
        $num_candidature=$dl->numCandidature();
        

        if (isset($_SESSION['logged'])) {
            return view('index')->with('logged', true)->with('loggedName', $_SESSION['loggedName'])->with('listaAnnunci',$lista_annunci)
                                ->with('numAziende',$num_aziende)->with('numUtenti',$num_utenti)->with('numCandidature',$num_candidature)
                                ->with('is_azienda',$dl->getis_azienda($_SESSION['loggedName']));
        } else {
            return view('index')->with('logged', false)->with('listaAnnunci',$lista_annunci)
                                ->with('numAziende',$num_aziende)->with('numUtenti',$num_utenti)->with('numCandidature',$num_candidature);
        } 
        return view('index');
    }
}
