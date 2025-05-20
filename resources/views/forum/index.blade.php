@extends('layouts.app')

@section('content')
        <main class="flex-1">
            <!-- Featured Threads -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-white flex items-center">
                        <i class="fas fa-fire mr-3 text-red-500"></i>
                        <span>Hot Topics</span>
                    </h2>
                    <a href="#" class="text-blue-400 hover:text-blue-300 text-sm flex items-center">
                        View All <i class="fas fa-chevron-right ml-1 text-xs"></i>
                    </a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Thread Card 1 -->
                    <div class="bg-gray-800 rounded-lg shadow-md overflow-hidden game-card border border-blue-500/20 hover:border-blue-500/50">
                        <div class="h-40 bg-gradient-to-br from-blue-900/50 to-purple-900/50 flex items-center justify-center">
                            <i class="fas fa-gamepad text-5xl text-blue-400 opacity-70"></i>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs text-blue-400 bg-blue-900/30 px-2 py-1 rounded-full">Unity</span>
                                <div class="flex items-center text-gray-400 text-xs">
                                    <i class="fas fa-comment-alt mr-1"></i> 24
                                    <i class="fas fa-eye ml-3 mr-1"></i> 156
                                </div>
                            </div>
                            <h3 class="text-white font-bold mb-2">Optimizing 2D Physics in Unity</h3>
                            <p class="text-gray-400 text-sm mb-3">Discussion about best practices for 2D physics performance in Unity games...</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-6 h-6 rounded-full bg-blue-500 mr-2"></div>
                                    <span class="text-xs text-gray-300">DevMaster</span>
                                </div>
                                <span class="text-xs text-gray-500">2h ago</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Thread Card 2 -->
                    <div class="bg-gray-800 rounded-lg shadow-md overflow-hidden game-card border border-blue-500/20 hover:border-blue-500/50">
                        <div class="h-40 bg-gradient-to-br from-green-900/50 to-blue-900/50 flex items-center justify-center">
                            <i class="fas fa-paint-brush text-5xl text-green-400 opacity-70"></i>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs text-green-400 bg-green-900/30 px-2 py-1 rounded-full">Art</span>
                                <div class="flex items-center text-gray-400 text-xs">
                                    <i class="fas fa-comment-alt mr-1"></i> 42
                                    <i class="fas fa-eye ml-3 mr-1"></i> 289
                                </div>
                            </div>
                            <h3 class="text-white font-bold mb-2">Pixel Art Animation Techniques</h3>
                            <p class="text-gray-400 text-sm mb-3">Sharing my workflow for creating smooth pixel art animations in Aseprite...</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-6 h-6 rounded-full bg-green-500 mr-2"></div>
                                    <span class="text-xs text-gray-300">PixelArtist</span>
                                </div>
                                <span class="text-xs text-gray-500">5h ago</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Thread Card 3 -->
                    <div class="bg-gray-800 rounded-lg shadow-md overflow-hidden game-card border border-blue-500/20 hover:border-blue-500/50">
                        <div class="h-40 bg-gradient-to-br from-purple-900/50 to-pink-900/50 flex items-center justify-center">
                            <i class="fas fa-code text-5xl text-purple-400 opacity-70"></i>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs text-purple-400 bg-purple-900/30 px-2 py-1 rounded-full">Godot</span>
                                <div class="flex items-center text-gray-400 text-xs">
                                    <i class="fas fa-comment-alt mr-1"></i> 18
                                    <i class="fas fa-eye ml-3 mr-1"></i> 134
                                </div>
                            </div>
                            <h3 class="text-white font-bold mb-2">Godot 4.0 2D Lighting System</h3>
                            <p class="text-gray-400 text-sm mb-3">Tutorial on implementing dynamic 2D lighting in Godot 4.0 for your games...</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-6 h-6 rounded-full bg-purple-500 mr-2"></div>
                                    <span class="text-xs text-gray-300">GodotDev</span>
                                </div>
                                <span class="text-xs text-gray-500">1d ago</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Recent Discussions -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-white flex items-center">
                        <i class="fas fa-comments mr-3 text-blue-500"></i>
                        <span>Recent Discussions</span>
                    </h2>
                    <a href="#" class="text-blue-400 hover:text-blue-300 text-sm flex items-center">
                        View All <i class="fas fa-chevron-right ml-1 text-xs"></i>
                    </a>
                </div>
                
                <div class="bg-gray-800 rounded-lg shadow-md overflow-hidden border border-blue-500/20">
                    <!-- Discussion Item 1 -->
                    <div class="border-b border-gray-700 hover:bg-gray-700/50 transition">
                        <a href="#" class="block p-4">
                            <div class="flex items-start">
                                <div class="w-10 h-10 rounded-full bg-blue-500 mr-4 flex items-center justify-center text-white font-bold">
                                    <span>JD</span>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-1">
                                        <h3 class="text-white font-medium">How to implement tile-based movement?</h3>
                                        <span class="text-xs text-gray-500">3h ago</span>
                                    </div>
                                    <p class="text-gray-400 text-sm mb-2">I'm working on a classic RPG style movement system where the character moves tile by tile. Any suggestions for the best approach in Unity?</p>
                                    <div class="flex items-center text-xs text-gray-500">
                                        <span class="bg-gray-700 px-2 py-1 rounded-full mr-3">#unity</span>
                                        <span class="flex items-center mr-3">
                                            <i class="fas fa-comment-alt mr-1"></i> 12
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-eye mr-1"></i> 87
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <!-- Discussion Item 2 -->
                    <div class="border-b border-gray-700 hover:bg-gray-700/50 transition">
                        <a href="#" class="block p-4">
                            <div class="flex items-start">
                                <div class="w-10 h-10 rounded-full bg-green-500 mr-4 flex items-center justify-center text-white font-bold">
                                    <span>PA</span>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-1">
                                        <h3 class="text-white font-medium">Best free tools for pixel art animation?</h3>
                                        <span class="text-xs text-gray-500">5h ago</span>
                                    </div>
                                    <p class="text-gray-400 text-sm mb-2">Looking for recommendations for free or affordable tools to create pixel art animations for my 2D platformer.</p>
                                    <div class="flex items-center text-xs text-gray-500">
                                        <span class="bg-gray-700 px-2 py-1 rounded-full mr-3">#pixelart</span>
                                        <span class="flex items-center mr-3">
                                            <i class="fas fa-comment-alt mr-1"></i> 23
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-eye mr-1"></i> 145
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <!-- Discussion Item 3 -->
                    <div class="border-b border-gray-700 hover:bg-gray-700/50 transition">
                        <a href="#" class="block p-4">
                            <div class="flex items-start">
                                <div class="w-10 h-10 rounded-full bg-purple-500 mr-4 flex items-center justify-center text-white font-bold">
                                    <span>GD</span>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-1">
                                        <h3 class="text-white font-medium">Godot vs Unity for 2D games in 2023</h3>
                                        <span class="text-xs text-gray-500">1d ago</span>
                                    </div>
                                    <p class="text-gray-400 text-sm mb-2">Debating which engine to use for my next 2D project. Looking for pros/cons from developers who have used both.</p>
                                    <div class="flex items-center text-xs text-gray-500">
                                        <span class="bg-gray-700 px-2 py-1 rounded-full mr-3">#gamedev</span>
                                        <span class="flex items-center mr-3">
                                            <i class="fas fa-comment-alt mr-1"></i> 47
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-eye mr-1"></i> 312
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <!-- Discussion Item 4 -->
                    <div class="hover:bg-gray-700/50 transition">
                        <a href="#" class="block p-4">
                            <div class="flex items-start">
                                <div class="w-10 h-10 rounded-full bg-yellow-500 mr-4 flex items-center justify-center text-white font-bold">
                                    <span>SM</span>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-1">
                                        <h3 class="text-white font-medium">Showcase: My retro-style space shooter</h3>
                                        <span class="text-xs text-gray-500">2d ago</span>
                                    </div>
                                    <p class="text-gray-400 text-sm mb-2">After 6 months of development, I'm ready to share my space shooter inspired by 80s arcade games. Check it out!</p>
                                    <div class="flex items-center text-xs text-gray-500">
                                        <span class="bg-gray-700 px-2 py-1 rounded-full mr-3">#showcase</span>
                                        <span class="flex items-center mr-3">
                                            <i class="fas fa-comment-alt mr-1"></i> 36
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-eye mr-1"></i> 278
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Game Showcase -->
            <div>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-white flex items-center">
                        <i class="fas fa-star mr-3 text-yellow-500"></i>
                        <span>Featured Games</span>
                    </h2>
                    <a href="#" class="text-blue-400 hover:text-blue-300 text-sm flex items-center">
                        View All <i class="fas fa-chevron-right ml-1 text-xs"></i>
                    </a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Game 1 -->
                    <div class="bg-gray-800 rounded-lg overflow-hidden game-card border border-blue-500/20 hover:border-blue-500/50">
                        <div class="h-40 bg-gradient-to-br from-red-900/50 to-orange-900/50 flex items-center justify-center">
                            <i class="fas fa-space-shuttle text-5xl text-red-400 opacity-70"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="text-white font-bold mb-2">Space Raiders</h3>
                            <p class="text-gray-400 text-sm mb-3">Retro arcade shooter with modern twists</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fas fa-user mr-2 text-xs text-gray-400"></i>
                                    <span class="text-xs text-gray-300">AstroDev</span>
                                </div>
                                <div class="flex items-center text-yellow-400 text-xs">
                                    <i class="fas fa-star"></i>
                                    <span class="ml-1">4.8</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Game 2 -->
                    <div class="bg-gray-800 rounded-lg overflow-hidden game-card border border-blue-500/20 hover:border-blue-500/50">
                        <div class="h-40 bg-gradient-to-br from-green-900/50 to-teal-900/50 flex items-center justify-center">
                            <i class="fas fa-dungeon text-5xl text-green-400 opacity-70"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="text-white font-bold mb-2">Dungeon Crawler</h3>
                            <p class="text-gray-400 text-sm mb-3">Roguelike with procedural generation</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fas fa-user mr-2 text-xs text-gray-400"></i>
                                    <span class="text-xs text-gray-300">RogueDev</span>
                                </div>
                                <div class="flex items-center text-yellow-400 text-xs">
                                    <i class="fas fa-star"></i>
                                    <span class="ml-1">4.6</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Game 3 -->
                    <div class="bg-gray-800 rounded-lg overflow-hidden game-card border border-blue-500/20 hover:border-blue-500/50">
                        <div class="h-40 bg-gradient-to-br from-purple-900/50 to-pink-900/50 flex items-center justify-center">
                            <i class="fas fa-ghost text-5xl text-purple-400 opacity-70"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="text-white font-bold mb-2">Ghost Hunter</h3>
                            <p class="text-gray-400 text-sm mb-3">Puzzle platformer with stealth elements</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fas fa-user mr-2 text-xs text-gray-400"></i>
                                    <span class="text-xs text-gray-300">SpookyDev</span>
                                </div>
                                <div class="flex items-center text-yellow-400 text-xs">
                                    <i class="fas fa-star"></i>
                                    <span class="ml-1">4.9</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Game 4 -->
                    <div class="bg-gray-800 rounded-lg overflow-hidden game-card border border-blue-500/20 hover:border-blue-500/50">
                        <div class="h-40 bg-gradient-to-br from-yellow-900/50 to-orange-900/50 flex items-center justify-center">
                            <i class="fas fa-coins text-5xl text-yellow-400 opacity-70"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="text-white font-bold mb-2">Coin Quest</h3>
                            <p class="text-gray-400 text-sm mb-3">Fast-paced platformer with collectibles</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fas fa-user mr-2 text-xs text-gray-400"></i>
                                    <span class="text-xs text-gray-300">JumpDev</span>
                                </div>
                                <div class="flex items-center text-yellow-400 text-xs">
                                    <i class="fas fa-star"></i>
                                    <span class="ml-1">4.7</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
@endsection
