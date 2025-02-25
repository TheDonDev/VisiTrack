<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visit Status | VisiTrack</title>
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
            <h2 class="text-2xl font-bold text-primary mb-6">Visit Status</h2>

            <!-- Visit Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <h3 class="text-lg font-semibold text-primary mb-2">Visit Number:</h3>
                    <p class="text-gray-700">{{ $visit->visit_number }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-primary mb-2">Total Visitors:</h3>
                    <p class="text-gray-700">{{ $totalVisitors }}</p>
                </div>
            </div>

            <!-- Host Information -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-primary mb-4">Host Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-lg font-semibold text-primary mb-2">Host Name:</h4>
                        <p class="text-gray-700">{{ $visit->host->host_name }}</p>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-primary mb-2">Host Email:</h4>
                        <p class="text-gray-700">{{ $visit->host->host_email }}</p>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-primary mb-2">Host Phone:</h4>
                        <p class="text-gray-700">{{ $visit->host->host_number }}</p>
                    </div>
                </div>
            </div>

            <!-- Visitor Details -->
            <div class="mt-8">
                <h3 class="text-xl font-bold text-primary mb-4">Visitor Details</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($visitors as $visitor)
                            <tr class="border-b">
                                <td class="px-4 py-2 text-gray-700">{{ $visitor->visitor_name }} {{ $visitor->visitor_last_name }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $visitor->visitor_email }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $visitor->visitor_number }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end mt-6">
                <a href="/" class="bg-primary text-white px-4 py-2 rounded hover:bg-primary-dark">
                    Back to Home
                </a>
            </div>
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
