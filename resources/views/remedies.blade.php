@extends('layout.app', ["current" => "medicamentos"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <div class="row">
                <div class="">
                    <h5 class="card-title">Cadastro de Medicamentos</h5>
                    <table class="table table-ordered table-hover" id="remedyTable">
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

@section('javascript')
    <script type="text/javascript">
        function mountLine(data) {
            let date = new Date(data.created_at);
            let time = null;
            let price = (data.price === null) ? '' : data.price;

            time = ((date.getHours() < 10) ? '0'+date.getHours() : date.getHours())+':'+((date.getMinutes() < 10) ? '0'+date.getMinutes() : date.getMinutes());
            date = ((date.getDate() < 10) ? '0'+date.getDate() : date.getDate())+'/'+((date.getMonth() < 10) ? '0'+date.getMonth() : date.getMonth())+'/'+date.getFullYear();

            let line = `<tr>
                            <td>${date} - ${time}</td>
                            <td>${data.name}</td>
                            <td>${data.dosage}</td>
                            <td>${price}</td>
                            <td>${data.schedule.schedule}</td>
                            <td>${data.person.name}</td>
                            <td>${data.period}</td>
                            <td>
                                <a href="/medicamentos/editar/" class="btn btn-sm btn-secondary">Editar</a>
                                <a href="/medicamentos/apagar/" class="btn btn-sm btn-danger">Apagar</a>
                            </td>
                        </tr>`;
            return line;
        }

        function loadPeople() {
            $.getJSON("/api/medicamento", function(data) {
                for (let i = 0; i < data.length; i++) {
                    let line = mountLine(data[i]);
                    $('#remedyTable>tbody').append(line);
                }
            });
        }

        $(function() {
            loadPeople();
        })

    </script>
@endsection