@php use Mcamara\LaravelLocalization\Facades\LaravelLocalization; @endphp
@php use App\Models\Type; @endphp
@php use App\Models\Faq; @endphp
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    @section('seo')
    @show

    <link rel="preload" href="{{asset('/website/css/font-awesome.css')}}" as="style"
          onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{asset('/website/css/owl.carousel.min.css')}}" as="style"
          onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{asset('/website/css/owl.theme.default.min.css')}}" as="style"
          onload="this.onload=null;this.rel='stylesheet'">
    <!-- <link rel="preload" href="{{asset('/website/css/style.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'"> -->

    <link rel="stylesheet" href="{{asset('/website/css/bootstrap.min.css')}}">
    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{asset('/website/css/bootstrap-rtl.min.css')}}">
    @endif
    <link href="{{asset('/website/css/style.css')}}" rel="stylesheet">
    <link rel="preload" href="{{asset('/website/css/media.css')}}" as="style"
          onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="{{asset('/website/css/media.css')}}">
    </noscript>
    <!-- <link rel="stylesheet" href="{{asset('/css/bootstrap-rtl.min.css')}}"> -->

    <noscript>
        <link rel="stylesheet" href="{{asset('/website/css/font-awesome.css')}}">
    </noscript>
    <noscript>
        <link rel="stylesheet" href="{{asset('/website/css/owl.carousel.min.css')}}">
    </noscript>
    <noscript>
        <link rel="stylesheet" href="{{asset('/website/css/owl.theme.default.min.css')}}">
    </noscript>
    @section('css')
    @show

    @if(app()->getLocale() == 'ar')
        <link href="{{asset('/website/css/rtl.css')}}" rel="stylesheet">
    @endif
    <link rel="icon" href="{{asset('/website/images/fav.jpg')}}" type="image/x-icon">

    {{--    @if(isset($canonical)  && isset($resource) )--}}
    {{--        <link rel="canonical" href="{{LaravelLocalization::localizeUrl("/b/{$resource->sync_id}/{$resource->slug}") }}" />--}}
    {{--    @else--}}
    {{--        <link rel="canonical" href="{{url()->current()}}"/>--}}
    {{--    @endif--}}

    <link href="{{url()->current()}}" rel="canonical"/>


    <!--<link rel="preload" href="{{asset('/website/images/search_bg.webp')}}" as="image">-->

    <!-- Preload Bootstrap JavaScript -->
    <link rel="preload" href="{{asset('/website/js/bootstrap.min.js')}}" as="script">
    <link rel="preload" href="{{asset('/website/js/owl.carousel.min.js')}}" as="script">
    <link rel="preload" href="{{asset('/website/js/owl.carousel.min.js')}}" as="script">
    <link rel="preload" href="{{asset('/website/js/core.js')}}" as="script">

    {!!app('settings')->get('scripts')!!}

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-11558027423">
    </script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'AW-11558027423');
    </script>
</head>
<body>

{!!app('settings')->get('scripts_body')!!}
<input type="hidden" class="tr-read-more" value="{{__('lang.Read More')}}"/>
<input type="hidden" class="tr-read-less" value="{{__('lang.Read Less')}}"/>

<!-- <span class="loader">
    <i class="fa fa-spinner fa-spin"></i>
</span> -->

<input type="hidden" class="is-auth" value="{{auth()->guard('customers')->check() ? 'true' : 'false'}}"/>

