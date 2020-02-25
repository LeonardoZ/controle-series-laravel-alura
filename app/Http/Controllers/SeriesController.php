<?php

namespace App\Http\Controllers;

use App\Serie;
use Illuminate\Http\Request;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use App\Http\Requests\SeriesFormRequest;

class SeriesController extends Controller
{
 
    public function index(Request $request)
    {
        $series = Serie::query()->orderBy("nome")->get();
        $mensagem = $request->session()->get("mensagem");
        return view("series.index", compact("series", "mensagem"));
    }

    public function create()
    {
        return view("series.create");
    }

    public function store(SeriesFormRequest $request, CriadorDeSerie $criadorDeSerie)
    {
        $serie = $criadorDeSerie->criarSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->ep_por_temporada
        );
        $request->session()->flash(
            "mensagem",
            "Serie ($serie->id) e suas temporadas/episódios criadas com sucesso criada: ($serie->nome)"
        );
        return redirect()->route("series_listar");
    }

    public function editaNome($id, Request $request)
    {
        $novoNome = $request->nome;
        $serie = Serie::find($id);
        $serie->nome = $novoNome;
        $serie->save();
    }

    public function destroy(Request $request, RemovedorDeSerie $removedorDeSerie)
    {
        $nomeSerie = $removedorDeSerie->removerSerie($request->id);
        $request->session()->flash("mensagem", "Serie  $nomeSerie removida com sucesso");
        return redirect()->route("series_listar");
    }
}
