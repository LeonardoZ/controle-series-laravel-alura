@extends('layout')
@section('cabecalho')
Séries
@endsection
@section('conteudo')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route("series_salvar")}}" method="post">
        <div class="row">
            <div class="col col-8">
                <div class="form-group">
                    <input type="text" class="form-control" name="nome" id="nome">
                </div>
            </div>
            <div class="col col-2">
                <div class="form-group">
                    <input type="number" class="form-control" placeholder="Qtd Temporadas" name="qtd_temporadas" id="qtd_temporadas">
                </div>
            </div>

            <div class="col col-2">
                <div class="form-group">
                    <input type="number" class="form-control" placeholder="Ep. por temporada" name="ep_por_temporada" id="ep_por_temporada">
                </div>
            </div>

        </div>

        <button class="btn btn-primary m-2">Adicionar</button>
        @csrf
    </form>
@endsection