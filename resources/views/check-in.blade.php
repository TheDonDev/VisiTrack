@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Visitor Check-In</h1>
    
    <form action="{{ route('visits.check-in') }}" method="POST" class="max-w-md">
        @csrf
        <div class="mb-4">
            <label for="visit_number" class="block text-gray-700 mb-2">Visit Number:</label>
            <input type="text" name="visit_number" id="visit_number" 
                   class="w-full px-3 py-2 border rounded-lg" required>
        </div>
        
        <button type="submit" 
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Check In
        </button>
    </form>
</div>
@endsection
