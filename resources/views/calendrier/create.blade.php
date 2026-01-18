<!-- resources/views/calendrier/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Créer un nouvel événement</h1>
        
        <form action="{{ route('calendrier.store') }}" method="POST" class="bg-white rounded-lg shadow p-6">
            @csrf
            
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
            
            <div class="mb-4">
                <label for="title" class="block text-gray-700 mb-2">Titre *</label>
                <input type="text" 
                       id="title" 
                       name="title" 
                       value="{{ old('title') }}"
                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                       required>
                @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="description" class="block text-gray-700 mb-2">Description</label>
                <textarea id="description" 
                          name="description" 
                          rows="3"
                          class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="start" class="block text-gray-700 mb-2">Date et heure de début *</label>
                    <input type="datetime-local" 
                           id="start" 
                           name="start" 
                           value="{{ old('start') }}"
                           class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('start')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div>
                    <label for="end" class="block text-gray-700 mb-2">Date et heure de fin</label>
                    <input type="datetime-local" 
                           id="end" 
                           name="end" 
                           value="{{ old('end') }}"
                           class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('end')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="type" class="block text-gray-700 mb-2">Type d'événement *</label>
                    <select id="type" 
                            name="type" 
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        <option value="">Sélectionnez un type</option>
                        @foreach($eventTypes as $key => $label)
                            <option value="{{ $key }}" {{ old('type') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('type')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div>
                    <label for="color" class="block text-gray-700 mb-2">Couleur</label>
                    <input type="color" 
                           id="color" 
                           name="color" 
                           value="{{ old('color', '#3b82f6') }}"
                           class="w-full h-12 cursor-pointer rounded border">
                    @error('color')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" 
                           name="is_public" 
                           value="1"
                           {{ old('is_public') ? 'checked' : '' }}
                           class="mr-2">
                    <span class="text-gray-700">Rendre cet événement public</span>
                </label>
                @error('is_public')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="flex gap-4">
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition">
                    Créer l'événement
                </button>
                <a href="{{ route('calendrier.index') }}" 
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded-lg transition">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection