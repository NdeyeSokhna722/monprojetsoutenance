@extends('layouts.app')

@section('title', 'Messages')

@section('content')
    <div class="container mx-auto p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Messages</h1>
            <p class="text-gray-600 dark:text-gray-400">Communiquez avec les autres utilisateurs.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Liste des conversations -->
            <div class="lg:col-span-1 bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-semibold">Conversations</h2>
                </div>
                <div class="overflow-y-auto h-[calc(100vh-300px)]">
                    @forelse($conversations as $userId => $messages)
                        @php
                            $user = $messages->first()->sender_id == Auth::id() 
                                ? $messages->first()->receiver 
                                : $messages->first()->sender;
                        @endphp
                        <a href="{{ route('messages.show', $user) }}" 
                           class="flex items-center p-4 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full flex items-center justify-center text-white font-bold">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="font-medium text-gray-900 dark:text-white">{{ $user->name }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400 truncate">{{ $messages->first()->content }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $messages->first()->created_at->diffForHumans() }}</p>
                                @if($messages->first()->sender_id != Auth::id() && !$messages->first()->read_at)
                                    <span class="inline-block w-2 h-2 bg-red-500 rounded-full"></span>
                                @endif
                            </div>
                        </a>
                    @empty
                        <p class="p-4 text-gray-500 dark:text-gray-400">Aucune conversation.</p>
                    @endforelse
                </div>
            </div>

            <!-- Zone de conversation (vide par défaut) -->
            <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-semibold">Sélectionnez une conversation</h2>
                </div>
                <div class="flex items-center justify-center h-[calc(100vh-300px)]">
                    <p class="text-gray-500 dark:text-gray-400">Choisissez une conversation pour commencer à discuter.</p>
                </div>
            </div>
        </div>
    </div>
@endsection