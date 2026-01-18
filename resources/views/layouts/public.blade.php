<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SORDALAB - Matériel Pédagogique')</title>
    
    {{-- Pour le site public, on utilise CDN Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50">
    {{-- NAVIGATION DU SITE PUBLIC --}}
    @include('partials.public-nav')
    
    {{-- CONTENU --}}
    @yield('content')
    
    {{-- FOOTER --}}
    @include('partials.public-footer')
    
    @stack('scripts')
</body>
</html>