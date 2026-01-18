@extends('layout')

@section('content')
<h2 class="mb-3">Emploi du temps</h2>

<a href="{{ route('emplois.create') }}" class="btn btn-success mb-3">Ajouter un créneau</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Jour</th>
            <th>Heure début</th>
            <th>Heure fin</th>
            <th>Cours</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($emplois as $e)
        <tr>
            <td>{{ $e->id }}</td>
            <td>{{ $e->jour }}</td>
            <td>{{ $e->heure_debut }}</td>
            <td>{{ $e->heure_fin }}</td>
            <td>{{ $e->cours->nom ?? 'Non assigné' }}</td>
            <td>
                <a href="{{ route('emplois.edit', $e->id) }}" class="btn btn-primary btn-sm">Modifier</a>

                <form action="{{ route('emplois.destroy', $e->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Supprimer ce créneau ?')" class="btn btn-danger btn-sm">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
