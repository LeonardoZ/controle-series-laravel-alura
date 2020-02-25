<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{
    public $timestamps = false;
    protected $fillable = ["numero"];

    public function getEpisodiosAssistidos()
    {
        return $this->episodios->filter(function (Episodio $episodio) 
        {
            return $episodio->assistido; 
        });
    }
    
    public function episodios()
    {
        return $this->hasMany(Episodio::class);
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }
}
