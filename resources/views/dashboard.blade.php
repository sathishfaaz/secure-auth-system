@extends('layouts.app')

@section('content')
    <!-- Dashboard Navigation (for logged-in users only) -->
    

    <!-- Main Content Based on Role -->
    @auth
        @role('Admin')
            <section  class="section" style="background-image: url('https://images.pexels.com/photos/3740742/pexels-photo-3740742.jpeg'); background-size: cover; background-position: center; padding: 50px;">
    
                <h2>Welcome Admin</h2>
                <p>As an Admin, you can manage roles, permissions, and user data.</p>
               
            </section>
        @endrole

        @role('user')
            <section class="section">
                <h2>Welcome User</h2>
                <p>You have access to your profile and limited features.</p>
                <a href="{{ route('user.profile') }}" class="cta-button">View Your Profile</a>
            </section>
        @endrole

        @role('guest')
            <section class="section">
                <h2>Welcome Guest</h2>
                <p>As a guest, you have limited access. Sign up to unlock more features.</p>
            </section>
        @endrole
    @endauth

    <!-- If not authenticated, show guest content -->
    @guest
        <section class="section">
            <h2>Guest Dashboard</h2>
            <p>You are currently browsing as a guest. Please <a href="{{ route('login') }}">Login</a> to access more features.</p>
        </section>
    @endguest
@endsection
