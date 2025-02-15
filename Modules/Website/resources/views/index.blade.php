
@extends('website::layouts.master')

@section('seo')
    @include('website::layouts.parts.seo', [
        'seo' => \App\Models\SEO::where('type','home')->first(),
        "title" => app('settings')->get('title'),
        "image" => secure_url('/') . '/website/images/fav.jpg'
    ])
@endsection

@section("content")

    @include('website::layouts.parts.search')

    <section class="home__brands">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="home__brands_title">
                        <h3>{{app('settings')->get('car_types_title')}}</h3>
                    </div>
                    <div class="home__brands_desc">
                    {{app('settings')->get('car_types_description')}}
                    </div>
                    <span class="read-more" style="cursor: pointer;">{{__('lang.Read More')}}</span>
                </div>

                <div class="col-lg-12">
                    <div data-items-large="6" data-is-loop="false" data-items-small="2" class="home__brands_content owl-carousel owl-theme">
                        @foreach($types as $item)
                        <a href="{{$item->external_url ?? LaravelLocalization::localizeUrl("/t/{$item->sync_id}/{$item->slug()}") }}">
                            <div class="home__brands_item">
                                <img width="174" height="100" loading="lazy" alt="{{$item->title . rand(0,9999)}}" src="{{asset("/storage/{$item->image}")}}"/>
                                <h3>{{$item->title}}</h3>
                            </div>
                        </a>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="home__brands">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="home__brands_title">
                        <h3>
                            {{app('settings')->get('car_brands_title')}}
                        </h3>
                    </div>
                    <div class="home__brands_desc">
                        {{app('settings')->get('car_brands_description')}}
                    </div>
                    <span class="read-more" style="cursor: pointer;">{{__('lang.Read More')}}</span>
                </div>

                <div class="col-lg-12">
                    <div data-items-large="6" data-is-loop="false" data-items-small="2" class="home__brands_content owl-carousel owl-theme">
                        @foreach(app('cars')->brands as $item)
                        <a href="{{LaravelLocalization::localizeUrl("/b/{$item->sync_id}/{$item->slug}") }}">
                            <div class="home__brands_item">
                                <img width="174" height="100"  loading="lazy" alt="{{$item->title . rand(0,9999)}}" src="{{asset("/storage/{$item->image}")}}"/>
                                <h3>{{$item->title}}</h3>
                            </div>
                        </a>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>

    @foreach($sections as $section)
        @include('website::layouts.parts.section', ['section' => $section])
    @endforeach


    @include('website::layouts.parts.banners',[
        "banners" => $banners
    ])

    @if(count($companies) > 0)
    <section class="home__features">
        <div class="container">
            <div class="row">

{{--                @include('website::layouts.parts.page-title', [--}}
{{--                    "title" => app('settings')->get('car_companies_title'),--}}
{{--                    "description" => app('settings')->get('car_companies_description'),--}}
{{--                ])--}}

                <div class="col-lg-12">
                    <div class="home__brands_title">
                        <h3>{{app('settings')->get('car_companies_title')}}</h3>
                    </div>
                    <div class="home__brands_desc">
                    {{app('settings')->get('car_companies_description')}}
                    </div>
                    <span class="read-more" style="cursor: pointer;">{{__('lang.Read More')}}</span>

                </div>

                <div class="col-lg-12">
                    <div data-items-large="6" data-items-small="2"  class="home__features_content home__rental_companies owl-carousel owl-theme">
                        @foreach($companies as $company)
                        <div class="product__vertical">
                            <a href="{{ LaravelLocalization::localizeUrl("/c/{$company->id}/{$company->slug()}") }}">
                            <div class="product__vertical_top">
                                <img loading="lazy" alt="{{$company->name}}" src="{{asset("/storage/{$company->image}")}}"/>
                            </div>
                            <div class="product__vertical_bottom">
                                <div class="product__vertical_bottom_features">
                                    <ul>
                                        @foreach($company->types()->limit(2)->get() as $type)
                                            <li>{{$type->title}}</li>
                                        @endforeach
                                    </ul>
                                </div>

                            </div>
                            </a>
                        </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </section>
    @endif

    @include('website::layouts.parts.content', [
        "content" => \App\Models\Content::where('type','home')->first()
    ])

    <section class="home__find_your_car">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="home__find_your_car_top">
                        <h2>{{app('settings')->get('find_your_car_title')}}</h2>
                        <p>{{app('settings')->get('find_your_car_description')}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="home__find_your_car_item">
                        <img width="55" height="55" alt="icon" src="{{asset("/website/images/icons/list.png")}}" />
                        <h3>{{__('lang.Choose Your Car')}}</h3>
                        <p>{{__('lang.Select a car using search or catalog.')}}</p>
                    </div>
                </div>
                <div class="col-lg-1">
                    <div class="home__find_your_car_line">
                        <img width="187" height="35" alt="icon" src="{{asset("/website/images/curve_up.png")}}" />
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="home__find_your_car_item">
                        <img width="55" height="55" alt="icon" src="{{asset("/website/images/icons/calendar.png")}}" />
                        <h3>{{__('lang.Contact Your Dealer')}}</h3>
                        <p>{{__('lang.After you’ve selected a car a dealer will contact you.')}}</p>
                    </div>
                </div>
                <div class="col-lg-1">
                    <div class="home__find_your_car_line">
                        <img  width="187" height="35" alt="icon" src="{{asset("/website/images/curve_down.png")}}" />
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="home__find_your_car_item">
                        <img  width="55" height="55" alt="icon" src="{{asset("/website/images/icons/check_ic.png")}}" />
                        <h3>{{__('lang.Get Your Car')}}</h3>
                        <p>{{__('lang.Here you are! Your car is book and waiting for you.')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="home__book_your_next_trip">
        <img class="bg" src="{{asset("/website/images/your_next_trip_bg.webp")}}" alt="bg" loading="lazy" />
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="home__book_your_next_trip_content">
                        {!!app('settings')->get('book_your_next_trip_left')!!}
                    </div>

                </div>
                <div class="col-lg-2">
                    <div class="vertical-line">

                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="home__book_your_next_trip_content">
                        {!!app('settings')->get('book_your_next_trip_right')!!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(app('settings')->get('google_reviews_widget'))
    <section class="home__google_reviews">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="home__google_reviews_title">
                        <p>{{__('lang.Testimonials')}}</p>
                        <h3>{{__('lang.Google Reviews')}}</h3>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 gr" data-item="{{app('settings')->get('google_reviews_widget')}}">


                </div>
            </div>
        </div>
    </section>
    @endif

    @if(app('settings')->get('facebook_reviews_widget'))
    <section class="home__google_reviews">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="home__google_reviews_title">
                        <p>{{__('lang.Testimonials')}}</p>
                        <h3>{{__('lang.Facebook Reviews')}}</h3>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 fb" data-item="{{app('settings')->get('facebook_reviews_widget')}}">

                </div>
            </div>
        </div>
    </section>
    @endif

    @include('website::layouts.parts.faq', [
        "faq" => \App\Models\Faq::where('type','home')->get()
    ])

@endsection
