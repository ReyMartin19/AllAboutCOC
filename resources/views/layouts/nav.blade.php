<nav class="fixed top-0 z-50 w-full bg-black/80 backdrop-blur-sm border-b border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex items-center justify-between">
        <!-- Logo - Left (flex-1 for equal width) -->
        <div class="flex-1">
            <a class="w-15 h-12 flex items-center" href="/">
                <img src="{{ asset('images/TH/Icons/Logo_White.svg') }}" alt="Logo">
            </a>
        </div>
        
        <!-- Search - Center (flex-1 for equal width) -->
        <div class="flex-1 flex justify-center">
            <form class="w-full flex justify-center" action="{{ route('search') }}" method="POST">
                @csrf
                <div class="bg-gray-900/50 backdrop-blur-sm rounded-full border border-blue-500/30 p-2 hover:border-blue-500/60 transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/20">
                    <input 
                        type="text" 
                        name="tag"
                        placeholder="#88JY8P2"
                        autocomplete="off"
                        class="w-64 px-4 py-0.5 bg-transparent text-white text-center placeholder-gray-400 font-medium focus:outline-none" 
                        required
                    >
                </div>
            </form>
        </div>
        
        <!-- Links - Right (flex-1 for equal width) -->
        <div class="flex-1 flex justify-end items-center gap-6 sm:gap-8">
            <a href="{{route('rankings')}}" class="text-white hover:text-blue-400 transition-colors duration-200">Rankings</a>
            <a href="#" class="text-white hover:text-blue-400 transition-colors duration-200">Contact</a>
        </div>
    </div>
</nav>