@extends('layouts.app')

@section('content')



    <!-- Main Hero Section -->
    <section id="hero" style="background-image: url('{{ asset('images/admin-img.jpg') }}');">
        <div class="hero-content">
            <h1>Welcome </h1>
            <p>Your trusted partner for innovative solutions in the industry.</p>
         

            <!-- Display Button for Guests -->
        @guest
        <a href="#contact" class="cta-button">Get in Touch</a>
        @endguest

        <!-- Display Button for Authenticated Users (Non-Admins) -->
        @auth
            @if(!auth()->user()->hasRole('Admin'))
            <a href="#contact" class="cta-button">Get in Touch</a>
            @endif
        @endauth
       
        </div>
    </section>


    <section id="about" class="section">
        <h2>Commpany Info</h2>
        <p>t is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).We are a team of experts committed to delivering innovative strategies and solutions to help your business succeed. With over 20 years of experience, we work with companies of all sizes to unlock their potential.</p>
    </section>

    @auth
    @if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('User'))
    <!-- About Us Section -->
    <section id="about" class="section">
        <h2>About Us </h2>
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

    @endif
    @endauth

    
   
    
    <!-- Contact Section -->
    <section id="contact" class="section">
    @auth
    @if(auth()->user()->hasPermissionTo('view-cotactform'))
        <h2>Contact Us</h2>
        <p>We'd love to hear from you! Whether you have a question or are interested in our services, feel free to reach out.</p>
        <form action="{{ route('contact.submit') }}" method="POST">
            @csrf
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Your Email</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Your Message</label>
            <textarea id="message" name="message" rows="4" required></textarea>

            <button type="submit" class="cta-button">Send Message</button>
        </form>
        @endif
        @endauth

    @guest
   
    <h2>Contact Us</h2>
        <p>We'd love to hear from you! Whether you have a question or are interested in our services, feel free to reach out.</p>
        <form action="{{ route('contact.submit') }}" method="POST">
            @csrf
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Your Email</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Your Message</label>
            <textarea id="message" name="message" rows="4" required></textarea>

            <button type="submit" class="cta-button">Send Message</button>
        </form>
@endguest
    <!-- Success/Error Message -->
    @if (session('success'))
        <div class="alert alert-success mt-4">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger mt-4">
            {{ session('error') }}
        </div>
    @endif
    </section>
   

@endsection



    