@extends('layouts.app')

@section('content')

{{-- TITRE + BOUTON --}}
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-gray-900">
        Liste des notes
    </h1>

    <a href="{{ route('notes.create') }}"
       class="bg-orange-600 hover:bg-orange-700 text-white
              px-5 py-2 rounded-lg shadow transition flex items-center gap-2">
        <i class="fas fa-plus"></i>
        Ajouter une note
    </a>
</div>

{{-- TABLE --}}
<div class="bg-black rounded-xl shadow-lg overflow-hidden">

    <table class="w-full text-sm text-white">
        <thead class="bg-gray-900 text-gray-300">
            <tr>
                <th class="p-4 text-left">ID</th>
                <th class="p-4 text-left">Étudiant</th>
                <th class="p-4 text-left">Cours</th>
                <th class="p-4 text-left">Note</th>
                <th class="p-4 text-left">Date</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($notes as $note)
            <tr class="border-b border-gray-800 hover:bg-gray-900 transition">
                <td class="p-4">{{ $note->id }}</td>

                <td class="p-4 font-medium">
                    {{ $note->etudiant->nom ?? '—' }}
                </td>

                <td class="p-4">
                    <span class="px-3 py-1 rounded-full
                                 bg-orange-600/20 text-orange-400 text-xs">
                        {{ $note->cours->nom ?? '—' }}
                    </span>
                </td>

                <td class="p-4 text-lg font-bold text-orange-400">
                    {{ $note->valeur }}
                </td>

                <td class="p-4 text-gray-400">
                    {{ $note->created_at->format('d/m/Y') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="p-6 text-center text-gray-400">
                    Aucune note enregistrée.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection
