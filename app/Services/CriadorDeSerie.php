<?php
namespace App\Services;

use App\Serie;
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{
    public function criarSerie(String $nomeSerie, int $qtdTemporadas, int $epPorTemporada)
    {
        DB::beginTransaction();
        
        $serie = Serie::create(["nome" => $nomeSerie]);
        $this->criaTemporada($qtdTemporadas, $epPorTemporada, $serie);
        DB::commit();
        return $serie;
    }

    public function criaTemporada(int $qtdTemporadas, int $epPorTemporada, $serie)
    {
        for ($i=1; $i <= $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(["numero" => $i]);
            $this->criarEpisodios($epPorTemporada, $temporada);
        }
    }

    public function criarEpisodios($epPorTemporada, $temporada)
    {
        for ($j=1; $j <= $epPorTemporada; $j++) {
            $temporada->episodios()->create(["numero" => $j]);
        }
    }
}
