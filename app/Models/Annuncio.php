<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annuncio extends Model
{
    use HasFactory;
    protected $table = 'annuncio';
    public $timestamps = false;

    protected $fillable =['posizione','luogo','dettagli','richieste','tipo_contratto','id_utente'];

    public function azienda_annuncio(){
        return $this->belongsTo(User::class);
    }

    public function candidature_annuncio(){
        return $this->hasMany(Candidatura::class,'id_annuncio');
    }
}
