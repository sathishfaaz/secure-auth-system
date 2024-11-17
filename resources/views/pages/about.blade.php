@extends('layouts.app')

@section('content')
    <h1>About us</h1>
   
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
    
    <a href="{{ url('/')  }}">Back to Home</a>
@endsection
