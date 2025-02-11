<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join a Visit | VisiTrack</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>

    <style>
        :root {
            --primary-color: #004080;
            --secondary-color: #ffcc00;
        }

        .bg-primary {
            background-color: var(--primary-color);
        }

        .text-primary {
            color: var(--primary-color);
        }

        .bg-secondary {
            background-color: var(--secondary-color);
        }

        .text-secondary {
            color: var(--secondary-color);
        }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Header -->
    <header class="bg-primary text-white py-4">
        <div class="container mx-auto flex items-center justify-between">
            <h1 class="text-2xl font-bold">VisiTrack</h1>
            <img src="{{ asset('images/image.png') }}" alt="Alupe University Logo" class="h-12">
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto mt-8">
        <section class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-bold text-primary mb-4">Join a Visit</h2>
            <form action="{{ url('/join-visit') }}" method="POST">
                @csrf
                <input type="text" name="visit_number" placeholder="Visit Number" class="border p-2 rounded w-full mb-4" required>
                <input type="text" name="visitor_name" placeholder="First Name" class="border p-2 rounded w-full mb-4" required>
                <input type="text" name="visitor_last_name" placeholder="Last Name" class="border p-2 rounded w-full mb-4" required>
                <input type="text" name="designation" placeholder="Designation" class="border p-2 rounded w-full mb-4" required>
                <input type="email" name="visitor_email" placeholder="Email" class="border p-2 rounded w-full mb-4" required>
                <input type="text" name="visitor_number" placeholder="Phone" class="border p-2 rounded w-full mb-4" required>
                <input type="text" name="id_number" placeholder="ID Number" class="border p-2 rounded w-full mb-4" required>
                <input type="text" name="organization" placeholder="Organization" class="border p-2 rounded w-full mb-4" required>
                <!-- Submit and Cancel Buttons -->
                <div class="flex justify-end gap-4 mt-6">
                    <a href="/" class="bg-gray-300 text-gray-800 px-4 py-2 rounded">Cancel</a>
                    <button type="submit" class="bg-primary text-white px-4 py-2 rounded">Submit</button>
                </div>
            </form>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-primary text-white py-4 mt-12">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Alupe University. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
