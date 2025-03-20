<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VisiTrack | Alupe University</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        window.successMessage = "{{ session('success') }}";
        window.visitNumber = "{{ session('visit_number') }}";

        document.addEventListener('DOMContentLoaded', function () {
            if (window.successMessage) {
                let message = window.successMessage;
                if (window.visitNumber) {
                    message += ` Your visit number is: ${window.visitNumber}. You can share this number to let someone else join the visit.`;
                }
                document.getElementById('success-text').innerText = message;
                document.getElementById('success-message').classList.remove('hidden');
            }
        });
    </script>

    <!-- Debugging Statement -->
    <script>
        console.log('Session Visit Number:', "{{ session('visit_number') }}");
    </script>

    <!-- Success Message Popup -->
    <div id="success-message" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h2 class="text-xl font-bold text-primary">Success!</h2>
            <p id="success-text"></p>
            <button onclick="document.getElementById('success-message').classList.add('hidden')" class="mt-4 bg-primary text-white px-4 py-2 rounded">Close</button>
        </div>
    </div>

    <!-- Login/Signup Modal -->
    <div id="auth-modal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg text-center">
            <h2 class="text-xl font-bold text-primary">Login</h2>
            <form id="auth-form" action="{{ route('security.login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <input type="email" name="email" class="w-full px-3 py-2 border rounded-lg" placeholder="Email" required>
                </div>
                <div class="mb-4">
                    <input type="password" name="password" class="w-full px-3 py-2 border rounded-lg" placeholder="Password" required>
                </div>
                <button type="submit" class="bg-primary text-white px-4 py-2 rounded hover:bg-primary-dark">Log In</button>
                <button type="button" onclick="document.getElementById('auth-modal').classList.add('hidden')" class="mt-4 bg-secondary text-white px-4 py-2 rounded">Close</button>
            </form>
            <h2 class="text-xl font-bold text-primary mt-4">Sign Up</h2>
            <form id="signup-form" action="{{ route('security.signup') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <input type="text" name="name" class="w-full px-3 py-2 border rounded-lg" placeholder="Name" required>
                </div>
                <div class="mb-4">
                    <input type="text" name="username" class="w-full px-3 py-2 border rounded-lg" placeholder="Username" required>
                </div>
                <div class="mb-4">
                    <input type="email" name="email" class="w-full px-3 py-2 border rounded-lg" placeholder="Email" required>
                </div>
                <div class="mb-4">
                    <input type="password" name="password" class="w-full px-3 py-2 border rounded-lg" placeholder="Password" required>
                </div>
                <button type="submit" class="bg-primary text-white px-4 py-2 rounded hover:bg-primary-dark">Sign Up</button>
                <button type="button" onclick="document.getElementById('auth-modal').classList.add('hidden')" class="mt-4 bg-secondary text-white px-4 py-2 rounded">Close</button>
            </form>
        </div>
    </div>

    <style>
        :root {
            --primary-color: #004080; /* Alupe's blue */
            --secondary-color: #ffcc00; /* Alupe's gold */
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
    <!-- Homepage Overview -->
    <section class="text-center mb-12">
        <h2 class="text-3xl font-bold text-primary">Welcome to VisiTrack</h2>
        <p class="mt-4 text-gray-700">An efficient digital visitor management system for Alupe University.</p>
    </section>

    <!-- Action Buttons -->
    <section class="text-center mb-12">
        <a href="{{ route('book.visit') }}" class="bg-primary text-white px-6 py-3 rounded mr-4">Book a Visit</a>
        <a href="{{ route('join.visit') }}" class="bg-secondary text-white px-6 py-3 rounded">Join a Visit</a>
    </section>

    <div class="flex">
        <!-- Visitor Check-In -->
        <section class="bg-white shadow-lg rounded-lg p-6 mb-12 w-1/2 mr-4">
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
        <h3 class="text-2xl font-bold text-primary mb-4">Visitor Check-In</h3>
        <button onclick="document.getElementById('auth-modal').classList.remove('hidden')" class="bg-primary text-white px-4 py-2 rounded hover:bg-primary-dark">
            Log-In
        </button>
        <button onclick="document.getElementById('auth-modal').classList.remove('hidden')" class="bg-secondary text-white px-4 py-2 rounded hover:bg-secondary-dark ml-4">
            Sign-Up
        </button>
        @if(session('visit_number'))
            <a href="{{ route('visit.status', ['visit' => session('visit_number')]) }}" class="bg-secondary text-white px-4 py-2 rounded hover:bg-secondary-dark ml-4">
                Visit Status
            </a>
        @else
            <span class="text-gray-500">Visit Status not available</span>
        @endif
        </section>

        <!-- Visit Status -->
        <section class="bg-white shadow-lg rounded-lg p-6 mb-12 w-1/2 ml-4">
            <h3 class="text-2xl font-bold text-primary mb-4">Visit Status</h3>
            <form action="{{ route('visit.status', ['visit' => '']) }}" method="GET" onsubmit="if(!this.visit.value) { alert('Please enter a visit number.'); return false; } this.action='{{ route('visit.status', ['visit' => '']) }}' + '/' + this.visit.value;">
                <div class="mb-4">
                    <input type="text" name="visit" class="w-full px-3 py-2 border rounded-lg" placeholder="Enter Visit Number" required>
                </div>
                <button type="submit" class="bg-primary text-white px-4 py-2 rounded hover:bg-primary-dark">
                    Check Status
                </button>
            </form>
            <button type="button" class="bg-secondary text-white px-4 py-2 rounded hover:bg-secondary-dark mt-4">
                Submit Feedback
            </button>
        </section>
    </div>

    <!-- Instructions Section -->
    <section class="bg-white shadow-lg rounded-lg p-6">
        <h3 class="text-2xl font-bold text-primary mb-4">How to Use VisiTrack</h3>
        <p class="mb-4">Follow these steps to book a visit, join a booked visit, and check-in:</p>
        <ul class="list-disc pl-5 mb-4">
            <li>Book a visit through the "Book a Visit" button.</li>
            <li>Join a booked visit using the "Join a Visit" button.</li>
            <li>Check-in on the day of your visit using the "Visitor Check-In" section.</li>
        </ul>
        <p>For any feedback, please use the "Submit Feedback" button above.</p>
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
