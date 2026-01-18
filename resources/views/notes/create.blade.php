@extends('layouts.app')

@section('content')

{{-- TITRE --}}
<h1 class="text-3xl font-bold text-gray-900 mb-8">
    Ajouter une note
</h1>

{{-- CARTE --}}
<div class="bg-black rounded-xl shadow-lg p-8 max-w-2xl">

    <form action="{{ route('notes.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- ETUDIANT --}}
        <div>
            <label class="block text-gray-300 mb-2">Étudiant</label>
            <select name="etudiant_id" required
                    class="w-full px-4 py-2 rounded-lg bg-gray-900 text-white
                           focus:ring-2 focus:ring-orange-500 focus:outline-none">
                <option value="">— Choisir un étudiant —</option>
                @foreach ($etudiants as $e)
                    <option value="{{ $e->id }}">
                        {{ $e->nom }} {{ $e->prenom ?? '' }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- COURS --}}
        <div>
            <label class="block text-gray-300 mb-2">Cours</label>
            <select name="cours_id" required
                    class="w-full px-4 py-2 rounded-lg bg-gray-900 text-white
                           focus:ring-2 focus:ring-orange-500 focus:outline-none">
                <option value="">— Choisir un cours —</option>
                @foreach ($cours as $c)
                    <option value="{{ $c->id }}">
                        {{ $c->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- NOTE --}}
        <div>
            <label class="block text-gray-300 mb-2">Note (0 à 20)</label>
            <input type="number"
                   name="valeur"
                   min="0"
                   max="20"
                   step="0.5"
                   required
                   class="w-full px-4 py-2 rounded-lg bg-gray-900 text-white
                          focus:ring-2 focus:ring-orange-500 focus:outline-none">
        </div>

        {{-- ACTIONS --}}
        <div class="flex gap-4 pt-4">
            <button type="submit"
                    class="bg-orange-600 hover:bg-orange-700 text-white
                           px-6 py-2 rounded-lg shadow transition flex items-center gap-2">
                <i class="fas fa-save"></i>
                Enregistrer
            </button>

            <a href="{{ route('notes.index') }}"
               class="text-gray-400 hover:text-gray-200 transition">
                Annuler
            </a>
        </div>

    </form>
</div>

@endsection
