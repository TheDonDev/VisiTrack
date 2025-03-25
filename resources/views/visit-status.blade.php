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

        .fixed-height-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Ensure it takes up full viewport height */
        }

        .fixed-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 10; /* Ensure it's above the content */
        }

        .scrollable-content {
            flex-grow: 1; /* Allow content to grow and scroll */
            overflow-y: auto; /* Enable vertical scrolling */
            padding-top: 4rem; /* Add padding to account for fixed header */
            padding-bottom: 4rem; /* Add padding for the footer */
        }

        .fixed-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 10; /* Ensure it's above the content */
        }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal fixed-height-container">

    <!-- Header -->
    <header class="fixed-header bg-primary text-white py-4">
        <div class="container mx-auto flex items-center justify-between">
            <h1 class="text-2xl font-bold">VisiTrack</h1>
            <img src="{{ asset('images/image.png') }}" alt="Alupe University Logo" class="h-12">
        </div>
    </header>

    <!-- Main Content -->
    <main class="scrollable-content">
        <section class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-bold text-primary mb-6">Visit Status</h2>

            <!-- Visit Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <h3 class="text-lg font-semibold text-primary mb-2">Visit Number:</h3>
                    <p class="text-gray-700">{{ $visitRecord->visit_number }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-primary mb-2">Total Visitors:</h3>
                    <p class="text-gray-700">{{ $totalVisitors ?? 0 }}</p>
                </div>
            </div>

            <!-- Visit Details -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-primary mb-4">Visit Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-lg font-semibold text-primary mb-2">Visit Type:</h4>
                        <p class="text-gray-700">{{ $visitRecord->visit_type }}</p>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-primary mb-2">Visit Facility:</h4>
                        <p class="text-gray-700">{{ $visitRecord->visit_facility }}</p>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-primary mb-2">Visit Date:</h4>
                        <p class="text-gray-700">{{ $visitRecord->visit_date }}</p>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-primary mb-2">Visit From:</h4>
                        <p class="text-gray-700">{{ $visitRecord->visit_from }}</p>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-primary mb-2">Visit To:</h4>
                        <p class="text-gray-700">{{ $visitRecord->visit_to }}</p>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-primary mb-2">Purpose of Visit:</h4>
                        <p class="text-gray-700">{{ $visitRecord->purpose_of_visit }}</p>
                    </div>
                </div>
            </div>

            <!-- Host Information -->
            <div class="mb-8">
                <h3 class="text-xl font-bold text-primary mb-4">Host Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="text-lg font-semibold text-primary mb-2">Host Name:</h4>
                        <p class="text-gray-700">{{ $visitRecord->host->host_name }}</p>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-primary mb-2">Host Email:</h4>
                        <p class="text-gray-700">{{ $visitRecord->host->host_email }}</p>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-primary mb-2">Host Phone:</h4>
                        <p class="text-gray-700">{{ $visitRecord->host->host_number }}</p>
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
                                <th class="px-4 py-2">Type</th>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Phone</th>
                                <th class="px-4 py-2">Designation</th>
                                <th class="px-4 py-2">Organization</th>
                                <th class="px-4 py-2">ID Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($visitors as $visitor)
                            <tr class="border-b">
                                <td class="px-4 py-2 text-gray-700">
                                    @if($visitor->id === $visitRecord->visitor_id)
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Booked</span>
                                    @else
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Joined</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-gray-700">{{ $visitor->first_name }} {{ $visitor->last_name }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $visitor->email }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $visitor->phone_number }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $visitor->designation }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $visitor->organization }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $visitor->id_number }}</td>
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
    <footer class="fixed-footer bg-primary text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; 2025 Alupe University. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
