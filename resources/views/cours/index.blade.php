@extends('layout')

@section('content')
<h2 class="mb-3">Liste des cours</h2>

<a href="{{ route('cours.create') }}" class="btn btn-success mb-3">Ajouter un cours</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom du cours</th>
            <th>Enseignant</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cours as $c)
        <tr>
            <td>{{ $c->id }}</td>
            <td>{{ $c->nom }}</td>
            <td>{{ $c->enseignant->nom ?? 'Non assigné' }}</td>
            <td>
                <a href="{{ route('cours.edit', $c->id) }}" class="btn btn-primary btn-sm">Modifier</a>

                <form action="{{ route('cours.destroy', $c->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Supprimer ce cours ?')" class="btn btn-danger btn-sm">
                        Supprimer
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