<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('lang.Sign up')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="signup-form" action="{{LaravelLocalization::getLocalizedUrl(null, route('website.account.register'))}}" method="post">
                @csrf
                <div class="modal-body">
                    @if($errors->signup->any())
                        <div class="alert alert-danger">
                            @foreach($errors->signup->all() as $error)
                                {{$error}}
                            @endforeach
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="sign-up-name">{{__('lang.Name')}}</label>
                        <input id="sign-up-name" type="text" name="name"
                               autocomplete="name"
                               required class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="sign-up-email">{{__('lang.Email')}}</label>
                        <input id="sign-up-email" type="email" required name="email" autocomplete="email"
                               class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="sign-up-password">{{__('lang.Password')}}</label>
                        <input id="sign-up-password" type="password" autocomplete="current-password" required
                               name="password" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <button type="submit">{{__('lang.Sign up')}}</button>
                    </div>

                    <div class="form-group">


                        <a href="{{LaravelLocalization::getLocalizedUrl(null, route('website.account.login_with_provider', ['provider' => 'google']))}}" class="google social-login">
                            <i class="fa fa-google"></i>
                            <p>{{__('lang.Login with google')}}</p>
                        </a>
                        <a href="{{LaravelLocalization::getLocalizedUrl(null, route('website.account.login_with_provider', ['provider' => 'facebook']))}}" class="facebook social-login">
                            <i class="fa fa-facebook-square"></i>
                            <p>{{__('lang.Login with facebook')}}</p>
                        </a>

                    </div>


                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="signinModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('lang.Sign in')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ LaravelLocalization::getLocalizedUrl(null, route('website.account.login')) }}" method="post">
                @csrf
                <div class="modal-body">
                    @if($errors->login->any())
                        <div class="alert alert-danger">
                            @foreach($errors->login->all() as $error)
                                {{$error}}
                            @endforeach
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="sign-in-name">{{__('lang.Email')}}</label>
                        <input id="sign-in-name" autocomplete="email" type="text" name="email" required
                               class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="sign-in-password">{{__('lang.Password')}}</label>
                        <input id="sign-in-password" type="password" autocomplete="current-password" name="password"
                               required class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <button type="submit">{{__('lang.Sign in')}}</button>
                    </div>


                    <div class="form-group">


                        <a href="{{LaravelLocalization::getLocalizedUrl(null, route('website.account.login_with_provider', ['provider' => 'google']))}}" class="google social-login">
                            <i class="fa fa-google"></i>
                            <p>{{__('lang.Login with google')}}</p>
                        </a>
                        <a href="{{LaravelLocalization::getLocalizedUrl(null, route('website.account.login_with_provider', ['provider' => 'facebook']))}}" class="facebook social-login">
                            <i class="fa fa-facebook-square"></i>
                            <p>{{__('lang.Login with facebook')}}</p>
                        </a>

                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="scroll-up">
    <img width="50" height="100" alt="scroll" src="{{asset('/website/images/scroll_up.png')}}"/>
</div>

