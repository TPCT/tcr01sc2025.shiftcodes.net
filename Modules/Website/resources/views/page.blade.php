@extends('website::layouts.master')
@section('seo')
    @include('website::layouts.parts.seo', [
        'seo' => \App\Models\SEO::where('type','page')->where('resource_id', $page->id)->first(),
        "title" => $page->name,
        "image" => secure_url('/') . '/storage/'. app('settings')->get('header_logo')
    ])
@endsection
@section("content")

    @include('website::layouts.parts.page-banner', [
        "title" => $page->name
    ])

    <section class="home__about list__item">
        <div class="container">
            <div class="row">

                @if($page->image)
                <div class="col-lg-6">
                    <div class="home__about_img">
                        <img alt="{{$page->name}}" src="{{secure_url('/')}}/storage/{{\App\Helpers\WebpImage::generateUrl($page->image)}}" alt="{{$page->name}}">
                    </div>
                </div>
                @endif
                <div class="@if($page->image) col-lg-6 @else col-lg-12 @endif">
                    <div class="home__about_content">
                        <h2>{{$page->name}}</h2>
                        {!!$page->content!!}

                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('website::layouts.parts.suggested-cars', ['suggested_cars' => $page->cars])


    @include('website::layouts.parts.content', [
        "content" => \App\Models\Content::where('type','page')->where('resource_id', $page->id)->first()
    ])

    @include('website::layouts.parts.faq', [
        "faq" => \App\Models\Faq::where('type','page')->where('resource_id', $page->id)->get()
    ])


@endsection
