@extends('layout.app', ["current" => "pessoas"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Pessoas</h5>
            <table class="table table-ordered table-hover" id="peopleTable">
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
                    
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <a href="/pessoas/novo" class="btn btn-sm btn-info" role="button">Nova pessoa</a>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        function mountLine(data) {
            let date = new Date(data.created_at);
            let time = null;

            time = ((date.getHours() < 10) ? '0'+date.getHours() : date.getHours())+':'+((date.getMinutes() < 10) ? '0'+date.getMinutes() : date.getMinutes());
            date = ((date.getDate() < 10) ? '0'+date.getDate() : date.getDate())+'/'+((date.getMonth() < 10) ? '0'+date.getMonth() : date.getMonth())+'/'+date.getFullYear();

            let line = `<tr>
                            <td>${date} - ${time}</td>
                            <td>${data.name}</td>
                            <td>${data.age}</td>
                            <td>${data.address}</td>
                            <td>
                                <a href="/pessoas/editar/" class="btn btn-sm btn-secondary">Editar</a>
                                <a href="/pessoas/apagar/" class="btn btn-sm btn-danger">Apagar</a>
                            </td>
                        </tr>`;
            return line;
        }

        function loadPeople() {
            $.getJSON("/api/pessoa", function(data) {
                for (let i = 0; i < data.length; i++) {
                    let line = mountLine(data[i]);
                    $('#peopleTable>tbody').append(line);
                }
            });
        }

        $(function() {
            loadPeople();
        })

    </script>
@endsection