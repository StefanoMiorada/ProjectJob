<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function authentication($source) {

       // if(isset($source)){
            if($source == "paginaAzienda"){
            return view('auth.auth')->with('source','paginaAzienda');
            }
            if($source == 'annunci'){
                return view('auth.auth')->with('source','annunci');
            }  
            if($source == 'home'){
                return view('auth.auth')->with('source','home');
            }  
        // }
        // return view('auth.auth');
        
    }

    public function logout() {
        session_start();
        session_destroy();
        return Redirect::to(route('home'));
    }

    public function login(Request $request,$source) {
         session_start();
         $dl = new DataLayer();
  

         if ($dl->validUser($request->input('username'), $request->input('password'))) 
         {
             $_SESSION['logged'] = true;
             $_SESSION['loggedName'] = $request->input('username');
             if(isset($source)){
                if($source == 'paginaAzienda'){
                return Redirect::to(route('paginaAzienda.index'));
                }
                if($source == 'annunci'){
                    return Redirect::to(route('annunci.index'));
                }   
             }
            
            return Redirect::to(route('home'));
             

         }
         return view('auth.authErrorPage');
    }

    public function registration(Request $request) {
        $dl = new DataLayer();

        if($request->input('password')===$request->input('confirm-password')){
            $dl->addUser($request->input('username'), $request->input('password'), 
                        $request->input('email'),$request->input('nome'),$request->input('cognome'),
                        $request->input('nome_azienda'),$request->input('is_azienda'));
            return Redirect::to(route('user.login',['source' =>'home']));
        }
        else{
            return view('auth.authErrorPage'); 
        }
    }

    public function ajaxCheckUsername(Request $request){
        $dl = new DataLayer();
        
        if($dl->findUsername($request))
        {
            $response = array('found'=>true);
        } else {
            $response = array('found'=>false);
        }
        return response()->json($response);
    }
}
