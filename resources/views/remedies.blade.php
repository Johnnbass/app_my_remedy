@extends('layout.app', ["current" => "medicamentos"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <div class="row">
                <div class="">
                    <h5 class="card-title">Cadastro de Medicamentos</h5>
                    <table class="table table-ordered table-hover">
                        <thead>
                            <tr>
                                <th>Data do Cadastro</th>
                                <th>Nome</th>
                                <th>Dosagem</th>
                                <th>Preço</th>
                                <th>Horário</th>
                                <th>Quem usa</th>
                                <th>Período</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="/medicamentos/editar/" class="btn btn-sm btn-secondary">Editar</a>
                                    <a href="/medicamentos/apagar/" class="btn btn-sm btn-danger">Apagar</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="/medicamentos/novo" class="btn btn-sm btn-info" role="button">Nova medicamento</a>
        </div>
    </div>
@endsection
