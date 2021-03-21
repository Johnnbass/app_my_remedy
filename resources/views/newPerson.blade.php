@extends('layout.app', ["current" => "pessoas"])

@section('body')

    <div class="card border">
        <div class="card-body">
            <form action="/api/pessoa" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Digite o nome da pessoa..."/>
                </div>
                <div class="form-group">
                    <label for="age">Idade</label>
                    <input type="text" class="form-control" name="age" id="age" placeholder="Digite a idade da pessoa (opcional)..."/>
                </div>
                <div class="form-group">
                    <label for="address">Endereço</label>
                    <input type="text" class="form-control" name="address" id="address" placeholder="Digite o endereço da pessoa (opcional)..."/>
                </div>
                <button type="submit" class="btn btn-info btn-sm">Salvar</button>
                <button type="cancel" class="btn btn-danger btn-sm">Cancel</button>
            </form>
        </div>
    </div>

@endsection
