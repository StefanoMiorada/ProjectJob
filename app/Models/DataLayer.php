<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class DataLayer
{
    public function getUserID($username)
    {
        $users = User::where('username', $username)->get(['id']);
        return $users[0]->id;
    }

    public function getUser($username)
    {
        $users = User::where('username', $username)->get();
        return $users[0];
    }

    public function listaAnnunci()
    {
        $lista_annunci = Annuncio::all();
        return $lista_annunci;
    }

    public function listaAnnunciAzienda($userID)
    {
        return Annuncio::where('id_utente', $userID)->get();
    }

    public function validUser($username, $password)
    {
        $users = User::where('username', $username)->get(['password']);

        if (count($users) == 0) {
            return false;
        }

        return (md5($password) == ($users[0]->password));
    }

    public function addUser($username, $password, $email, $nome, $cognome, $nome_azienda, $is_azienda)
    {
        $user = new User();
        $user->username = $username;
        $user->password = md5($password);
        $user->email = $email;
        $user->nome = $nome;
        $user->cognome = $cognome;
        $user->nome_azienda = $nome_azienda;
        $user->is_azienda = $is_azienda;
        $user->save();
    }

    public function getis_azienda($username)
    {
        $users = User::where('username', $username)->get(['is_azienda']);
        return $users[0]->is_azienda;
    }

    public function getAnnuncioByID($id)
    {
        //$annuncio = Annuncio::where('id',$id)->get();
        //return $annuncio[0];
        return Annuncio::find($id);
    }

    public function getCandidaturaByID($id)
    {
        return Candidatura::find($id);
    }

    public function getCandidatureUtente($id)
    {
        $candidature = Candidatura::where('id_utente', $id)->get();
        return $candidature;
    }


    public function modificaAnnuncio($id, $posizione, $luogo, $dettagli, $richieste, $tipo_contratto)
    {
        $annuncio = Annuncio::find($id);
        $annuncio->posizione = $posizione;
        $annuncio->luogo = $luogo;
        $annuncio->dettagli = $dettagli;
        $annuncio->richieste = $richieste;
        $annuncio->tipo_contratto = $tipo_contratto;
        $annuncio->save();
    }

    public function modificaDatiAzienda($id, $username, $email, $NomeAzienda)
    {
        $user = User::find($id);
        $user->username = $username;
        $user->email = $email;
        $user->nome_Azienda = $NomeAzienda;
        $user->save();
    }

    public function modificaDatiUtente($id, $username, $email, $Nome, $Cognome)
    {
        $user = User::find($id);
        $user->username = $username;
        $user->email = $email;
        $user->nome = $Nome;
        $user->cognome = $Cognome;
        $user->save();
    }

    public function modificaCandidatura($id, $lettera_motivazionale, $cv_path)
    {
        $candidatura = Candidatura::find($id);
        $candidatura->lettera_motivazionale = $lettera_motivazionale;
        $candidatura->cv_path = $cv_path;
        $candidatura->save();
    }

    public function aggiungiAnnuncio($posizione, $luogo, $dettagli, $richieste, $tipo_contratto, $userID)
    {
        $annuncio = new Annuncio();
        $annuncio->posizione = $posizione;
        $annuncio->luogo = $luogo;
        $annuncio->dettagli = $dettagli;
        $annuncio->richieste = $richieste;
        $annuncio->tipo_contratto = $tipo_contratto;
        $annuncio->id_utente = $userID;
        $annuncio->save();
    }

    public function rimuoviAnnuncio($id)
    {
        Annuncio::find($id)->delete();
    }

    public function rimuoviCandidatura($id)
    {
        Candidatura::find($id)->delete();
    }

    public function getCandidature($id)
    {
        $candidature = Candidatura::where('id_annuncio', $id)->get();
        return $candidature;
    }
    public function aggiungiCandidatura($letteraMotivazionale, $cv_path, $userID, $id_annuncio)
    {
        $candidatura = new Candidatura;
        $candidatura->lettera_motivazionale = $letteraMotivazionale;
        $candidatura->cv_path = $cv_path;
        $candidatura->id_annuncio = $id_annuncio;
        $candidatura->id_utente = $userID;
        $candidatura->save();
    }

    public function findUsername($username)
    {
        $user_count = User::where('username', $username)->get()->count();

        return $user_count > 0;
    }

    public function numAziende()
    {
        $aziende = User::where('is_azienda', 1)->get();
        $numAziende = $aziende->count();
        return $numAziende;
    }

    public function numUtenti()
    {
        $utenti = User::where('is_azienda', 0)->get();
        $numUtenti = $utenti->count();
        return $numUtenti;
    }

    public function numCandidature()
    {
        $candidature = candidatura::get();
        $numCandidature = $candidature->count();
        return $numCandidature;
    }

    //ritorna le tipologie di contratto presenti nel'enum della colonna tipo_contratto della tabella Annuncio
    public static function get_enum_values($table, $column)
    {
        // Create an instance of the model to be able to get the table name
        $instance = new static;
        // Pulls column string from DB
        $enumStr = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '{$column}'"))[0]->Type;
        // Parse string
        preg_match_all("/'([^']+)'/", $enumStr, $matches);
        // Return matches
        return isset($matches[1]) ? $matches[1] : [];
    }

    public function conta_tipi_contratto()
    {
        $elenco_contratti = Annuncio::pluck('tipo_contratto')->toArray();
        return array_count_values($elenco_contratti);
    }

    public function listaAziende()
    {
        $aziende = DB::table('user')->where('is_azienda', 1)->get();
        return $aziende;
    }

    public function listaUtenti()
    {
        $utenti = DB::table('user')->where('is_azienda', 0)->get();
        return $utenti;
    }
}
