@extends('layout.app', ["current" => "horarios"])

@section('body')

    <div class="card border">
        <div class="card-body">
            <form id="scheduleForm">
                @csrf
                <input type="hidden" name="id" id="id" value="{{ $id ?? ''}}"/>
                <div class="form-group">
                    <label for="schedule">Horário</label>
                    <input type="time" class="form-control" name="schedule" id="schedule" />
                </div>
                <button type="submit" class="btn btn-info btn-sm">Salvar</button>
                <button onclick="cancela()" class="btn btn-danger btn-sm">Cancelar</button>
            </form>
        </div>
    </div>

@endsection

@section('javascript')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                'Accept': 'application/json'
            }
        });

        const scheduleID = $('#id').val();

        function loadSchedules() {
            $.getJSON("/api/horario", function(data) {
                for (let i = 0; i < data.length; i++) {
                    option = `<option value"${data[i].id}">${data[i].schedule}</option>`;
                    $('#schedule_id').append(option);
                }
            });
        }

        $('#scheduleForm').submit(function(e) {
            e.preventDefault();

            const dadosForm = $('#scheduleForm').serialize();

            $.ajax({
                method: (scheduleID) ? "PUT" : "POST",
                url: `/api/horario/${scheduleID}`,
                data: dadosForm,
                dataType: 'json',
                success: function(res) {
                    let ret = 'Horário ' + ((scheduleID) ? 'alterado' : 'cadastrado') + ' com sucesso!';
                    alert(ret);
                    location.assign('/horarios');
                },
                error: function(xhr) {
                    let error = xhr.responseJSON.errors.schedule[0];
                    alert('* ' + error);
                }
            });
        });

        function cancela() {
            location.assign('/horarios');
        };

        function loadScheduleData(id) {
            $.getJSON(`/api/horario/${id}`, function(data) {
                $('#schedule').val(data.schedule);
            });
        }

        $(function() {
            loadSchedules();
            loadScheduleData(scheduleID);
        });

    </script>
@endsection
