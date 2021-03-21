@extends('layout.app', ["current" => "home"])

@section('body')
    <h3>Bem vindo ao Meu Remédio! O que você deseja fazer?</h3>
    <div class="jumbotron bg-light border border-info">
        <div class="row">
            <div class="card-deck">
                <div class="card border border-info">
                    <div class="card-body">
                        <h5 class="card-title">Adicionar Pessoas</h5>
                        <p class="card=text">
                            Aqui você adiciona as Pessoas que usarão os medicamentos
                        </p>
                        <a href="/pessoas/novo" class="btn btn-info">Adicionar</a>
                        <a href="/pessoas" class="btn btn-info">Ver</a>
                    </div>
                </div>
                <div class="card border border-info">
                    <div class="card-body">
                        <h5 class="card-title">Adicionar Horários</h5>
                        <p class="card=text">
                            Aqui você adiciona os horários para os medicamentos
                        </p>
                        <a href="/horarios/novo" class="btn btn-info">Adicionar</a>
                        <a href="/horarios" class="btn btn-info">Ver</a>
                    </div>
                </div>
                <div class="card border border-info">
                    <div class="card-body">
                        <h5 class="card-title">Adicionar Medicamentos</h5>
                        <p class="card=text">
                            Aqui você adiciona os Medicamentos em uso
                        </p>
                        <a href="/medicamentos/novo" class="btn btn-info">Adicionar</a>
                        <a href="/medicamentos" class="btn btn-info">Ver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
