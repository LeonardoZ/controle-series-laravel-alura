@extends('layout')
@section('cabecalho')
Temporadas de {{ $serie->nome }}
@endsection
@section('conteudo')
    <ul class="list-group">
        @foreach ($temporadas as $temporada) 
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{ route("temporada_episodios", ["temporadaId" => $temporada->id]) }}">
                    Temporada {{ $temporada->numero }}
                </a>
                <span class="badge badge-secondary">
                    {{ count($temporada->getEpisodiosAssistidos()) }} / {{ count($temporada->episodios) }}
                </span>
            </li>
        @endforeach
    </ul>
@endsection