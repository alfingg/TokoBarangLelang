<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    {{-- Header/Navigasi Admin --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Menu Admin</a>
            {{-- Isi navigasi lain --}}
        </div>
    </nav>
    
    <div class="container mt-4"> 
        {{-- KONTEN UTAMA DENGAN MARGIN ATAS --}}
        @yield('content') 
    </div>

    <footer class="mt-5 p-3 bg-light text-center">
        &copy; {{ date('Y') }} Admin Panel
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdhr0W7tFz8X5LwS4z1Kx4G2M" crossorigin="anonymous"></script>

</body>
</html>