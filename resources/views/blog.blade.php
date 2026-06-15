@extends('layouts.app')

@section('title', 'Blog')

@section('content')
    <section id="page-header" class="blog-header">
        <h2>#readmore</h2>
        <p>Read all case studies about our products!</p>
    </section>
    
    <section id="blog">
        <div class="blog-box">
            <div class="blog-img">
                <img src="{{ asset('img/blog/b1.jpg') }}" alt="">
            </div>
            <div class="blog-details">
                <h4>The Cotton-Jersey Zip-Up Hoodie</h4>
                <p>Kickstarter man braid godard coloring book. Raclette waistcoat selfies 
                yr wolf chartreuse hexagon irony, godard...</p>
                <a href="#">CONTINUE READING</a>
            </div>
            <h1>13/01</h1>
        </div>

        <div class="blog-box">
            <div class="blog-img">
                <img src="{{ asset('img/blog/b2.jpg') }}" alt="">
            </div>
            <div class="blog-details">
                <h4>How to Style a Quiff</h4>
                <p>Kickstarter man braid godard coloring book. Raclette waistcoat selfies 
                yr wolf chartreuse hexagon irony, godard...</p>
                <a href="#">CONTINUE READING</a>
            </div>
            <h1>13/01</h1>
        </div>

        <div class="blog-box">
            <div class="blog-img">
                <img src="{{ asset('img/blog/b3.jpg') }}" alt="">
            </div>
            <div class="blog-details">
                <h4>Must-have Skater Girl Items</h4>
                <p>Kickstarter man braid godard coloring book. Raclette waistcoat selfies 
                yr wolf chartreuse hexagon irony, godard...</p>
                <a href="#">CONTINUE READING</a>
            </div>
            <h1>13/01</h1>
        </div>

        <div class="blog-box">
            <div class="blog-img">
                <img src="{{ asset('img/blog/b4.jpg') }}" alt="">
            </div>
            <div class="blog-details">
                <h4>Runway-Inspired Trends</h4>
                <p>Kickstarter man braid godard coloring book. Raclette waistcoat selfies 
                yr wolf chartreuse hexagon irony, godard...</p>
                <a href="#">CONTINUE READING</a>
            </div>
            <h1>13/01</h1>
        </div>

        <div class="blog-box">
            <div class="blog-img">
                <img src="{{ asset('img/blog/b5.jpg') }}" alt="">
            </div>
            <div class="blog-details">
                <h4>AW20 Menswear Trends</h4>
                <p>Kickstarter man braid godard coloring book. Raclette waistcoat selfies 
                yr wolf chartreuse hexagon irony, godard...</p>
                <a href="#">CONTINUE READING</a>
            </div>
            <h1>13/01</h1>
        </div>
    </section>

    <section id="pagination" class="section-p1">
        <a href="#">1</a>
        <a href="#">2</a>
        <a href="#"><i class="fal fa-long-arrow-alt-right"></i></a>
    </section>
@endsection
