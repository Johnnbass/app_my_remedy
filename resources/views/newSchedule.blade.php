@extends('layout.app', ["current" => "horarios"])

@section('body')

    <div class="card border">
        <div class="card-body">
            <form action="/api/horario" method="POST">
                @csrf
                <div class="form-group">
                    <label for="schedule">Horário</label>
                    <input type="text" class="form-control" name="schedule" id="schedule"/>
                </div>
                <button type="submit" class="btn btn-info btn-sm">Salvar</button>
                <button type="cancel" class="btn btn-danger btn-sm">Cancel</button>
            </form>
        </div>
    </div>

@endsection
