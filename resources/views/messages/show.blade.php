@extends('layouts.app')

@section('title', 'Conversation avec ' . $user->name)

@section('content')
    <div class="container mx-auto p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Conversation avec {{ $user->name }}</h1>
            <a href="{{ route('messages.index') }}" class="text-orange-600 hover:text-orange-700">← Retour aux conversations</a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Liste des conversations (identique à l'index) -->
            <div class="lg:col-span-1 bg-white dark:bg-gray-800 rounded-lg shadow">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-semibold">Conversations</h2>
                </div>
                <div class="overflow-y-auto h-[calc(100vh-300px)]">
                    @forelse($conversations as $userId => $messages)
                        @php
                            $otherUser = $messages->first()->sender_id == Auth::id() 
                                ? $messages->first()->receiver 
                                : $messages->first()->sender;
                        @endphp
                        <a href="{{ route('messages.show', $otherUser) }}" 
                           class="flex items-center p-4 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 {{ $otherUser->id == $user->id ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full flex items-center justify-center text-white font-bold">
                                    {{ substr($otherUser->name, 0, 1) }}
                                </div>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="font-medium text-gray-900 dark:text-white">{{ $otherUser->name }}</p>
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

            <!-- Conversation sélectionnée -->
            <div class="lg:col-span-2 flex flex-col bg-white dark:bg-gray-800 rounded-lg shadow">
                <!-- En-tête de la conversation -->
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full flex items-center justify-center text-white font-bold mr-3">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $user->name }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Messages -->
                <div class="flex-1 p-4 overflow-y-auto h-[400px]" id="messagesContainer">
                    @foreach($messages->reverse() as $message)
                        <div class="mb-4 {{ $message->sender_id == Auth::id() ? 'text-right' : '' }}">
                            <div class="inline-block max-w-[70%] p-3 rounded-lg {{ $message->sender_id == Auth::id() ? 'bg-orange-100 dark:bg-orange-900' : 'bg-gray-100 dark:bg-gray-700' }}">
                                <p class="text-sm text-gray-800 dark:text-gray-200">{{ $message->content }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $message->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Formulaire d'envoi -->
                <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                    <form action="{{ route('messages.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                        <div class="flex gap-2">
                            <input type="text" 
                                   name="content" 
                                   placeholder="Écrivez votre message..." 
                                   class="flex-1 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-4 py-2 focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                   required>
                            <button type="submit" 
                                    class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg transition">
                                Envoyer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Faire défiler vers le bas pour voir les derniers messages
        document.getElementById('messagesContainer').scrollTop = document.getElementById('messagesContainer').scrollHeight;
    </script>
@endsection