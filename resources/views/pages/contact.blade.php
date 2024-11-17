@extends('layouts.app')

@section('content')
    <h1>Contact Us</h1>
    <!-- Contact Section -->
    <section id="contact" class="section">
        
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
@endsection
    
   

