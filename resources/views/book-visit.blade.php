<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Visit | VisiTrack</title>
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
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <section class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-2xl font-bold text-primary mb-4">Book a Visit</h2>
            <form action="{{ url('/book-visit') }}" method="POST">
                @csrf
                <!-- Form Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <input type="text" name="visitor_name" placeholder="First Name" class="border p-2 rounded" required>
                    <input type="text" name="visitor_last_name" placeholder="Last Name" class="border p-2 rounded" required>
                    <input type="text" name="designation" placeholder="Designation" class="border p-2 rounded" required>
                    <input type="text" name="organization" placeholder="Organization" class="border p-2 rounded" required>
                    <input type="email" name="visitor_email" placeholder="Email Address" class="border p-2 rounded" required>
                    <input type="text" name="visitor_number" placeholder="Phone Number" class="border p-2 rounded" required>
                    <input type="text" name="id_number" placeholder="ID Number" class="border p-2 rounded" required>
                    <select name="visit_type" class="border p-2 rounded" required>
                        <option value="" disabled selected>Visit Type</option>
                        <option value="Business">Business</option>
                        <option value="Official">Official</option>
                        <option value="Educational">Educational</option>
                        <option value="Social">Social</option>
                        <option value="Tour">Tour</option>
                        <option value="Other">Other</option>
                    </select>
                    <select name="visit_facility" class="border p-2 rounded" required>
                        <option value="" disabled selected>Visit Facility</option>
                        <option value="Library">Library</option>
                        <option value="Administration Block">Administration Block</option>
                        <option value="Science Block">Science Block</option>
                        <option value="Auditorium">Auditorium</option>
                        <option value="SHS">School Of Health Science</option>
                    </select>
                    <input type="date" name="visit_date" class="border p-2 rounded" required>
                    <div class="flex items-center gap-2">
                        <label for="visit-from" class="text-gray-700">From:</label>
                        <input type="time" id="visit-from" name="visit_from" class="border p-2 rounded w-full" required>
                    </div>
                    <div class="flex items-center gap-2">
                        <label for="visit-to" class="text-gray-700">To:</label>
                        <input type="time" id="visit-to" name="visit_to" class="border p-2 rounded w-full" required>
                    </div>
                    <!-- Purpose of Visit Field -->
                    <textarea name="purpose_of_visit" placeholder="Purpose of Visit" class="border p-2 rounded w-full md:col-span-full" rows="2" required></textarea>
                    <select name="host_id" class="border p-2 rounded w-full md:col-span-full" required>
                        <option value="" disabled selected>Host's Name</option>
                        @foreach($hosts as $host)
                            <option value="{{ $host->id }}">{{ $host->name }}</option>
                        @endforeach
                    </select>
                </div>
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
