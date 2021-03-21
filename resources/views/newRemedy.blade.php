@extends('layout.app', ["current" => "medicamentos"])

@section('body')

    <div class="card border">
        <div class="card-body">
            <form action="/api/medicamento" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" name="name" id="name"
                        placeholder="Digite o nome do medicamento..." />
                </div>
                <div class="form-group">
                    <label for="age">Dosagem</label>
                    <input type="text" class="form-control" name="dosage" id="dosage"
                        placeholder="Digite a dosagem do medicamento..." />
                </div>
                <div class="form-group">
                    <label for="address">Preço</label>
                    <input type="text" class="form-control" name="price" id="price"
                        placeholder="Digite o preço do medicamento (opcional)..." />
                </div>
                <div class="form-group">
                    <label for="address">Horário</label>
                    <select class="form-control" name="schedule_id" id="schedule_id">
                        <option value="">Selecione um Horário</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="address">Pessoa</label>
                    <select class="form-control" name="person_id" id="person_id">
                        <option value="">Selecione uma Pessoa</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="address">Período</label>
                    <input type="text" class="form-control" name="period" id="period" />
                </div>
                <button type="submit" class="btn btn-info btn-sm">Salvar</button>
                <button type="cancel" class="btn btn-danger btn-sm">Cancel</button>
            </form>
        </div>
    </div>

@endsection

@section('javascript')
    <script type="text/javascript">
        function loadSchedules() {
            $.getJSON("/api/horario", function(data) {
                for (let i = 0; i < data.length; i++) {
                    option = `<option value"${data[i].id}">${data[i].schedule}</option>`;
                    $('#schedule_id').append(option);
                }
            });
        }

        function loadPeople() {
            $.getJSON("/api/pessoa", function(data) {
                for (let i = 0; i < data.length; i++) {
                    option = `<option value"${data[i].id}">${data[i].name}</option>`;
                    $('#person_id').append(option);
                }
            });
        }

        $(function() {
            loadSchedules();
            loadPeople();
        })

    </script>
@endsection
