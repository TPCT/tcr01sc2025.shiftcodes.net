@extends('website::layouts.master')
@section('css')
    <style>
        @media screen and (max-width:767px) {
            .single_product_right .product__vertical_actions {
                position: fixed;
                width: 100%;
                bottom: 0;
                z-index: 999999;
                background: white;
                border-top: 2px solid #3A1B50;
                left:0
            }
            .scroll-up {
                bottom: 70px;
            }
            .tooltip {
                z-index: 99999999999999999;
            }
        }
    </style>
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" referrerpolicy="no-referrer" />-->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>
@endsection
@section('seo')
    @include('website::layouts.parts.seo', [
        'seo' => $car->model ? \App\Models\SEO::where('type','model')->where('resource_id', $car->model->id)->first() : null,
        "title" => $car->name . "-" .  ( $car->company?->name ??  ''  ) . " #" .   $car->id ,
        "image" => secure_url('/') . '/storage/'. \App\Helpers\WebpImage::generateUrl($car->image)
    ])
@endsection
@section("content")

<section class="products-page">
        <div class="container">
            <div class="row">
                @include('website::cars.parts.breadcrumb')
                @include('website::layouts.parts.page-title',[
                    "title"       => $car->name,
                    "description" => $car->getDescription(),
                ])
            </div>

            <div class="row mt-25">
                <div class="col-lg-7">
                    <div class="single_product_main_image">
                    <div data-items-large="1" data-items-small="1" class="single-image-slider owl-carousel owl-theme">
                    <div class="single_product_main_image-box" data-src="/storage/{{\App\Helpers\WebpImage::generateUrl($car->image)}}" data-fancybox="gallery">
                        <img alt="{{$car->name}}" src="/storage/{{\App\Helpers\WebpImage::generateUrl($car->image)}}" />
                        <div class="product__vertical_meta">
                            <span class="wishlist wishlist-toggle" data-auth="" data-id="">@lang('lang.Save to wishlist')</span>
                        </div>
                    </div>
                        @foreach($car->images as $image)
                        <div data-src="/storage/{{\App\Helpers\WebpImage::generateUrl($car->image)}}" data-fancybox="gallery">
                            <img alt="{{$car->name}}" src="/storage/{{\App\Helpers\WebpImage::generateUrl($image->image)}}" />
                        </div>
                        @endforeach
                    </div>

                    </div>
                    <div data-items-large="3" data-items-small="2" class="single_product_images owl-carousel owl-theme">
                    @foreach($car->images as $image)
                        <div class="single_product_images_item">
                            <div data-src="/storage/{{\App\Helpers\WebpImage::generateUrl($image->image)}}" data-fancybox="gallery">
                                <img alt="{{$car->name}}" src="/storage/{{\App\Helpers\WebpImage::generateUrl($image->image)}}" />
                            </div>
                        </div>
                    @endforeach
                    </div>

                    <div class="notes_desktop">
                        <div class="note__label_holder" style="margin-top:25px">
                            <h6 class="note__label">{{__('lang.Please Note')}}</h6>
                        </div>
                           <p> {!! collect(explode( '•' ,  $car->customer_notes))->filter()->map(function($line) {
                                return "• " . $line . "</br>";

                           } )->implode('') !!} </p>

                        <div class="sidebar company_terms_holder company_notes_holder car__notes_holder">
                            <div class="widget">
                                <div class="widget__content car__notes">
                                    {!! app('settings')->get($car->type . "_notes") !!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-5">
                    <div class="single_product_right">
                        <h2>{{$car->name}}</h2>
                        <!-- <p class="single_product__mini_description">
                            {{$car->description}}
                        </p> -->

                        <div class="product__vertical product__horizontal">

                            <div class="product__vertical_bottom">
                                <div class="product__vertical_bottom_features">
                                    <ul>
                                        @if($car->brand  && $car->type != "yacht")
                                        <li>{{__('lang.Brand')}} / {{$car->brand ? $car->brand->title : ""}}</li>
                                        @endif
                                        <li>{{__('lang.Model')}} / {{$car->model ? $car->model->title : ""}}</li>

                                        @if($car->year && $car->type != "yacht")
                                        <li>{{__('lang.Year')}} / {{$car->year ? $car->year->title : ""}}</li>
                                        @endif

                                        @if($car->type != "yacht")
                                        <li>{{__('lang.Color')}} / {{$car->color ? $car->color->title : ""}}</li>
                                        @endif
                                        @if($car->type != 'yacht')
                                        <li>{{__('lang.Doors')}} / {{$car->doors}}</li>
                                        @endif
                                        @if($car->passengers)
                                        <li>{{$car->type == 'yacht' ? __('lang.Guests')  : __('lang.Passengers')}} / {{$car->passengers}}</li>
                                        @endif
                                        @if($car->bags)
                                        <li>{{__('lang.No. Of Luggage')}} / {{$car->bags ? $car->bags : "-"}}</li>
                                        @endif
                                    </ul>
                                    <ul>
                                        <li>{{$car->type == "default" ? __('lang.Minimum of Days') : __('lang.Minimum of Hours') }} / {{$car->minimum_day_booking}}</li>
                                        @if($car->type == "default")
                                        <li>{{__('lang.Deposit')}} / {{app('currencies')->convert($car->security_deposit)}} {{app('currencies')->getCurrency()->code}}</li>
                                        <li>
                                            {{__('lang.KM Limit Day')}} / {{$car->km_per_day ? $car->km_per_day : 250}} KM
                                        </li>
                                        <li>
                                            {{__('lang.KM Limit Month')}} / {{$car->km_per_month ? $car->km_per_month : 0}} KM
                                        </li>

                                        <li>{{__('lang.Insurance Type')}} / {{__('lang.Full')}} </li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="home__brands_item product__horizontal_fees single_car_prices">
                                    @if($car->price_per_day)
                                    <h3>
                                        <span>{{$car->type == "default" ? __('lang.Day') : __('lang.Hour')}} /</span>
                                        <span>{{app('currencies')->convert($car->price_per_day)}} {{app('currencies')->getCurrency()->code}}</span>
                                    </h3>
                                    @endif
                                    @if($car->price_per_week)
                                    <h3>
                                        <span>{{$car->type == "default" ? __('lang.Week') : "3 " . __('lang.Hours')}} /</span>
                                        <span>{{app('currencies')->convert($car->price_per_week)}} {{app('currencies')->getCurrency()->code}}</span>
                                    </h3>
                                    @endif

                                    @if($car->price_per_month)
                                    <h3>
                                        <span>{{$car->type == "default" ? __('lang.Month') : "8 " . __('lang.Hours')}} /</span>
                                        <span>{{app('currencies')->convert($car->price_per_month)}} {{app('currencies')->getCurrency()->code}}</span>
                                    </h3>
                                    @endif
                                </div>

                                <div class="product__vertical_actions">
                                    <ul>
                                        @include('website::layouts.parts.car-actions', ['car' => $car])
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="notes_mobile">
                        <div class="note__label_holder" style="margin-top:25px">
                            <h6 class="note__label">{{__('lang.Please Note')}}</h6>
                        </div>

                        <div class="sidebar company_terms_holder company_notes_holder car__notes_holder">
                                    <div class="widget">
                                        <div class="widget__content car__notes">


                                        {!! app('settings')->get($car->type . "_notes") !!}

                                        </div>
                                    </div>

                        </div>

                    </div>

                        <div class="sidebar company_terms_holder">

                            <div class="widget">
                                <div class="widget__content">
                                    <ul class="car_company_terms">
                                        @if( $car->type != "yacht")
                                        <li>
                                            <span class="link">
                                                {{__('admin.Delivery Time')}} / {{$car->company->delivery_time}} {{__('lang.Hours')}}
                                            </span>
                                        </li>
                                        @endif
                                        @php
                                            $payment_methods = explode(",", $car->company->payment_methods);
                                        @endphp
                                        <li>
                                            <span class="link">
                                                {{__('admin.Payment Methods')}} /
                                                @foreach($payment_methods as $method)
                                                {{__('admin.' . $method)}} @if(!$loop->last) - @endif
                                                @endforeach
                                            </span>
                                        </li>
                                        <li>
                                            <span class="link">
                                                {{$car->type == "yacht" ? __('lang.City') : __('lang.Delivery Locations')}} /
                                                @foreach($car->company->cities as $city)
                                                {{$city->title}} @if(!$loop->last) - @endif
                                                @endforeach
                                            </span>
                                        </li>
                                        @if($car->company->type == "default")
                                        <li>
                                            <span class="link">
                                                {{__('admin.Salik Fees')}} / {{$car->company->salik_fees}} AED
                                            </span>
                                        </li>
                                        @endif
                                        <li>
                                            <span class="link">
                                            {{__('lang.VAT')}} / {{$car->company->vat_percentage}}% ({{__('lang.Not Included')}})
                                            </span>
                                        </li>
                                        <li>
                                            <span class="link">
                                            {{__('lang.Age Required')}} / +{{$car->company->min_age}}
                                            </a>
                                        </li>
                                        @if($car->company->type == "default")
                                        <li>
                                            <span class="link">
                                            {{__('admin.Deposit Refund')}} / {{$car->company->deposit_refund}} ({{__('lang.Days')}})
                                            </span>
                                        </li>
                                        @endif
                                        <li>
                                            <span class="link">
                                                {{__('lang.working_hours_days')}} /
                                                <ul>
                                                    @foreach($car->company->hours()->where('type','!=','')->get() as $hour)
                                                        <li>
                                                            <span class="link">

                                                                <div>
                                                                    {{__('admin.' . $hour->day)}}
                                                                    @if($hour->type == 'open')

                                                                    @if($hour->time_from && $hour->time_to)
                                                                        <span>{{__('admin.from')}} {{$hour->time_from->format('H:iA')}} {{__('admin.to')}} {{$hour->time_to->format('H:iA')}}</span>
                                                                    @endif
                                                                    @elseif($hour->type == '24')
                                                                    {{__('admin.24')}}
                                                                    @elseif($hour->type == 'holiday')
                                                                    {{__('admin.holiday')}}
                                                                    @endif
                                                                </div>
                                                            </span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                @if($car->features->count() > 0)
                <div class="col-lg-12">
                    <div class="car__features">
                        <div class="note__label_holder">
                            <h6 class="note__label features">{{__('lang.Features')}}</h6>
                        </div>
                        <ul>
                        @foreach($car->features as $item)
                        <li>{{$item->name}}</li>
                        @endforeach

                        </ul>
                    </div>
                </div>
                @endif

            </div>

            <div class="row mt-25">
                <div class="col-lg-12">
                    <div class="single_product__bottom">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <!-- <li class="nav-item">
                              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{__('lang.Description')}}</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{__('lang.Terms and Conditions')}}</a>
                            </li> -->
                          </ul>
                          <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                @if($car->getFeatures())
                                <div class="note__label_holder">
                                    <h6 class="note__label features">{{$car->name}}</h6>
                                </div>
                                <div>
                                    {!! $car->getFeatures()  !!}
                                </div>
                                @endif


                            </div>

                          </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

    @include('website::layouts.parts.suggested-cars', ['suggested_cars' => $suggested_cars])

    @include('website::layouts.parts.content', [
        "content" => \App\Models\Content::where('type','car')->where('resource_id', $car->id)->first()
    ])

    @include('website::layouts.parts.faq', [
        "faq" => \App\Models\Faq::where('type','car')->where('resource_id', $car->id)->get()
    ])


