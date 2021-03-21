@extends('layout.app', ["current" => "pessoas"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Pessoas</h5>
            <table class="table table-ordered table-hover">
                <thead>
                    <tr>
                        <th>Data do Cadastro</th>
                        <th>Nome</th>
                        <th>Idade</th>
                        <th>Endereço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a href="/pessoas/editar/" class="btn btn-sm btn-secondary">Editar</a>
                            <a href="/pessoas/apagar/" class="btn btn-sm btn-danger">Apagar</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <a href="/pessoas/novo" class="btn btn-sm btn-info" role="button">Nova pessoa</a>
        </div>
    </div>
@endsection
