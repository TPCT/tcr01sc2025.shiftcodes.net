@extends('website::layouts.master')
@section('seo')
    @include('website::layouts.parts.seo', [
        'seo' => \App\Models\SEO::where('type','yacht')->first(),
        "title" => app('settings')->get('yacht_title'),
        "image" => secure_url('/') . '/storage/'. app('settings')->get('header_logo')
    ])
@endsection
@section("content")

<section class="products-page">
        <div class="container">
            <div class="row">

                @include('website::cars.parts.breadcrumb',[
                    "title_1" => app('settings')->get('yacht_title'),
                    "title_2" => ""
                ])

                @include('website::layouts.parts.page-title',[
                    "title"       => app('settings')->get('yacht_title'),
                    "description" => app('settings')->get('yacht_description')
                ])


            </div>


                <div class="row mt-50">

                    <div class="col-lg-12">


                        <div class="products-page__content">
                            <div class="row">
                                @foreach($yachts as $yacht)
                                    <div class="col-lg-4 mb-3">
                                        @include('website::yachts.parts.yacht', ['yacht' => $yacht])
                                    </div>
                                    @endforeach
                            </div>
                        </div>

                    </div>

                    <div class="col-12">
                        {{$yachts->appends(request()->input())->links()}}
                    </div>

                </div>


        </div>
    </section>


    @include('website::layouts.parts.content', [
        "content" => \App\Models\Content::where('type','yacht')->first()
    ])

    @include('website::layouts.parts.faq', [
        "faq" => \App\Models\Faq::where('type','yacht')->get()
    ])




@endsection

@section('schemes')
        @if(count($yachts) > 0)
            @foreach($yachts as $yacht)
                <script type="application/ld+json">{
            "@context": "https://schema.org",
            "@type": ["AutoRental","Product", "Yacht"],
            "name": "{{$yacht->name}}",
            "telephone": "{{app('settings')->get('contact_phone')}}",
             "priceRange": "AED 100-60000",
            "vehicleIdentificationNumber": "{{substr(md5($yacht->id) , 0 , 17)}}",
            "vehicleModelDate": "{{$yacht->year ? $yacht->year->title : '2021'}}",
            "image": [
                "{{secure_url('/')}}/storage/{{\App\Helpers\WebpImage::generateUrl($yacht->image)}}"
            ],
            "url": "{{secure_url('/')}}/{{$yacht->id}}/{{$yacht->slug}}",
            "offers": {
                "@type": "Offer",
                "availability": "https://schema.org/InStock",
                "price": "{{ isset($yacht->price_per_day) && $yacht->price_per_day > 0 ? $yacht->price_per_day   : 100}}",
                "priceCurrency": "AED",
                "priceValidUntil": "2025-12-31"
            },
            "itemCondition": "https://schema.org/NewCondition",
            "model": "{{$yacht->model ? $yacht->model->title : 'Model'}}",
            "brand": "{{$yacht->brand ? $yacht->brand->title : 'Brand'}}",
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
                    "reviewBody": "{{$yacht->getDescription()}}",
                    "name": "{{$yacht->name}}",
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
             "vehicleInteriorColor": "{{ $yacht?->color?->title ?? 'White' }}",
              "numberOfDoors": {{ $yacht?->doors ?? 2 }},
              "bodyType": "Pickup",
              "vehicleInteriorType": "Standard",
              "driveWheelConfiguration": "https://schema.org/FourWheelDriveConfiguration",
              "vehicleSeatingCapacity": {{ $yacht?->passengers ?? 2 }},
              "color": "{{ $yacht?->color?->title ?? 'White' }}"
            }
                </script>
            @endforeach
        @endif

    @endsection
