@extends('layout.app', ["current" => "pessoas"])

@section('body')

    <div class="card border">
        <div class="card-body">
            <form id="personForm">
                @csrf
                <input type="hidden" name="id" id="id" value="{{ $id ?? ''}}"/>
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" name="name" id="name"
                        placeholder="Digite o nome da pessoa..." />
                </div>
                <div class="form-group">
                    <label for="age">Idade</label>
                    <input type="text" class="form-control" name="age" id="age"
                        placeholder="Digite a idade da pessoa (opcional)..." />
                </div>
                <div class="form-group">
                    <label for="address">Endereço</label>
                    <input type="text" class="form-control" name="address" id="address"
                        placeholder="Digite o endereço da pessoa (opcional)..." />
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

        const personID = $('#id').val();

        $('#personForm').submit(function(e) {
            e.preventDefault();

            const dadosForm = $('#personForm').serialize();

            $.ajax({
                method: (personID) ? "PUT" : "POST",
                url: `/api/pessoa/${personID}`,
                data: dadosForm,
                dataType: 'json',
                success: function(res) {
                    let ret = 'Pessoa ' + ((personID) ? 'alterada' : 'cadastrada') + ' com sucesso!';
                    alert(ret);
                    location.assign('/pessoas');
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
            location.assign('/pessoas');
        };

        function loadPersonData(id) {
            $.getJSON(`/api/pessoa/${id}`, function(data) {
                $('#name').val(data.name);
                $('#age').val(data.age);
                $('#address').val(data.address);
            });
        }

        $(function() {
            loadPersonData(personID);
        });

    </script>
@endsection
