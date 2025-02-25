<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pemakaian</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{asset('asset/pln.png')}}">
    <style>
        /* Flexbox untuk memastikan footer berada di bawah */
        body, html {
            height: 100%;
        }

        .content-wrapper {
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Wrapper utama -->
    <div class="content-wrapper">
        <!-- Header -->
        <header class=" text-white py-4" style="background: #07acea">
            <div class="container mx-auto flex justify-between items-center">
                <div class="text-lg font-semibold">Data Pemakaian</div>

            </div>
        </header>

        <!-- Content -->
        <div class="container mx-auto mt-8 content">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-4">
            <div class="container mx-auto text-center text-sm">
                &copy; <script>document.write(new Date().getFullYear())</script> Data Pemakaian. All rights reserved.
            </div>
        </footer>
    </div>
</body>
</html>
