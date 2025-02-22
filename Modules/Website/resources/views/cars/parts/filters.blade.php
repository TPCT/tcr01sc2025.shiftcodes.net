
    <div class="search-banner-field filter-main-search">
        <div class="search-banner-field__input">
            <i class="fa fa-search"></i>
            <input name="search" placeholder="{{__('lang.Search here')}}" value="{{request()->get('search')}}" type="text" class="form-control search-cars"/>
        </div>
        <div class="search-banner-field__btn">
            <button class="toggle-search">
                <img loading="lazy" width="28" height="28" alt="left" src="{{secure_url('/')}}/website/images/icons/left.webp"/>
                {{__('lang.Filter Search')}}

            </button>
        </div>
    </div>
    <div class="search__filter_toggler">
        <i class="fa fa-filter"></i>
        <span>{{__('lang.Filter')}}</span>
    </div>
    <div class="products-page__filter">
        <i class="fa fa-times close-fixed-filter"></i>
        <div class="products-page__filter_header">
            <h2>{{__('lang.Filter')}}</h2>
            <p>{{__('lang.SEARCH YOUR CAR')}}</p>
        </div>
        <div class="products-page__filter_body">
            <div class="form-group search-filter-keywoard">
                <input value="{{request()->get('search')}}" type="text" name="search" class="form-control" placeholder="{{__('lang.Search here')}}">

            </div>
            <div class="form-group">
                <select class="form-control select-brand" name="brand_id">
                    <option value="">{{__('lang.Brand')}}</option>
                    @foreach(\App\Models\Brand::all() as $brand)
                        <option @if(request()->get('brand_id') == $brand->id) selected @endif value="{{$brand->id}}">{{$brand->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <select class="form-control select-model" name="model_id">
                    <option value="">{{__('lang.Model')}}</option>
                    @if(request()->get('brand_id'))
                        @foreach(\App\Models\Models::where('brand_id', request()->get('brand_id'))->get() as $model)
                            <option @if(request()->get('model_id') == $model->id) selected @endif value="{{$model->id}}">{{$model->title}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <select class="form-control" name="year_id">
                    <option value="">{{__('lang.Year')}}</option>
                    @foreach(\App\Models\Year::all() as $year)
                        <option @if(request()->get('year_id') == $year->id) selected @endif value="{{$year->id}}">{{$year->title}}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group">
                <select class="form-control" name="color_id">
                    <option value="">{{__('lang.Color')}}</option>
                    @foreach(\App\Models\Color::all() as $color)
                        <option @if(request()->get('color_id') == $color->id) selected @endif value="{{$color->id}}">{{$color->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group type__filter">
                <p>{{__("lang.Type")}}</p>
                <ul>
                    @foreach(\App\Models\Type::all() as $type)
                        <li @if(in_array($type->id, $selected_types)) class="active" @endif>
                            <input @if(in_array($type->id, $selected_types)) checked @endif type="checkbox" name="type_id[]" value="{{$type->id}}">
                            {{$type->title}}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="form-group filter__price">
                <p>{{__('lang.PRICE RANGE')}}</p>
                <div id="price-range"></div>
                <div class="row">
                    <div class="col-lg-6">
                        <input id="input-with-keypress-0" class="form-control" type="text" name="min_price">
                    </div>
                    <div class="col-lg-6">
                        <input id="input-with-keypress-1" class="form-control" type="text" name="max_price">
                    </div>
                </div>
            </div>
            <div class="form-group filter__submit">
                <button>{{__('lang.Find Car')}}</button>
            </div>
        </div>
    </div>


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
                "{{secure_url('/')}}/storage/{{$car->image}}"
            ],
            "url": "{{LaravelLocalization::localizeUrl("/{$car->id}/{$car->slug}")}}",
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