<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-5">
                <a href="{{ url(app()->getLocale()) }}">
                    <div class="logo">
                        <img width="197" height="60" src="/storage/{{ app('settings')->get('header_logo') }}"
                             alt="logo">
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-7">
                <a href="{{url('/listyourcar')}}">
                    <div class="header__list_your_car">
                        <img width="30" height="30" alt="listcar" class="car"
                             src="{{asset('/website/images/header_car.png')}}"/>
                        <p>{{__('lang.List your cars in TAJEER platform')}}</p>
                        <img alt="upload" class="icon" width="26" height="25"
                             src="{{asset('/website/images/icons/upload.png')}}"/>
                    </div>
                </a>
            </div>
            <div class="col-lg-7">
                <ul class="header__actions desktop__header_actions">
                    <li class="header__actions_list_item">
                        <p>
                            <i class="fa fa-map-marker"></i>
                            <span>{{__('lang.City')}}</span>
                        </p>
                        <div class="header__actions_label">
                            {{app('country')->getCountry()->title}} <i class="fa fa-angle-down"></i>
                        </div>
                        <ul class="header__actions_menu">
                            @foreach(app('country')->getAllCountries() as $country)
                                <li>
                                    <a href="{{ LaravelLocalization::getLocalizedUrl(null, route('website.switch.country', ['country' => $country])) }}">{{$country->title}}</a>
                                    @if(count($country->cities) > 0)
                                        <ul class="cities_menu">
{{--                                            <li>--}}
{{--                                                <a href="{{ LaravelLocalization::getLocalizedURL(null, route('website.switch.city', ['city' => 'all'])) }}">{{__('lang.All')}}--}}
{{--                                                    @if(app('country')->getCountry()->id == $country->id && !app('country')->getCity())--}}
{{--                                                        <i class="fa fa-check"></i>--}}
{{--                                                    @endif--}}
{{--                                                </a>--}}
{{--                                            </li>--}}
                                            @foreach($country->cities as $city)
                                                <li>
                                                    <a href="{{ LaravelLocalization::getLocalizedURL(null, route('website.switch.city', ['city' => $city])) }}">{{$city->title}}
                                                        @if(app('country')->getCity() && $city->id == app('country')->getCity()->id)
                                                            <i class="fa fa-check"></i>
                                                        @endif
                                                    </a>
                                                </li>

                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="header__actions_list_item">
                        <p>
                            <i class="fa fa-money"></i>
                            <span>Currency</span>
                        </p>
                        <div class="header__actions_label">
                            {{app('currencies')->getCurrency()->code}} <i class="fa fa-angle-down"></i>
                        </div>
                        <ul class="header__actions_menu">
                            @foreach(app('currencies')->getAllCurrencies() as $currency)
                                <li>
                                    <a href="{{ LaravelLocalization::getLocalizedURL(null, route("website.switch.currency", ['currency' => $currency])) }}">{{$currency->code}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <li class="header__actions_list_item">
                        <p>
                            <i class="fa fa-language"></i>
                            <span>{{ __('lang.Language') }}</span>
                        </p>
                        <div class="header__actions_label">
                            {{ config('app.languages')[app()->getLocale()] }} <i class="fa fa-angle-down"></i>
                        </div>

                        @php
                            $currentUrl = url()->current();
                            $supportedLanguages = LaravelLocalization::getSupportedLocales(); // Get supported languages from LaravelLocalization
                            $currentLang = app()->getLocale(); // Get the current language
                        @endphp

                        <ul class="header__actions_menu">
                            @foreach ($supportedLanguages as $langCode => $langDetails)
                                <li>
                                    <a href="{{ LaravelLocalization::getLocalizedURL($langCode, null, [], true)  }}"
                                       class="text-decoration-none">
                                        <div class="px-1"
                                             style="margin-top:-10px; border-radius: 15%; cursor: pointer; background-color: #fff">
                                            <img src="{{ $langCode == 'ar' ? asset('assets/img/lang_ar.png') : asset('assets/img/lang_en.png') }}" style="width:20px;height:16px" class="rounded-1 m-0"
                                                 alt="{{ __('lang.lang_' . $langCode) }}">
                                            <span class="mx-1 my-0"
                                                  style="font-size: 16px;">{{ __('lang.lang_' . $langCode) }}</span>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="header__actions_list_item">
                        <div class="header__actions_label">
                            <i class="fa fa-user"></i>
                            @if(!auth()->guard('customers')->check())
                                {{__('lang.My Account')}}
                            @else
                                {{__('lang.Welcome')}}, {{auth()->guard('customers')->user()->name}}
                            @endif
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <ul class="header__actions_menu">
                            @if(!auth()->guard('customers')->check())
                                <li data-toggle="modal" data-target="#signinModal">{{__('lang.Sign in')}}</li>
                                <li data-toggle="modal" data-target="#signupModal">{{__('lang.Sign up')}}</li>
                            @else
                                <li>
                                    <a href="/account/wishlist">
                                        {{__('lang.Wishlist')}}
                                    </a>
                                </li>
                                <li>
                                    <a href="/logout">{{__('lang.Logout')}}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</header>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="header__actions mobile__header_actions">
            <li class="header__actions_list_item">
                <p>
                    <i class="fa fa-map-marker"></i>

                </p>
                <div class="header__actions_label">
                    {{app('country')->getCountry()->title}} <i class="fa fa-angle-down"></i>
                </div>
                <ul class="header__actions_menu">
                    @foreach(app('country')->getAllCountries() as $country)
                        <li>
                            <a href="{{ LaravelLocalization::getLocalizedUrl(null, route('website.switch.country', ['country' => $country])) }}">{{$country->title}}</a>
                            @if(count($country->cities) > 0)
                                <ul class="cities_menu">
                                    <li>
                                        <a href="{{ LaravelLocalization::getLocalizedUrl(null, 'website.switch.city', ['city' => null]) }}">{{__('lang.All')}}
                                            @if(app('country')->getCountry()->id == $country->id && !app('country')->getCity())
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </a>
                                    </li>
                                    @foreach($country->cities as $city)
                                        <li>
                                            <a href="{{ LaravelLocalization::getLocalizedURL(null, route('website.switch.city', ['city' => $city]))}}">{{$city->title}}
                                                @if(app('country')->getCity() && $city->id == app('country')->getCity()->id)
                                                    <i class="fa fa-check"></i>
                                                @endif
                                            </a>
                                        </li>

                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </li>

            <li class="header__actions_list_item">
                <p>
                    <i class="fa fa-money"></i>

                </p>
                <div class="header__actions_label">
                    {{app('currencies')->getCurrency()->code}} <i class="fa fa-angle-down"></i>
                </div>
                <ul class="header__actions_menu">
                    @foreach(app('currencies')->getAllCurrencies() as $currency)
                        <li>
                            <a href="{{ LaravelLocalization::getLocalizedUrl(null, route('website.switch.currency', ['currency' => $currency])) }}">{{$currency->code}}</a>
                        </li>
                    @endforeach
                </ul>
            </li>

            <li class="header__actions_list_item">
                <p>
                    <i class="fa fa-language"></i>

                </p>
                <div class="header__actions_label">
                    {{config('app.languages')[app()->getLocale()]}} <i class="fa fa-angle-down"></i>
                </div>
                <ul class="header__actions_menu">


                    @foreach ($supportedLanguages as $langCode => $langDetails)
                        @php
                            // Determine the URL for each language
                            if ($currentUrl === url('/')) {
                                $newUrl = url('/') . '/' . $langCode; // Append the language suffix
                            } else {
                                // Replace the current language in the URL with the new language
                                $newUrl = preg_replace('/\/(en|ar|sr)\//', '/' . $langCode . '/', $currentUrl);

                                // If the URL doesn't have a language prefix (like /about), append the language suffix
                                if (!preg_match('/\/(en|ar|sr)\//', $currentUrl)) {
                                    $newUrl = url('/') . '/' . $langCode;
                                }
                            }
                        @endphp
                        <li>
                            <a href="{{ $newUrl }}" class="text-decoration-none">
                                <div class="px-1"
                                     style="margin-top:-10px; border-radius: 15%; cursor: pointer; background-color: #fff">
                                    <img src="{{
                            $langCode == 'ar' ? asset('assets/img/lang_ar.png') :
                            ($langCode == 'ur' ? asset('assets/img/lang_en.png') : asset('assets/img/lang_en.png'))
                        }}" style="width:20px;height:16px" class="rounded-1 m-0">
                                    <span class="mx-1 my-0"
                                          style="font-size: 16px;">{{ __('lang.lang_' . $langCode) }}</span>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>

        </ul>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="mobile-top-bar">
                <img width="197" height="60" src="/storage/{{app('settings')->get('header_logo')}}" alt="logo">
                <i class="fa fa-times close-menu"></i>

            </div>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{LaravelLocalization::getLocalizedUrl(null, route('home'))}}">{{__('lang.Home')}}</a>
                </li>
                <li class="nav-item dropdown">
                        <span class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown"
                              aria-haspopup="true" aria-expanded="false">
                        {{__('lang.Car Brands')}}
                        </span>
                    <div class="dropdown-menu navbar__car_brand" aria-labelledby="navbarDropdown">
                        <div class="container">
                            <div class="row">
                                @foreach(app('cars')->brands as $item)
                                    <div class="col-lg-3">
                                        <a href="{{ LaravelLocalization::getLocalizedUrl(null, route('website.cars.brands.show', ['brand' => $item]))}}">
                                            <div class="navbar__car_brand_item">
                                                <img loading="lazy" alt="{{$item->title}}"
                                                     src="/storage/{{$item->image}}"/>
                                                <p>{{$item->title}} </p>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </li>

                @if ($type = Type::whereSlug('with-driver')->first())
                    <li class="nav-item active">
                        <a class="nav-link"
                           href="{{ LaravelLocalization::getLocalizedURL(null, route('website.cars.types.show', ['type' => $type])) }}">{{__('lang.Rent a car with driver')}}</a>
                    </li>
                @endif


                @if ($type = Type::whereSlug('yachts')->first())
                    <li class="nav-item active">
                        <a class="nav-link"
                           href="{{ LaravelLocalization::getLocalizedURL(null, route('website.yachts.index')) }}">{{__('lang.Rent yacht')}}</a>
                    </li>
                @endif

                <li class="nav-item active">
                    <a class="nav-link" href="{{ LaravelLocalization::getLocalizedUrl(null, route('website.blogs.index')) }}">{{__('lang.Blog')}}</a>
                </li>


                <li class="nav-item dropdown">
                        <span class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown"
                              aria-haspopup="true" aria-expanded="false">
                        {{__('lang.Quick Links')}}
                        </span>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item"
                           href="{{ LaravelLocalization::localizeUrl("/contact") }}">{{__('lang.Contact Us')}}</a>
                        @foreach(app('settings')->getHeaderPages() as $item)
                            <a class="dropdown-item"
                               href="{{ LaravelLocalization::localizeUrl("/p/{$item->id}/{$item->slug}") }}">{{$item->name}}</a>
                        @endforeach
                    </div>
                </li>
            </ul>
            <div class="mobile-my-account">
                @if(!auth()->guard('customers')->check())
                    <span data-toggle="modal" class="open-auth" data-target="#signinModal">
                            {{__('lang.Sign in')}}
                        </span>
                    <span data-toggle="modal" class="open-auth" data-target="#signupModal">
                            {{__('lang.Sign up')}}
                        </span>
                @else
                    <a href="{{ LaravelLocalization::localizeUrl("account/wishlist") }}">
                        {{__('lang.Wishlist')}}
                    </a>
                    <a href="{{url('/logout')}}">
                        {{__('lang.Logout')}}
                    </a>
                @endif
            </div>

            <div class="nav-icons my-2 my-lg-0">
                <ul>
                    <li>
                        <a href="tel:{{app('settings')->get('contact_phone')}}">
                            <img width="36" height="36" alt="call" src="{{asset('/website/images/icons/call.png')}}"/>
                        </a>
                    </li>
                    <li>
                        <a href="{{app('settings')->get('contact_facebook')}}">
                            <img width="36" height="36" alt="fb" src="{{asset('/website/images/icons/facebook.png')}}"/>
                        </a>
                    </li>
                    <li>
                        <a href="{{app('settings')->get('contact_twitter')}}">
                            <img width="36" height="36" alt="twitter"
                                 src="{{asset('/website/images/icons/twitter.png')}}"/>
                        </a>
                    </li>
                    <li>
                        <a href="{{app('settings')->get('contact_instagram')}}">
                            <img width="36" height="36" alt="instagrm"
                                 src="{{asset('/website/images/icons/instagram.png')}}"/>
                        </a>
                    </li>
                    <li>
                        <a href="{{app('settings')->get('app_google_play')}}">
                            <img width="125" height="37" alt="app" class="apps-image"
                                 src="{{asset('/website/images/icons/googleplay.webp')}}"/>
                        </a>
                    </li>
                    <li>
                        <a href="{{app('settings')->get('app_apple_store')}}">
                            <img alt="app" width="115" height="41" class="apps-image"
                                 src="{{asset('/website/images/icons/appstore.webp')}}"/>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</nav>

