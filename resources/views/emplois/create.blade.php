@extends('layout')

@section('content')
<h2 class="mb-3">Ajouter un créneau</h2>

<form action="{{ route('emplois.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Jour</label>
        <select name="jour" class="form-control" required>
            <option value="">-- Sélectionner --</option>
            <option value="Lundi">Lundi</option>
            <option value="Mardi">Mardi</option>
            <option value="Mercredi">Mercredi</option>
            <option value="Jeudi">Jeudi</option>
            <option value="Vendredi">Vendredi</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Heure début</label>
        <input type="time" name="heure_debut" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Heure fin</label>
        <input type="time" name="heure_fin" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Cours</label>
        <select name="cours_id" class="form-control">
            <option value="">-- Sélectionner un cours --</option>
            @foreach ($cours as $c)
                <option value="{{ $c->id }}">{{ $c->nom }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Enregistrer</button>
    <a href="{{ route('emplois.index') }}" class="btn btn-secondary">Annuler</a>

</form>
@endsection
