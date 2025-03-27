<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VisiTrack | Alupe University</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        body {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            transition: background-image 1s ease-in-out; /* Smooth transition */
        }
        .fixed-height-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .fixed-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 10;
        }

        .scrollable-content {
            flex-grow: 1;
            overflow-y: auto;
            padding-top: 6rem; /* Adjust for header height */
            padding-bottom: 4rem; /* Adjust for footer height */
        }

        .fixed-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 10;
        }
        /* New styles for list centering */
        .centered-list {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            list-style-position: inside; /* Center the bullets */
            padding-left: 0; /* Remove default padding */
        }

        .centered-list li {
            text-align: center; /* Center the text within list items */
            margin-bottom: 0.5rem; /* Add some spacing between list items */
        }
        .centered-list li::marker {
            text-align: center;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal fixed-height-container">

    <div class="relative min-h-screen">

        <!-- Header (Fixed) -->
        <header class="fixed-header bg-primary text-white py-4">
            <div class="container mx-auto flex items-center justify-between">
                <h1 class="text-2xl font-bold">VisiTrack</h1>
                <img src="{{ asset('images/image.png') }}" alt="Alupe University Logo" class="h-12">
            </div>
        </header>

        <!-- Main Content (Scrollable) -->
        <main class="scrollable-content">
            <div class="container mx-auto px-4">

                <!-- Success Message Display -->
                @if(session('success'))
                    <div class="alert alert-success bg-green-500 text-white p-4 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Homepage Overview -->

                <section class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-primary">Welcome to VisiTrack</h2>
                    <p class="mt-4 text-white">An efficient digital visitor management system for Alupe University.</p>
                </section>

                <!-- Action Buttons -->
                <section class="text-center mb-12">
                    <a href="{{ route('book.visit') }}" class="bg-primary text-white px-6 py-3 rounded mr-4">Book a Visit</a>
                    <a href="{{ route('join.visit') }}" class="bg-secondary text-white px-6 py-3 rounded">Join a Visit</a>
                </section>

                <!-- Check-In and Check Status Buttons -->
                <section class="text-center mb-12">
                    <button onclick="showCheckInModal()" class="bg-primary text-white px-6 py-3 rounded mr-4">Check-In</button>
                    <button onclick="document.getElementById('visit-number-modal').classList.remove('hidden')" class="bg-secondary text-white px-6 py-3 rounded">Check Status</button>
                </section>

                <!-- Instructions Section -->
                <section class="bg-white shadow-lg rounded-lg p-6 mb-8">
                    <h3 class="text-2xl font-bold text-primary mb-4 text-center">How it <span style='color: #ffcc00; font-weight: bold;'>Works</span></h3>
                    <div class="text-center overflow-hidden">
                        <p class="mb-4 sliding-text">Follow these steps to book a visit, join a booked visit, check your visit status and check-in:</p>
                        <ul class="mb-4 horizontal-list">
                            <li class="sliding-text">
                                <div class="instruction-item">
                                    <span class="font-bold">Book a Visit</span><br>
                                    <p>Book a visit through the "Book a Visit" button to generate a Visit Number.</p>
                                </div>
                            </li>
                            <li class="sliding-text">
                                <div class="instruction-item">
                                    <span class="font-bold">Join a Visit</span><br>
                                    <p>Join a booked visit using the "Join a Visit" button. Use your shared Visit Number.</p>
                                </div>
                            </li>
                            <li class="sliding-text">
                                <div class="instruction-item">
                                    <span class="font-bold">Check-In</span><br>
                                    <p>Check-in on the day of your visit using the "Check-In" button. Provide your Visit Number.</p>
                                </div>
                            </li>
                            <li class="sliding-text">
                                <div class="instruction-item">
                                    <span class="font-bold">Check Status</span><br>
                                    <p>Check your visit status using the "Check Status" button. Input your Visit Number.</p>
                                </div>
                            </li>
                        </ul>
                        <div class="flex flex-col items-center">
                            <p class="sliding-text mb-4">For any feedback, please use the button below.</p>
                            <button onclick="document.getElementById('feedback-modal').classList.remove('hidden')" class="sliding-text bg-secondary text-white px-6 py-3 rounded">Submit Feedback</button>
                        </div>
                    </div>
                </section>


                <!-- Feedback Modal -->
                <div id="feedback-modal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 hidden">
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                        <h2 class="text-xl font-bold text-primary">Submit Feedback</h2>
                        <form id="feedback-form" action="{{ route('feedback.submit') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <input type="text" name="name" class="w-full px-3 py-2 border rounded-lg" placeholder="Your Name" required>
                            </div>
                            <div class="mb-4">
                                <input type="email" name="email" class="w-full px-3 py-2 border rounded-lg" placeholder="Your Email" required>
                            </div>
                            <div class="mb-4">
                                <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">Rating (1-5 stars):</label>
                                <select name="rating" id="rating" class="w-full px-3 py-2 border rounded-lg" required>
                                    <option value="">Select Rating</option>
                                    <option value="1">1 star</option>
                                    <option value="2">2 stars</option>
                                    <option value="3">3 stars</option>
                                    <option value="4">4 stars</option>
                                    <option value="5">5 stars</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <textarea name="feedback" class="w-full px-3 py-2 border rounded-lg" placeholder="Enter your feedback here..." rows="5" required></textarea>
                            </div>
                            <button type="submit" class="bg-primary text-white px-4 py-2 rounded hover:bg-primary-dark">Submit</button>
                            <button type="button" onclick="document.getElementById('feedback-modal').classList.add('hidden')" class="mt-4 bg-gray-300 text-black px-4 py-2 rounded">Close</button>
                        </form>
                    </div>
                </div>

                <!-- Check-In Modal -->
                <div id="checkin-modal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 hidden">
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                        <h2 class="text-xl font-bold text-primary">Check-In Options</h2>
                        <script>
                            function showAuthModal() {
                                document.getElementById('auth-modal').classList.remove('hidden');
                            }
                        </script>
                        <button onclick="showAuthModal()" class="bg-primary text-white px-4 py-2 rounded hover:bg-primary-dark">Log In</button>
                        <button onclick="document.getElementById('signup-modal').classList.remove('hidden')" class="bg-secondary text-white px-4 py-2 rounded hover:bg-secondary-dark mt-4">Sign Up</button>
                        <button onclick="document.getElementById('checkin-modal').classList.add('hidden')" class="mt-4 bg-gray-300 text-black px-4 py-2 rounded">Close</button>
                    </div>
                </div>

                <!-- Sign-Up Modal -->
                <div id="signup-modal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 hidden">
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                        <h2 class="text-xl font-bold text-primary">Sign Up</h2>
                        <form id="signup-form" action="{{ route('security.signup.submit') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <input type="text" id="name" name="name" class="w-full px-3 py-2 border rounded-lg" placeholder="Username" required>
                                @error('username')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-lg" placeholder="Email" required>
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <input type="password" id="signup-password" name="password" class="w-full px-3 py-2 border rounded-lg" placeholder="Create Password" required>
                                @error('password')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <input type="password" id="signup-password-confirm" name="password_confirmation" class="w-full px-3 py-2 border rounded-lg" placeholder="Confirm Password" required>
                                @error('password_confirmation')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="bg-primary text-white px-4 py-2 rounded hover:bg-primary-dark">Sign Up</button>
                            <button type="button" onclick="document.getElementById('signup-modal').classList.add('hidden')" class="mt-4 bg-gray-300 text-black px-4 py-2 rounded">Close</button>
                        </form>

                        <script>
                            document.getElementById('signup-form').addEventListener('submit', function(event) {
                                const username = document.getElementById('name').value.trim();

                                const email = document.getElementById('email').value.trim();
                                const password = document.getElementById('signup-password').value.trim();
                                const confirmPassword = document.getElementById('signup-password-confirm').value.trim();

                                if (!username || !email || !password || !confirmPassword) {
                                    alert('All fields are required and cannot contain only whitespace.');
                                    event.preventDefault();
                                } else if (password !== confirmPassword) {
                                    alert('Passwords do not match.');
                                    event.preventDefault();
                                }
                            });
                        </script>
                    </div>
                </div>

                <!-- Login Modal -->
                <div id="auth-modal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 hidden">
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                        <h2 class="text-xl font-bold text-primary">Log In</h2>
                        <form action="{{ route('security.login') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <input type="email" name="email" class="w-full px-3 py-2 border rounded-lg" placeholder="Email" required>
                            </div>
                            <div class="mb-4">
                                <input type="password" id="login-password" name="password" class="w-full px-3 py-2 border rounded-lg" placeholder="Password" required>
                            </div>
                            <button type="submit" class="bg-primary text-white px-4 py-2 rounded hover:bg-primary-dark">Log In</button>
                            <button onclick="document.getElementById('auth-modal').classList.add('hidden')" class="mt-4 bg-gray-300 text-black px-4 py-2 rounded">Close</button>
                        </form>
                    </div>
                </div>

                <!-- Visit Number Modal -->
                <div id="visit-number-modal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 hidden">
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                        <h2 class="text-xl font-bold text-primary">Enter Visit Number</h2>
                        <form id="visit-status-form" method="GET" action="{{ route('visits.status') }}">
                            <div class="mb-4">
                                <input type="text" name="visit" id="visit-number" class="w-full px-3 py-2 border rounded-lg" placeholder="Visit Number" required>
                            </div>
                            <button type="submit" class="bg-primary text-white px-4 py-2 rounded hover:bg-primary-dark">Submit</button>
                            <button type="button" onclick="document.getElementById('visit-number-modal').classList.add('hidden')" class="mt-4 bg-gray-300 text-black px-4 py-2 rounded">Close</button>
                        </form>
                    </div>
                </div>

            </div>
        </main>

        <!-- Footer (Fixed) -->
        <footer class="fixed-footer bg-primary text-white py-4">
            <div class="container mx-auto text-center">
                <p>&copy; 2025 Alupe University. All rights reserved.</p>
            </div>
        </footer>

    </div>

    <script>
        // Check if there's a success message in the session
        window.onload = function() {
            @if(session('success'))
                document.getElementById('success-message').classList.remove('hidden');
                document.getElementById('success-text').innerHTML = "{!! session('success') !!}";
            @endif
        };
        function showCheckInModal() {
            document.getElementById('checkin-modal').classList.remove('hidden');
        }

        function showAuthModal() {
            document.getElementById('auth-modal').classList.remove('hidden');
        }

        function togglePasswordVisibility(passwordFieldId, toggleButtonId) {
            const passwordField = document.getElementById(passwordFieldId);
            const toggleButton = document.getElementById(toggleButtonId);
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleButton.textContent = "Hide";
            } else {
                passwordField.type = "password";
                toggleButton.textContent = "Show";
            }
        }
        const images = [
            '{{ asset("images/bolivia2.jpg") }}',
            '{{ asset("images/nai3.jpg") }}',
            '{{ asset("images/nai2.jpg") }}',
            '{{ asset("images/nai.jpg") }}',
            '{{ asset("images/MV3.jpg") }}',
            '{{ asset("images/Alupe Lib.jpeg") }}',
        ];
        let currentImageIndex = 0;

        function changeBackgroundImage() {
            if (images.length > 0) {
                document.body.style.backgroundImage = `url(${images[currentImageIndex]})`;
                currentImageIndex = (currentImageIndex + 1) % images.length;
            } else {
                console.error("No images available for the background slideshow.");
            }
        }

        setInterval(changeBackgroundImage, 5000); // Change image every 5 seconds
    </script>
    <style>
        .horizontal-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            list-style: none;
            padding: 0;
        }

        .horizontal-list li {
            margin: 10px;
            text-align: center;
            flex: 1 0 200px;
            max-width: 300px;
        }
        .instruction-item{
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }

        .sliding-text {
            opacity: 0;
            transform: translateX(-100%);
            animation: slideIn 1s ease-out forwards;
            margin-bottom: 0.5rem;
        }

        .sliding-text:nth-child(1) {
            animation-delay: 0.2s;
        }

        .sliding-text:nth-child(2) {
            animation-delay: 0.4s;
        }

        .sliding-text:nth-child(3) {
            animation-delay: 0.6s;
        }
        .sliding-text:nth-child(4) {
            animation-delay: 0.8s;
        }
        .sliding-text:nth-child(5) {
            animation-delay: 1s;
        }
        .sliding-text:nth-child(6) {
            animation-delay: 1.2s;
        }

        @keyframes slideIn {
            0% {
                opacity: 0;
                transform: translateX(-100%);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }
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
        .action-button {
            display: inline-block;
            padding: 1rem 2rem;
            margin: 0.5rem;
            border-radius: 0.5rem;
            text-decoration: none;
            text-align: center;
            font-weight: bold;
        }

        .action-button.bg-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .action-button.bg-secondary {
            background-color: var(--secondary-color);
            color: white;
        }

        .action-button:hover {
            opacity: 0.8;
        }
    </style>
</body>
</html>
