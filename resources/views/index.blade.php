@extends('layout.app', ["current" => "home"])

@section('body')
    <div class="jumbotron bg-light border border-secondary">
        <div class="row">
            <div class="card-deck">
                <div class="card border border-secondary">
                    <div class="card-body">
                        <h5 class="card-title">Cadastro de Pessoas</h5>
                        <p class="card=text">
                            Aqui você cadastra as Pessoas que usarão o aplicativo
                        </p>
                        <a href="/pessoas/novo" class="btn btn-info">Cadastrar</a>
                    </div>
                </div>
                <div class="card border border-secondary">
                    <div class="card-body">
                        <h5 class="card-title">Cadastro de Horários</h5>
                        <p class="card=text">
                            Aqui você cadastra os horários dos seus medicamentos
                        </p>
                        <a href="/horarios/novo" class="btn btn-info">Cadastrar</a>
                    </div>
                </div>
                <div class="card border border-secondary">
                    <div class="card-body">
                        <h5 class="card-title">Cadastro de Medicamentos</h5>
                        <p class="card=text">
                            Aqui você cadastra os Medicamentos em uso
                        </p>
                        <a href="/medicamentos/novo" class="btn btn-info">Cadastrar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
