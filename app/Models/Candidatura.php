<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidatura extends Model
{
    use HasFactory;
    protected $table = 'candidatura';
    public $timestamps = false;

    protected $fillable =['lettera_motivazionale','cv_path','id_annuncio','id_utente'];

    public function utente(){
        return $this->belongsTo(User::class);
    }

    public function annuncio(){
        return $this->belongsTo(Annuncio::class,'id_annuncio');
    }
}
