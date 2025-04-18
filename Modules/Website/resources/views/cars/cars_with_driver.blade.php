@extends('website::layouts.master')

@section('seo')
    @include('website::layouts.parts.seo', [
        'seo' => \App\Models\SEO::where('type','driver')->first(),
        "title" => app('settings')->get('driver_title'),
        "image" => secure_url('/') . '/storage/'. app('settings')->get('header_logo')
    ])
@endsection

@section("content")

<section class="products-page">
        <div class="container">
            <div class="row">

                @include('website::cars.parts.breadcrumb',[
                    "title_1" => app('settings')->get('driver_title'),
                    "title_2" => ""
                ])

                @include('website::layouts.parts.page-title',[
                    "title"       =>  app('settings')->get('driver_title'),
                    "description" =>  app('settings')->get('driver_description')
                ])


            </div>


                <div class="row mt-50">

                    <div class="col-lg-12">


                        <div class="products-page__content">
                            <div class="row">
                                @foreach($cars as $car)
                                    <div class="col-lg-4 mb-3">
                                        @include('website::layouts.parts.car', ['car' => $car, 'class' => 'card_type_1'])
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                    <div class="col-12">
                        {{$cars->appends(request()->input())->links()}}
                    </div>

                </div>


        </div>
    </section>


    @include('website::layouts.parts.content', [
        "content" => \App\Models\Content::where('type','driver')->first()
    ])

    @include('website::layouts.parts.faq', [
        "faq" => \App\Models\Faq::where('type','driver')->get()
    ])


@endsection

@section('schemes')
        @if(count($cars) > 0)
            @foreach($cars as $car)
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
            @endforeach
        @endif

    @endsection