@section("content")
@show


<footer>
    <img class="bg" loading="lazy" src="{{asset('/website/images/footer_bg.webp')}}" alt="bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <ul>
                    <li>
                        <a data-toggle="tooltip" data-placement="left" title="{{__('lang.FAQ')}}"
                           href="{{ LaravelLocalization::getLocalizedUrl(null, route('website.pages.faq')) }}">{{__('lang.FAQ')}}</a>
                    </li>
                    <li>
                        <a data-toggle="tooltip" data-placement="left" title="{{__('lang.Blog')}}"
                           href="{{ LaravelLocalization::getLocalizedUrl(null, route('website.blogs.index')) }}">{{__('lang.Blog')}}</a>
                    </li>
                    <li>
                        <a data-toggle="tooltip" data-placement="left" title="{{__('lang.Contact Us')}}"
                           href="{{ LaravelLocalization::getLocalizedUrl(null, route('website.pages.contact-us')) }}">{{__('lang.Contact Us')}}</a>
                    </li>
                    @foreach(app('settings')->getFooterPages() as $key => $item)

                        <li>
                            <a data-toggle="tooltip" data-placement="left" title="{{$item->name}}"
                               href="{{ LaravelLocalization::getLocalizedUrl(null, route('website.pages.show', ['page' => $item])) }}">{{$item->name}}</a>
                        </li>

                    @endforeach
                    @foreach(Type::get() as $t)
                        <li>
                            <a data-toggle="tooltip" data-placement="left" title="{{__('lang.Rent')}} {{$t->title}}"
                               href="{{ LaravelLocalization::getLocalizedURL(null, route('website.cars.types.show', ['type' => $t])) }}">{{__('lang.Rent')}} {{$t->title}}</a>
                        </li>
                    @endforeach


                </ul>
            </div>


            <div class="col-lg-3">
                <div class="footer-apps">
                    <p>
                        <span>{{__('lang.Download on the')}} </span>
                        <!-- {{__('lang.App Store & Google play')}} </p> -->

                        <a style="margin-top:15px;display:block" href="{{app('settings')->get('app_google_play')}}">

                            <img alt="app" width="125" height="37"
                                 src="{{asset('/website/images/icons/googleplay.webp')}}"/>
                        </a>
                        <a href="{{app('settings')->get('app_apple_store')}}">

                            <img loading="lazy" width="125" height="37" style="margin-top:10px" alt="app"
                                 src="{{asset('/website/images/icons/appstore2.webp')}}"/>

                        </a>
                    <ul class="contact-footer" style="margin-top:20px;display:block">
                        <li>
                            <a href="tel:{{str_replace(' ', '', app('settings')->get('contact_phone') )}}"><svg id="phone-svgrepo-com_1_" data-name="phone-svgrepo-com (1)" xmlns="http://www.w3.org/2000/svg" width="15.457" height="15.457" viewBox="0 0 15.457 15.457">
  <g id="Group_2510" data-name="Group 2510" transform="translate(1.562 0)">
    <path id="Path_1041" data-name="Path 1041" d="M20.327,11.406a7.674,7.674,0,0,0-2.292-1.981c-.408-.233-.9-.259-1.133.156a9.3,9.3,0,0,1-.735.8,1.369,1.369,0,0,1-1.948-.193L12.739,8.712,11.26,7.233a1.369,1.369,0,0,1-.193-1.948,9.3,9.3,0,0,1,.8-.735c.414-.233.389-.725.156-1.133a7.674,7.674,0,0,0-1.981-2.292,1.013,1.013,0,0,0-1.19.179L8.2,1.957C6.129,4.029,7.149,6.369,9.222,8.442l1.894,1.894L13.01,12.23c2.072,2.072,4.412,3.093,6.485,1.02l.654-.654A1.014,1.014,0,0,0,20.327,11.406Z" transform="translate(-6.808 -0.747)" fill="#3e1f50"/>
    <path id="Path_1042" data-name="Path 1042" d="M16.279,13.9a3.68,3.68,0,0,1-.83-.1,7.369,7.369,0,0,1-3.366-2.133L8.294,7.876A7.37,7.37,0,0,1,6.161,4.51,3.572,3.572,0,0,1,7.274,1.027L7.927.374A1.264,1.264,0,0,1,9.42.149,7.774,7.774,0,0,1,11.5,2.539a1.274,1.274,0,0,1,.168.962.855.855,0,0,1-.4.514,8.54,8.54,0,0,0-.739.668A1.115,1.115,0,0,0,10.7,6.3l2.959,2.959a1.116,1.116,0,0,0,1.622.162,8.632,8.632,0,0,0,.668-.739.855.855,0,0,1,.514-.4,1.27,1.27,0,0,1,.959.166,7.782,7.782,0,0,1,2.392,2.084h0a1.264,1.264,0,0,1-.225,1.493l-.654.653A3.7,3.7,0,0,1,16.279,13.9ZM8.825.516a.754.754,0,0,0-.533.222l-.653.654a3.05,3.05,0,0,0-.976,3,6.881,6.881,0,0,0,2,3.118L12.447,11.3a6.882,6.882,0,0,0,3.118,2,3.054,3.054,0,0,0,3-.976l.654-.653a.752.752,0,0,0,.134-.888h0A7.155,7.155,0,0,0,17.159,8.9a.79.79,0,0,0-.563-.116.346.346,0,0,0-.215.176L16.354,9a7.6,7.6,0,0,1-.789.852,1.625,1.625,0,0,1-2.275-.224L10.332,6.667a1.752,1.752,0,0,1-.558-1.519,1.782,1.782,0,0,1,.334-.755A7.6,7.6,0,0,1,10.96,3.6L11,3.577a.347.347,0,0,0,.176-.215.793.793,0,0,0-.118-.566A7.481,7.481,0,0,0,9.18.6.76.76,0,0,0,8.825.516Z" transform="translate(-6.063 0)" fill="#3e1f50"/>
  </g>
  <path id="Path_1043" data-name="Path 1043" d="M37.157,37.744H37.13a5.378,5.378,0,0,1-2.988-1.361.258.258,0,0,1,.361-.367,4.94,4.94,0,0,0,2.679,1.215.258.258,0,0,1-.026.514Z" transform="translate(-25.29 -26.683)" fill="#3e1f50"/>
  <path id="Path_1044" data-name="Path 1044" d="M18.868,17.289a.256.256,0,0,1-.164-.059,4.92,4.92,0,0,1-1.638-3.006.258.258,0,1,1,.513-.053,4.472,4.472,0,0,0,1.453,2.661.258.258,0,0,1-.165.456Z" transform="translate(-12.669 -10.35)" fill="#3e1f50"/>
  <path id="Path_1045" data-name="Path 1045" d="M.257,51.1a.263.263,0,0,1-.074-.011.258.258,0,0,1-.173-.321l.675-2.25a.36.36,0,0,1,.689,0L1.8,49.943l.428-1.427a.36.36,0,0,1,.689,0l.428,1.427.428-1.427a.36.36,0,0,1,.689,0l.428,1.427.428-1.427a.36.36,0,0,1,.689,0l.428,1.427.428-1.427a.36.36,0,0,1,.689,0l.233.776a1.81,1.81,0,0,0,3.544-.52v-.508a.258.258,0,0,1,.515,0v.508A2.325,2.325,0,0,1,7.3,49.44l-.084-.28-.428,1.427a.36.36,0,0,1-.689,0L5.667,49.16l-.428,1.427a.36.36,0,0,1-.689,0L4.121,49.16l-.428,1.427a.36.36,0,0,1-.689,0L2.576,49.16l-.428,1.427a.36.36,0,0,1-.689,0L1.03,49.16.5,50.913A.258.258,0,0,1,.257,51.1Z" transform="translate(0 -35.64)" fill="#3e1f50"/>
