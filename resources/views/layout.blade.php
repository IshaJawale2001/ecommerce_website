<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            transition: transform 0.3s ease-in-out;
        }
        .sidebar-hidden {
            transform: translateX(-100%);
        }
        .content {
            transition: margin-left 0.3s ease-in-out;
        }
        @media (max-width: 640px) {
            .sidebar {
                position: fixed;
                z-index: 50;
            }
            .content {
                margin-left: 0 !important;
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar fixed left-0 top-0 h-full w-64 bg-gradient-to-b from-gray-800 to-gray-900 text-white shadow-lg sm:translate-x-0">
        <div class="flex items-center justify-center h-16 border-b border-gray-700">
            <h3 class="text-xl font-bold">Admin Panel</h3>
        </div>
        <nav class="mt-4">
            <a href="{{ route('products.index') }}" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                <i class="fas fa-box mr-3"></i> Products
            </a>
            <!-- Placeholder for future links -->
            <a href="{{ route('admin.cart.index') }}" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                <i class="fas fa-shopping-cart mr-3"></i> Cart
            </a>
            <a href="{{ route('admin.orders.index') }}" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                <i class="fas fa-receipt mr-3"></i> Orders
            </a>
            <a href="{{ route('admin.checkout') }}" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition duration-200">
                <i class="fas fa-credit-card mr-3"></i> Checkout
            </a>
            <a href="{{ route('admin.logout') }}" class="flex items-center px-4 py-3 text-red-400 hover:bg-red-100 hover:text-red-700 transition duration-200">
                <i class="fas fa-sign-out-alt mr-3"></i> Logout
            </a>

        </nav>
    </div>

    <!-- Hamburger Menu for Mobile -->
    <div class="sm:hidden fixed top-0 left-0 w-full bg-gray-800 text-white p-4 flex justify-between items-center z-40">
        <h3 class="text-lg font-bold">Admin Panel</h3>
        <div class="flex items-center gap-4">
            <a href="{{ route('products.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-200 text-sm">
                <i class="fas fa-plus-circle mr-2"></i> Add Product
            </a>
            <button id="menu-toggle" class="text-white focus:outline-none" aria-label="Toggle Sidebar">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </div>

    <!-- Main Content -->
    <div id="content" class="content sm:ml-64 p-6 mt-16 sm:mt-0 min-h-screen">
        <div class="hidden sm:flex justify-end mb-6">
            <a href="{{ route('products.create') }}" class="bg-green-600 text-white px-6 py-3 rounded-md hover:bg-green-700 transition duration-200">
                <i class="fas fa-plus-circle mr-2"></i> Add Product
            </a>
        </div>
        @yield('content')
    </div>

    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-hidden');
            content.classList.toggle('ml-0');
            content.classList.toggle('ml-64');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (window.innerWidth < 640 && !sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                sidebar.classList.add('sidebar-hidden');
                content.classList.remove('ml-64');
                content.classList.add('ml-0');
            }
        });
    </script>
</body>
</html>
