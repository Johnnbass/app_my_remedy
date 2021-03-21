@extends('layout.app', ["current" => "horarios"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Horários</h5>
            <table class="table table-ordered table-hover">
                <thead>
                    <tr>
                        <th>Data do Cadastro</th>
                        <th>Horário</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <a href="/horarios/editar/" class="btn btn-sm btn-secondary">Editar</a>
                            <a href="/horarios/apagar/" class="btn btn-sm btn-danger">Apagar</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <a href="/horarios/novo" class="btn btn-sm btn-info" role="button">Novo horário</a>
        </div>
    </div>
@endsection
