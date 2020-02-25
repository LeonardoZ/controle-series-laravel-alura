@extends('layout')
@section('cabecalho')
Séries
@endsection
@section('conteudo')
    @include('mensagem', ['mensagem' => $mensagem])
    @auth
        <a href="{{ route("series_criar") }}" class="btn btn-dark mb-2">Adicionar</a>
    @endauth
    <ul class="list-group">
        @foreach ($series as $serie) 
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span id="nome-serie-{{ $serie->id }}">{{ $serie->nome }}</span>
        
                <div class="input-group w-50" hidden id="input-nome-serie-{{ $serie->id }}">
                    <input type="text" class="form-control" value="{{ $serie->nome }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" onclick="editarSerie({{ $serie->id }})">
                            <i class="fas fa-check"></i>
                        </button>
                        @csrf
                    </div>
                </div>
        
                <span class="d-flex justify-content-center align-items-center">
                    @auth
                    <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{ $serie->id }})">
                        <i class="fas fa-edit"></i>
                    </button>
                    @endauth
                    <a href="{{ route('lista-series-temporadas', ["seriesId" => $serie->id])}}"
                        class="btn btn-info btn-sm mr-1">
                        <i class="fas fa-external-link-alt">
                        </i>
                    </a>
                    @auth
                    <form action="{{ route("series_remover", ["id" => $serie->id]) }}" 
                          method="post"  onsubmit="return confirm('Tem certeza?')"
                          class="mb-0">
                        <button class="btn btn-danger btn-sm mr-1 align-self-center">
                            <i class="far fa-trash-alt"></i>
                        </button>
                        @csrf
                        @method("delete")
                    </form>
                    @endauth
                </span>
            </li>
        @endforeach
    </ul>
@endsection

<script>
    function toggleInput(serieId) {
        const nomeSerieEl = document.getElementById(`nome-serie-${serieId}`);
        const inputSerieEl = document.getElementById(`input-nome-serie-${serieId}`);
        if (nomeSerieEl.hasAttribute('hidden')) {
            nomeSerieEl.removeAttribute('hidden');
            inputSerieEl.hidden = true;
        } else {
            inputSerieEl.removeAttribute('hidden');
            nomeSerieEl.hidden = true;
        }

    }

    function editarSerie(serieId) {
        let formData = new FormData();
        const nome = document
            .querySelector(`#input-nome-serie-${serieId} > input`)
            .value;
        const token = document
            .querySelector(`input[name="_token"]`)
            .value;
        formData.append('nome', nome);
        formData.append('_token', token);
        const url = `/series/${serieId}/editaNome`;
        fetch(url, {
            method: 'POST',
            body: formData
        }).then(() => {
            toggleInput(serieId);
            document.getElementById(`nome-serie-${serieId}`).textContent = nome;
        });;
    }
</script> 