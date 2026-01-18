@extends('layout')

@section('content')
<h2 class="mb-3">Modifier le cours</h2>

<form action="{{ route('cours.update', $cours->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Nom du cours</label>
        <input type="text" name="nom" class="form-control" value="{{ $cours->nom }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Enseignant responsable</label>
        <select name="enseignant_id" class="form-control">
            @foreach ($enseignants as $ens)
                <option value="{{ $ens->id }}" 
                    @if($cours->enseignant_id == $ens->id) selected @endif>
                    {{ $ens->nom }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Modifier</button>
    <a href="{{ route('cours.index') }}" class="btn btn-secondary">Retour</a>

</form>
@endsection
