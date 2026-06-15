@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
    <section id="page-header" class="about-header">
        <h2>#let's_talk</h2>
        <p>LEAVE A MESSAGE, We love to hear from you</p>
    </section>

    <section id="contact-details" class="section-p1">
        <div class="details">
            <span>GET IN TOUCH</span>
            <h2>Visit one of our agency locations or contact us today</h2>
            <h3>Head Office</h3>
            <div>
                <li>
                    <i class="fal fa-map"></i>
                    <p>56 Glassford Street Glasgow G1 1UL New York</p>
                </li>
                <li>
                    <i class="far fa-envelope"></i>
                    <p>contact@example.com</p>
                </li>
                <li>
                    <i class="fas fa-phone-alt"></i>
                    <p>contact@example.com</p>
                </li>
                <li>
                    <i class="far fa-clock"></i>
                    <p>Monday to Saturday: 9.00am to 16.pm</p>
                </li>
            </div>
        </div>
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3319.0470071026075!2d73.04721697441475!3d33.707732535845224!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38dfbfb0f4f77379%3A0xf8c50b8651f56d02!2sCentaurus%20Mall!5e0!3m2!1sen!2s!4v1778907600686!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
      
    <section id="form-details">
        <form action="{{ url('/contact') }}" method="POST">
            @csrf
            <span>LEAVE A MESSAGE</span>
            <h2>We love to hear from you</h2>
            @if(session('success'))
                <div style="color: green; margin-bottom: 10px;">{{ session('success') }}</div>
            @endif
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="text" name="subject" placeholder="Subject">
            <textarea name="message" id="" cols="30" rows="10" placeholder="Your Message" required></textarea>
            <button class="normal" type="submit">Submit</button>
        </form>
        <div class="people">
            <div>
                <img src="{{ asset('img/people/1.png') }}" alt="">
                <p><span>John Doe</span> Senior Marketing Manager <br> Phone: + 000 123 000 77 88 <br> Email: contact@example.com</p>
            </div>
            <div>
                <img src="{{ asset('img/people/2.png') }}" alt="">
                <p><span>William Smith</span> Senior Marketing Manager <br> Phone: + 000 123 000 77 88 <br> Email: contact@example.com</p>
            </div>
            <div>
                <img src="{{ asset('img/people/3.png') }}" alt="">
                <p><span>Emma Stone</span> Senior Marketing Manager <br> Phone: + 000 123 000 77 88 <br> Email: contact@example.com</p>
            </div>
        </div>
    </section>
@endsection
