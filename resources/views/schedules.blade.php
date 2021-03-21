@extends('layout.app', ["current" => "horarios"])

@section('body')
    <div class="card border">
        <div class="card-header">
            <a href="/horarios/novo" class="btn btn-sm btn-info" role="button">Novo horário</a>
        </div>
        <div class="card-body">
            <h5 class="card-title">Cadastro de Horários</h5>
            <table class="table table-ordered table-hover" id="scheduleTable">
                <thead>
                    <tr>
                        <th>Data do Cadastro</th>
                        <th>Horário</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        function mountLine(data) {
            let date = new Date(data.created_at);
            let time = null;

            time = ((date.getHours() < 10) ? '0' + date.getHours() : date.getHours()) + ':' + ((date.getMinutes() < 10) ?
                '0' + date.getMinutes() : date.getMinutes());
            date = ((date.getDate() < 10) ? '0' + date.getDate() : date.getDate()) + '/' + ((date.getMonth() < 10) ? '0' +
                date.getMonth() : date.getMonth()) + '/' + date.getFullYear();

            let disabled = '';
            let disabledMsg = '';
            if (data.remedy.length > 0) {
                disabled = 'disabled';
                disabledMsg = '<span style="color:red;">* Este horário está em uso</span>';
            }

            let line = `<tr>
                            <td>${date} - ${time}</td>
                            <td>${data.schedule}</td>
                            <td>
                                <button class="btn btn-sm btn-secondary" onclick="editSchedule(${data.id})" ${disabled}>Editar</button>
                                <button class="btn btn-sm btn-danger" onclick="deleteSchedule(${data.id})" ${disabled}>Apagar</button>
                                ${disabledMsg}
                            </td>
                        </tr>`;
            return line;
        }

        function loadSchedules() {
            $.getJSON("/api/horario", function(data) {
                for (let i = 0; i < data.length; i++) {
                    let line = mountLine(data[i]);
                    $('#scheduleTable>tbody').append(line);
                }
            });
        }

        function deleteSchedule(id) {
            let res = confirm('Este horário será apagado. Deseja continuar?');

            if (res) {
                $.ajax({
                        method: "DELETE",
                        url: `/api/horario/${id}`,
                        success: function(res) {
                            alert(res.msg);
                            location.replace('/horarios');
                        },
                        error: function (xhr) {}
                    });
            } else {
                location.replace('/horarios');
            }
        }

        $(function() {
            loadSchedules();
        })

    </script>
@endsection
