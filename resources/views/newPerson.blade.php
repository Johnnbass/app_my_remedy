@extends('layout.app', ["current" => "pessoas"])

@section('body')

    <div class="card border">
        <div class="card-body">
            <form id="personForm">
                @csrf
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

        $('#personForm').submit(function(e) {
            e.preventDefault();

            const dadosForm = $('#personForm').serialize();

            $.post("/api/pessoa", dadosForm, function(data) {
                if (status === 'success') {
                    alert('Pessoa cadastrada com sucesso!');
                    location.replace('/pessoas');
                }
            });
        });

        function cancela() {
            location.replace('/pessoas');
        };

    </script>
@endsection
