        <!-- Sidebar -->
        <aside class="hidden lg:block w-64 bg-gray-800 text-gray-300 rounded-lg shadow-md mr-6 h-fit sticky top-6 sidebar overflow-y-auto border border-blue-500/20" style="max-height: calc(100vh - 100px)">
            <div class="p-4">
                <h3 class="font-bold text-lg mb-4 text-white flex items-center">
                    <i class="fas fa-list mr-2 text-blue-400"></i>
                    <span>Thể Loại</span>
                </h3>
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="flex items-center px-3 py-2 rounded hover:bg-gray-700 active-nav-link">
                            <i class="fas fa-home mr-3 text-blue-400"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-3 py-2 rounded hover:bg-gray-700">
                            <i class="fas fa-gamepad mr-3 text-green-400"></i>
                            <span>Phát triển chò chơi</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-3 py-2 rounded hover:bg-gray-700">
                            <i class="fas fa-paint-brush mr-3 text-purple-400"></i>
                            <span>Nghệ thuật & Thiết kế</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-3 py-2 rounded hover:bg-gray-700">
                            <i class="fas fa-code mr-3 text-yellow-400"></i>
                            <span>Lập trình</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-3 py-2 rounded hover:bg-gray-700">
                            <i class="fas fa-music mr-3 text-red-400"></i>
                            <span>Âm thanh & Âm nhạc</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-3 py-2 rounded hover:bg-gray-700">
                            <i class="fas fa-question-circle mr-3 text-indigo-400"></i>
                            <span>Help & Support</span>
                        </a>
                    </li>
                </ul>

                <div class="border-t border-gray-700 my-4"></div>

                <h3 class="font-bold text-lg mb-4 text-white flex items-center">
                    <i class="fas fa-tags mr-2 text-blue-400"></i>
                    <span>Popular Tags</span>
                </h3>
                <div class="flex flex-wrap gap-2">
                    <a href="#" class="px-3 py-1 bg-gray-700 rounded-full text-sm hover:bg-blue-600 transition">#unity</a>
                    <a href="#" class="px-3 py-1 bg-gray-700 rounded-full text-sm hover:bg-green-600 transition">#godot</a>
                    <a href="#" class="px-3 py-1 bg-gray-700 rounded-full text-sm hover:bg-purple-600 transition">#pixelart</a>
                    <a href="#" class="px-3 py-1 bg-gray-700 rounded-full text-sm hover:bg-yellow-600 transition">#indiedev</a>
                    <a href="#" class="px-3 py-1 bg-gray-700 rounded-full text-sm hover:bg-red-600 transition">#gamedesign</a>
                </div>

                <div class="border-t border-gray-700 my-4"></div>

                <div class="bg-gray-700 p-3 rounded-lg border border-blue-500/20">
                    <h4 class="font-semibold text-white mb-2 flex items-center">
                        <i class="fas fa-chart-line mr-2 text-blue-400"></i>
                        <span>Forum Stats</span>
                    </h4>
                    <div class="text-sm space-y-1">
                        <div class="flex justify-between">
                            <span>Chủ đề:</span>
                            <span class="font-bold text-blue-400">1,245</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Bài viết:</span>
                            <span class="font-bold text-green-400">8,752</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Thành viên:</span>
                            <span class="font-bold text-purple-400">3,421</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Trò chơi được chia sẻ:</span>
                            <span class="font-bold text-yellow-400">892</span>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-700 my-4"></div>

                <div class="bg-gradient-to-br from-blue-900/50 to-purple-900/50 p-4 rounded-lg border border-blue-500/30">
                    <h4 class="font-semibold text-white mb-3 text-center">Game nổi bật</h4>
                    <div class="bg-gray-800 rounded-md p-2 mb-3">
                        <img src="{{ asset('storage\tree.png') }} " alt="Featured Game" class="w-full rounded-md mb-2 border border-blue-500/30">
                        <h5 class="text-white text-sm font-bold mb-1">Pixel Adventure</h5>
                        <p class="text-gray-400 text-xs">A retro-style platformer with modern mechanics</p>
                    </div>
                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-full text-sm transition flex items-center justify-center">
                        <i class="fas fa-download mr-2"></i> Download Demo
                    </button>
                </div>
            </div>
        </aside>