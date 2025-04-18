@extends('layouts.app')
@include('website::layouts.parts.seo', [
    'seo' => \App\Models\SEO::where('type','home')->first(),
    "title" => app('settings')->get('title'),
    "image" => secure_url('/') . '/website/images/fav.jpg'
])
@section('content')
    <div class="container">
        <h1>404</h1>
        <h2>Page Not Found</h2>
        <h5>Sorry, the page you are looking for does not exist.</h5>
        <a href="{{route('home')}}" class="main-btn">Back to Home</a>
    </div>
@endsection