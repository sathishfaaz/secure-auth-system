<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Welcome, your trusted partner for innovative solutions.">
    <title>Welcome </title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <!-- Header Section -->

      <!-- Include the header from the layouts directory -->
      @include('layouts.header')
    <header>
        <nav>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                @auth
                @role('Admin')
                <li>  <a href="{{ route('users.index') }}">Manage Users</a></li>
                <li> <a href="{{ route('roles.index') }}">Manage Roles</a></li>
                <li><a href="{{ route('permissions.index') }}">Manage Permissions</a></li>
                 @endrole
                   
                @endauth
                <li><a href="#about">About Us</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#contact">Contact</a></li>
                @role('guest')
                <a href="{{ route('login') }}" class="cta-button">Login</a>
                @endrole
               
            </ul>
        </nav>
    </header>
    

    <!-- Main Hero Section -->
    <section id="hero" style="background-image: url('{{ asset('images/hero-image.jpg') }}');">
        <div class="hero-content">
            <h1>Welcome </h1>
            <p>Your trusted partner for innovative solutions in the industry.</p>
            <a href="#contact" class="cta-button">Get in Touch</a>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="section">
        <h2>About Us</h2>
        <p>{{ $companyDescription }}</p>
        <p>We are a team of experts committed to delivering innovative strategies and solutions to help your business succeed. With over 20 years of experience, we work with companies of all sizes to unlock their potential.</p>
    </section>

    <!-- Services Section -->
    <section id="services" class="section">
        <h2>Our Services</h2>
        <div class="service">
            <h3>Consulting</h3>
            <p>Our expert consultants work with you to create data-driven strategies that improve your business outcomes.</p>
        </div>
        <div class="service">
            <h3>Software Solutions</h3>
            <p>We offer custom software development services designed to streamline your operations and boost efficiency.</p>
        </div>
        <div class="service">
            <h3>Customer Support</h3>
            <p>Our dedicated customer support team ensures that you're never alone, offering guidance and assistance whenever needed.</p>
        </div>
    </section>

    <!-- Role-based Content -->

    @if(auth()->check())
        @role('admin')
            <section class="section">
                <h2>Admin Section</h2>
                <p>Welcome, Admin! You have full access to manage the system.</p>
                <a href="{{ route('admin.dashboard') }}" class="cta-button">Go to Admin Dashboard</a>
            </section>
        @endrole

        @role('user')
            <section class="section">
                <h2>User Section</h2>
                <p>Welcome, User! You have access to limited features.</p>
                <a href="{{ route('user.dashboard') }}" class="cta-button">Go to User Dashboard</a>
            </section>
        @endrole

        @role('guest')
            <section class="section">
                <h2>Guest Section</h2>
                <p>Welcome, Guest! You have read-only access to the website.</p>
            </section>
        @endrole
    @else
        <section class="section">
            <h2>Guest Section</h2>
            <p>Welcome! Please sign up or log in to get more features.</p>
            <a href="{{ route('login') }}" class="cta-button">Login</a>
        </section>
    @endif

    <!-- Contact Section -->
    <section id="contact" class="section">
        <h2>Contact Us</h2>
        <p>We'd love to hear from you! Whether you have a question or are interested in our services, feel free to reach out.</p>
        <form action="#" method="POST">
            @csrf
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Your Email</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Your Message</label>
            <textarea id="message" name="message" rows="4" required></textarea>

            <button type="submit" class="cta-button">Send Message</button>
        </form>
    </section>

    <!-- Footer Section -->
    <footer>
        <p>&copy; {{ date('Y') }} Our Company. All rights reserved.</p>
        <ul>
            <li><a href="https://facebook.com/ourcompany">Facebook</a></li>
            <li><a href="https://twitter.com/ourcompany">Twitter</a></li>
            <li><a href="https://linkedin.com/company/ourcompany">LinkedIn</a></li>
        </ul>
    </footer>
</body>
</html>
