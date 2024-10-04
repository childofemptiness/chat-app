@extends('layouts.app')

@section('content')
    
    @if (!$chatExists)
        
        <div class="bg-gray-1000 p-8 rounded-lg shadow-lg text-center">
        
            <h1 class="text-3xl font-bold mb-6 text-white">Ошибка</h1>
            
            <p class="text-gray-300">Такого чата не существует.</p>
        
        </div>
    
    @else
        
        <div id="chat">
            <!-- Ваш код чата здесь -->
        </div>
   
    @endif

@endsection

@section('scripts')
    
    <script src="/resources/js/components/Chat.jsx"></script>

@endsection
