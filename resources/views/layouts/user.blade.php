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

        /* Header Styling */
        header {
            background: #07acea;
        }

        /* Card Styling */
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #4A4A4A;
        }

        .card-value {
            font-size: 2rem;
            font-weight: 700;
        }

        /* Footer Styling */
        footer {
            background-color: #2d3748;
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Wrapper utama -->
    <div class="content-wrapper">
        <!-- Header -->
        <header class="text-white py-6 shadow-md">
            <div class="container mx-auto flex justify-between items-center px-4">
                <div class="text-lg font-semibold">Data Pemakaian</div>
            </div>
        </header>

        <!-- Content -->
        <div class="container mx-auto mt-8 content px-4">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-6 mt-8">
            <div class="container mx-auto text-center text-sm">
                &copy; <script>document.write(new Date().getFullYear())</script> Data Pemakaian. All rights reserved.
            </div>
        </footer>
    </div>

</body>
</html>