</svg>
 {{app('settings')->get('contact_phone')}}</a>
                            </a>
                        </li>
                        <li>
                            <a href="https://wa.me/{{str_replace(' ', '', app('settings')->get('contact_whatsapp') )}}">
                                <i class="fa fa-whatsapp whatsapp-contact"></i> {{app('settings')->get('contact_whatsapp') }}
                            </a>
                        </li>
                        <li>
                            <a href="mailto:{{app('settings')->get('contact_email')}}"><i
                                        class="fa fa-envelope"></i> {{app('settings')->get('contact_email')}}
                            </a>
                        </li>


                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-bottom">
                    <p>
                        {{app('settings')->get('footer_address')}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="{{asset('/website/js/jquery-3.2.1.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<script src="{{asset('/website/js/bootstrap.min.js')}}"></script>

<script>
    jQuery.event.special.touchstart = {
        setup: function (_, ns, handle) {
            this.addEventListener("touchstart", handle, {passive: !ns.includes("noPreventDefault")});
        }
    };
    jQuery.event.special.touchmove = {
        setup: function (_, ns, handle) {
            this.addEventListener("touchmove", handle, {passive: !ns.includes("noPreventDefault")});
        }
    };
    jQuery.event.special.wheel = {
        setup: function (_, ns, handle) {
            this.addEventListener("wheel", handle, {passive: true});
        }
    };
    jQuery.event.special.mousewheel = {
        setup: function (_, ns, handle) {
            this.addEventListener("mousewheel", handle, {passive: true});
        }
    };
</script>

<!-- <script  src="{{asset('/website/js/sweetalert2.all.min.js')}}" ></script> -->
<script src="{{asset('/website/js/owl.carousel.min.js')}}"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/8.10.0/firebase-messaging.min.js"
        integrity="sha512-v5yEhqjlpSupFcjvkEP+AloVEjQBd/CK0pysyAw/YCChyiq54FUuucx2N9oACFBi1qHXsAuhOMsoHiFYxIXCMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('/website/firebase/config.js')}}"></script>
<script src="{{asset('/website/firebase/messaging.js')}}"></script>
@section('libs')
@show

<script src="{{asset('/website/js/core.js')}}"></script>

@if($errors->signup->any())
    <script>
        $('#signupModal').modal('show');
    </script>
@endif
@if($errors->login->any() || request()->get('login'))
    <script>
        $('#signinModal').modal('show');
    </script>
@endif


@section('js')
@show

@section('schemes')
@show

@section('breadcrumbs')
@show
<script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "LocalBusiness",
        "name": "TAJEER",
        "image": "{{asset('/')}}/storage/{{app('settings')->get('header_logo')}}",
            "telephone": "{{app('settings')->get('contact_phone')}}",
            "priceRange": "AED 100-60000",
            "email": "{{app('settings')->get('contact_email')}}",
            "address": {
                    "@type": "PostalAddress",
                    "streetAddress": "{{app('settings')->get('footer_address')}}",
                    "addressLocality": "Dubai",
                    "postalCode": "00000",
                    "addressCountry": "AE"
             },
            "url": "{{secure_url('/')}}"
        }
</script>
@php
    $faq_length = Faq::where('type','home')->count();
@endphp
<script type="application/ld+json">
    {
        "@context":"https://schema.org",
        "@type":"FAQPage",
        "mainEntity":[
    @foreach(Faq::where('type','home')->get()  as $key => $faq)
        {"@type":"Question","name":"{{$faq->question}}","acceptedAnswer":{"@type":"Answer","text":"{{$faq->answer}}
        "} } @if($key != $faq_length - 1)
            ,
        @endif
    @endforeach
    ]
}
</script>
<script type="application/ld+json">
    {
        "@context": "http://schema.org/",
        "@type": "ImageObject",
        "description":"{{app('settings')->get('title')}}",
                "image":"{{asset('/')}}/storage/{{app('settings')->get('header_logo')}}",
                "name":"{{app('settings')->get('title')}}",
                "potentialAction":"logo",
                "url":"{{secure_url('/')}}"
        }
</script>
</body>
</html>
