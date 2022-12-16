<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function authentication($source,$message=null) {
        $current_view = view("auth.auth")->with("lang", Session::get("language"));

       // if(isset($source)){
            if($source == "paginaAzienda"){
            return $current_view->with('source','paginaAzienda');
            }
            if ($source == 'annunci' & $message=='True'){
                return $current_view->with('source','annunci')->with('message','Per poterti candidare ad un annuncio devi effettuare il login.');
            }
            elseif($source == 'annunci'){
                return $current_view->with('source','annunci');
            }  
            
            if($source == 'home'){
                return $current_view->with('source','home');
            }  
        // }
        // return view('auth.auth');
        
    }

    public function logout() {
        session_start();
        session_destroy();
        return Redirect::to(route('home'));
    }

    public function login(Request $request,$source,$message=null) {
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
        session_start();
        $dl = new DataLayer();

        if($request->input('password')===$request->input('confirm-password')){
            $dl->addUser($request->input('username'), $request->input('password'), 
                        $request->input('email'),$request->input('nome'),$request->input('cognome'),
                        $request->input('nome_azienda'),$request->input('is_azienda'));
            $_SESSION['logged'] = true;
            $_SESSION['loggedName'] = $request->input('username');
            Session::flash('successNewUser', 'Here is your success message');
            return Redirect::to(route('home'));
        }
        else{
            return view('auth.authErrorPage'); 
        }
    }
    public function recuperaPassword(){
        session_start();
        Session::flash('successRecupero', 'Here is your success message');
        return Redirect::to(route('home'));
    }

    public function ajaxUsername(Request $request){
        $dl = new DataLayer();
        $username = $request->input("username");

        $response = array("valid" => !$dl->findUsername($username));

        return response()->json($response);
    }

    public function ajaxLogin(Request $request) {
        $dl = new Datalayer();
        $username = $request->input("username");
        $password = $request->input("password");

        $response = array("valid" => $dl->validUser($username, $password));

        if ($response["valid"]) {
            Session::put("logged", true);
            Session::put("loggedName", $username);
        }

        return response()->json($response);
    }

    
}
