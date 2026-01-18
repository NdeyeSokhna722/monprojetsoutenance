@extends('layout')

@section('content')
<h2 class="mb-3">Ajouter un cours</h2>

<form action="{{ route('cours.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Nom du cours</label>
        <input type="text" name="nom" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Enseignant responsable</label>
        <select name="enseignant_id" class="form-control">
            <option value="">-- Sélectionner --</option>
            @foreach ($enseignants as $ens)
                <option value="{{ $ens->id }}">{{ $ens->nom }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Enregistrer</button>
    <a href="{{ route('cours.index') }}" class="btn btn-secondary">Annuler</a>

</form>
@endsection
