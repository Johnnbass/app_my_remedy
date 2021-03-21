@extends('layout.app', ["current" => "horarios"])

@section('body')

    <div class="card border">
        <div class="card-body">
            <form id="scheduleForm">
                @csrf
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
                    method: "POST",
                    url: "/api/horario",
                    data: dadosForm
                })
                .then(function(data) {
                    console.log(data);
                    alert('Horário cadastrado com sucesso!');
                    location.replace('/horarios');
                })
                .catch(function(err) {
                    console.log(err);
                });

            // $.post("/api/horario", dadosForm, function(data, status) {
            //     if (status === 'success') {
            //         alert('Horário cadastrado com sucesso!');
            //         location.replace('/horarios');
            //     }
            // });
        });

        function cancela() {
            location.replace('/horarios');
        };

        $(function() {
            loadSchedules();
        });

    </script>
@endsection
