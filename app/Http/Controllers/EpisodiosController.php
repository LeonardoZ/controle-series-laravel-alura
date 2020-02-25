<?php

namespace App\Http\Controllers;

use App\Episodio;
use App\Temporada;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{
    public function index(int $idTemporada, Request $request)
    {
        $temporada = Temporada::find($idTemporada);
        $episodios = $temporada->episodios;
        $mensagem = $request->session()->get("mensagem");
        return view("episodios.index", compact("episodios", "idTemporada", "mensagem"));
    }

    public function assistir(Temporada $temporada, Request $request)
    {
        $assistidos = $request->episodios;
        $temporada->episodios->each(function (Episodio $episodio) use ($assistidos)
        {
            $episodio->assistido = in_array($episodio->id, $assistidos);
        });
        $temporada->push();
        $request->session()->flash("mensagem", "Episódios marcados como assistidos");
        return redirect()->back();
    }
}
