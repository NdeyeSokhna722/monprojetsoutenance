<x-app-layout>
    <h1 class="text-3xl font-bold mb-6">Liste des utilisateurs</h1>

    <div class="bg-white shadow p-6 rounded-lg">
        <table class="min-w-full">
            <thead>
                <tr class="border-b">
                    <th class="py-3 text-left">Nom</th>
                    <th class="py-3 text-left">Email</th>
                    <th class="py-3 text-left">Rôle</th>
                </tr>
            </thead>

            <tbody>
                @foreach(\App\Models\User::all() as $user)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="py-3">{{ $user->name }}</td>
                        <td class="py-3">{{ $user->email }}</td>
                        <td class="py-3">Admin / Prof / Étudiant</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