@endsection
@section('libs')
{{--<script  src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js" integrity="sha512-Ixzuzfxv1EqafeQlTCufWfaC6ful6WFqIz4G+dWvK0beHw0NVJwvCKSgafpy5gwNqKmgUfIBraVwkKI+Cz0SEQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
{{--<script>--}}
{{--    lightbox.option({--}}
{{--      'resizeDuration': 0,--}}
{{--      'wrapAround': true,--}}
{{--      'fadeDuration':0,--}}
{{--      'albumLabel:' : ''--}}
{{--    })--}}
{{--    </script>--}}
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
    Fancybox.bind("[data-fancybox]", {
        // Your custom options
    });
</script>
@endsection
@section('schemes')

        <script type="application/ld+json">{
            "@context": "https://schema.org",
            "@type": ["AutoRental","Product", "Car"],
            "name": "{{$car->name}}",
            "telephone": "{{app('settings')->get('contact_phone')}}",
             "priceRange": "AED 100-60000",
            "vehicleIdentificationNumber": "{{substr(md5($car->id) , 0 , 17)}}",
            "vehicleModelDate": "{{$car->year ? $car->year->title : '2021'}}",
            "image": [
                "{{secure_url('/')}}/storage/{{\App\Helpers\WebpImage::generateUrl($car->image)}}"
            ],
            "url": "{{secure_url('/')}}/{{$car->id}}/{{$car->slug}}",
            "offers": {
                "@type": "Offer",
                "availability": "https://schema.org/InStock",
                "price": "{{ isset($car->price_per_day) && $car->price_per_day > 0 ? $car->price_per_day   : 100}}",
                "priceCurrency": "AED",
                "priceValidUntil": "2025-12-31"
            },
            "itemCondition": "https://schema.org/NewCondition",
            "model": "{{$car->model ? $car->model->title : 'Model'}}",
            "brand": "{{$car->brand ? $car->brand->title : 'Brand'}}",
            "aggregateRating": {
                "@type": "AggregateRating",
                "ratingValue": "5",
                "ratingCount": "5"
            },
            "review": [
                {
                    "@type": "Review",
                     "author": {
                        "@type": "Organization",
                        "name": "Tajeer"
                    },
                    "datePublished": "{{date('Y-m-d')}}",
                    "reviewBody": "{{$car->getDescription()}}",
                    "name": "{{$car->name}}",
                    "reviewRating": {
                        "@type": "Rating",
                        "bestRating": "5",
                        "ratingValue": "5",
                        "worstRating": "1"
                    }
                }
            ],
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "{{app('settings')->get('footer_address')}}",
                "addressLocality": "Dubai",
                "postalCode": "00000",
                "addressCountry": "AE"
              },
              "vehicleConfiguration": "ST",
              "vehicleEngine": {
                "@type": "EngineSpecification",
                "fuelType": "Gasoline"
              },
             "vehicleTransmission": "Automatic",
             "vehicleInteriorColor": "{{ $car?->color?->title ?? 'White' }}",
              "numberOfDoors": {{ $car?->doors ?? 2 }},
              "bodyType": "Pickup",
              "vehicleInteriorType": "Standard",
              "driveWheelConfiguration": "https://schema.org/FourWheelDriveConfiguration",
              "vehicleSeatingCapacity": {{ $car?->passengers ?? 2 }},
              "color": "{{ $car?->color?->title ?? 'White' }}"
            }
        </script>
@endsection
