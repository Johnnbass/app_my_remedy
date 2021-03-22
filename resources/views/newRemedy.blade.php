@extends('layout.app', ["current" => "medicamentos"])

@section('body')

    <div class="card border">
        <div class="card-body">
            <form id="remedyForm">
                @csrf
                <input type="hidden" name="id" id="id" value="{{ $id ?? ''}}"/>
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
                        <option value="">Selecione um Horário...</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="address">Pessoa</label>
                    <select class="form-control" name="person_id" id="person_id">
                        <option value="">Selecione uma Pessoa...</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="address">Período</label>
                    <input type="text" class="form-control" name="period" id="period"
                        placeholder="Informe o período (em dias)..." />
                </div>
                <button type="submit" class="btn btn-info btn-sm">Salvar</button>
                <button type="cancel" class="btn btn-danger btn-sm">Cancelar</button>
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

        const remedyID = $('#id').val();

        function loadSchedules() {
            $.getJSON("/api/horario", function(data) {
                for (let i = 0; i < data.length; i++) {
                    option = `<option value="${data[i].id}">${data[i].schedule}</option>`;
                    $('#schedule_id').append(option);
                }
            });
        }

        function loadPeople() {
            $.getJSON("/api/pessoa", function(data) {
                for (let i = 0; i < data.length; i++) {
                    option = `<option value="${data[i].id}">${data[i].name}</option>`;
                    $('#person_id').append(option);
                }
            });
        }

        $('#remedyForm').submit(function(e) {
            e.preventDefault();

            let dadosForm = $('#remedyForm').serialize();
            
            $.ajax({
                method: (remedyID) ? "PUT" : "POST",
                url: `/api/medicamento/${remedyID}`,
                data: dadosForm,
                dataType: 'json',
                success: function(res) {
                    let ret = 'Medicamento ' + ((remedyID) ? 'alterado' : 'cadastrado') + ' com sucesso!';
                    alert(ret);
                    location.assign('/medicamentos');
                },
                error: function(xhr) {
                    let error = xhr.responseJSON.errors;
                    let ret = '';

                    for (err in error) {
                        ret += '* ' + error[err] + '\n';
                    }

                    alert(ret);
                }
            });
        });

        function cancela() {
            location.assign('/medicamentos');
        };

        function loadRemedyData(id) {
            $.getJSON(`/api/medicamento/${id}`, function(data) {
                $('#name').val(data.name);
                $('#dosage').val(data.dosage);
                $('#price').val(data.price);
                $('#schedule_id').val(data.schedule_id);
                $('#person_id').val(data.person_id);
                $('#period').val(data.period);
            });
        }

        $(function() {
            loadSchedules();
            loadPeople();
            loadRemedyData(remedyID);
        })

    </script>
@endsection
