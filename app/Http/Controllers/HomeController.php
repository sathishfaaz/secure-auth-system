<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        
        $companyDescription = "At Our Company, we are dedicated to providing cutting-edge solutions that help businesses succeed. With over 20 years of experience in the industry, we specialize in innovative strategies, tailored consulting, and premium customer service.";
        
        $testimonials = [
            ['quote' => 'The solutions provided by Our Company have transformed our operations. We couldn’t be more satisfied with their services!', 'author' => 'John Doe, CEO of TechCorp'],
            ['quote' => 'The team at Our Company is truly exceptional. They delivered beyond our expectations and helped us achieve remarkable results.', 'author' => 'Jane Smith, Founder of GreenTech']
        ];

        return view('home', compact('companyDescription', 'testimonials'));
    }

    public function admin()
    {
        return view('admin.dashboard');
    }

    public function user()
    {
        return view('users.index');
    }

    public function guest()
    {
        return view('guest.dashboard');
    }
}
