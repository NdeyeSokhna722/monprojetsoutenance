@extends('layout')

@section('content')
<h2 class="mb-3">Modifier un créneau</h2>

<form action="{{ route('emplois.update', $emploi->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Jour</label>
        <select name="jour" class="form-control" required>
            @foreach (['Lundi','Mardi','Mercredi','Jeudi','Vendredi'] as $jour)
                <option value="{{ $jour }}" @if($emploi->jour==$jour) selected @endif>{{ $jour }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Heure début</label>
        <input type="time" name="heure_debut" class="form-control" value="{{ $emploi->heure_debut }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Heure fin</label>
        <input type="time" name="heure_fin" class="form-control" value="{{ $emploi->heure_fin }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Cours</label>
        <select name="cours_id" class="form-control">
            @foreach ($cours as $c)
                <option value="{{ $c->id }}" @if($emploi->cours_id==$c->id) selected @endif>{{ $c->nom }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Modifier</button>
    <a href="{{ route('emplois.index') }}" class="btn btn-secondary">Retour</a>
</form>
@endsection
