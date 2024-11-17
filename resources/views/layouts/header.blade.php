    <!-- layouts/header.blade.php -->
    <!-- Header Section with Sticky Navigation -->
    <header>
       

    <nav class="sticky-nav">
    <ul>
        <!-- Home Link (always visible) -->
        <li><a href="{{ url('/') }}">Home</a></li>

        <!-- Navigation for authenticated users -->
        @auth
            <!-- Check if the user is an Admin -->
            @if(auth()->user()->hasRole('Admin'))
                <li><a href="{{ route('users.index') }}">Manage Users</a></li>
                <li><a href="{{ route('roles.index') }}">Manage Roles</a></li>
                <li><a href="{{ route('permissions.index') }}">Manage Permissions</a></li>
                <li><a href="{{ route('audit.logs') }}">Log</a></li>
                
            @endif
            @endauth
           <!-- About, Services, Contact (visible only on home route) -->
        @if(Route::is('home'))

        @auth
        @if(auth()->user()->hasPermissionTo('view-about') || auth()->user()->hasRole('User'))
            <li><a href="#about">About Us</a></li>
        @endif
        @endauth
       
        @auth
        @if(auth()->user()->hasPermissionTo('view-cotactform') || auth()->user()->hasRole('User'))
            <li><a href="#contact">Contact Us</a></li>
        @endif
        @endauth
        @auth
        @if(auth()->user()->hasPermissionTo('view-service') || auth()->user()->hasRole('User'))
            <li><a href="#services">Services Us</a></li>
        @endif
        @endauth
        @endif

         <!-- Navigation for guests (not authenticated users) -->
         @guest
            <li><a href="{{ route('login') }}" class="cta-button">Login</a></li>
        @endguest

         <!-- Logout Link for Admin and User roles -->

         @auth
         @if(auth()->user()->hasAnyRole(['Admin', 'User']))
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endif
        @endauth
    </ul>
</nav>


    </header>