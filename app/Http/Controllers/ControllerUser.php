<?php

namespace App\Http\Controllers;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
class ControllerUser extends Controller
{
    public function edit($id){
        session_start();
        $dl = new DataLayer();
        if(isset($_SESSION["loggedName"])){
            $user = $dl->getUser($_SESSION["loggedName"]);
            $is_azienda = $dl->getis_azienda($_SESSION["loggedName"]);
            return view('azienda.modificaDati')->with('logged', true)->with('loggedName', $_SESSION["loggedName"])->with('utente', $user)->with('is_azienda',$is_azienda);
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
            $is_azienda = $dl->getis_azienda($_SESSION["loggedName"]);
            if ($is_azienda==1){
                $dl->modificaDatiAzienda($id, $request->input('Username'), $request->input('Email')
                                        , $request->input('NomeAzienda'));
                Session::flash('successEdit', 'Here is your success message');
                return Redirect::to(route('paginaAzienda.index'));
            }
            else{
                $dl->modificaDatiUtente($id, $request->input('Username'), $request->input('Email')
                                        , $request->input('Nome'), $request->input('Cognome'));
                Session::flash('successEdit', 'Here is your success message');
                return Redirect::to(route('candidature.index'));
            }
        }
        else{
            return view('azienda.errPaginaAzienda')->with('logged', false);
        }
    }
}