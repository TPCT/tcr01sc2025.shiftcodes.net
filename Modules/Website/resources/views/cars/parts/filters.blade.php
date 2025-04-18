
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
            <div class="form-group search-filter-keyword">
                <input value="{{request()->get('search')}}" type="text" name="search" class="form-control" placeholder="{{__('lang.Search here')}}">

            </div>
            <div class="form-group">
                <select class="form-control select-brand" name="brand">
                    <option value="">{{__('lang.Brand')}}</option>
                    @foreach(\App\Models\Brand::all() as $brand)
                        <option @selected(request()->get('brand') == $brand->slug || (isset($resource_type) && $resource_type == "brand" && $resource->slug == $brand->slug)) value="{{$brand->slug}}">{{$brand->title}}</option>
                    @endforeach
                </select>
            </div>
            @if(request()->get('brand') || (isset($resource_type) && $resource_type == "brand") || (isset($resource_sub_type) && $resource_sub_type === "models"))
                <div class="form-group">
                    @if ($brand = request()->get('brand'))
                        <select class="form-control select-model" name="model">
                            <option value="">{{__('lang.Model')}}</option>
                            @foreach(\App\Models\Models::where('brand_id', \App\Models\Brand::whereSlug($brand)->first()->id)->get() as $model)
                                <option @selected(request()->get('model') == $model->slug) value="{{$model->slug}}">{{$model->title}}</option>
                            @endforeach
                        </select>
                    @elseif(isset($resource) && $resource_type == "brand")
                        <select class="form-control select-model" name="model">
                            <option value="">{{__('lang.Model')}}</option>
                            @foreach(\App\Models\Models::where('brand_id', $resource->id)->get() as $model)
                                <option @selected(request()->get('model') == $model->slug) value="{{$model->slug}}">{{$model->title}}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
            @endif
            <div class="form-group">
                <select class="form-control" name="year">
                    <option value="">{{__('lang.Year')}}</option>
                    @foreach(\App\Models\Year::all() as $year)
                        <option @selected(request()->get('year') == $year->title) value="{{$year->title}}">{{$year->title}}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group">
                <select class="form-control" name="color">
                    <option value="">{{__('lang.Color')}}</option>
                    @foreach(\App\Models\Color::all() as $color)
                        <option @selected(request()->get('color') == $color->slug) value="{{$color->slug}}">{{$color->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group type__filter">
                <p>{{__("lang.Type")}}</p>
                <ul>
                    @foreach(\App\Models\Type::whereNotIn('slug', ['with-driver', 'yachts'])->get() as $type)
                        <li @if(in_array($type->slug, $selected_types)) class="active" @endif>
                            <input @checked(in_array($type->slug, $selected_types)) type="checkbox" name="types[]" value="{{$type->slug}}">
                            {{$type->title}}
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="price-range-container">
                <h3 class="text-start">@lang('lang.PRICE RANGE')</h3>
                <div class="slider-wrapper">
                    <div class="slider-track"></div>
                    <input type="range" id="minRange" min="0" max="{{$max_price}}" value="{{request('min_price', 0)}}" step="100" name="min_price">
                    <input type="range" id="maxRange" min="100" max="{{$max_price}}" value="{{request('max_price', $max_price)}}" step="100" name="max_price">
                </div>
                <div class="price-values">
                    <span id="minValue">{{0}} {{app('currencies')->getCurrency()->code}}</span>
                    <span id="maxValue">{{$max_price}} {{app('currencies')->getCurrency()->code}}</span>
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
                "{{secure_url('/')}}/storage/{{\App\Helpers\WebpImage::generateUrl($car->image)}}"
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

<script>
const minRange = document.getElementById("minRange");
const maxRange = document.getElementById("maxRange");
const minValueDisplay = document.getElementById("minValue");
const maxValueDisplay = document.getElementById("maxValue");
const track = document.querySelector(".slider-track");

minRange.addEventListener("input", updateRange);
maxRange.addEventListener("input", updateRange);

function updateRange() {
    let minVal = parseInt(minRange.value);
    let maxVal = parseInt(maxRange.value);

    if (minVal >= maxVal) {
        minRange.value = maxVal - 100;
        minVal = maxVal - 100;
    }

    minValueDisplay.textContent = `{{app('currencies')->getCurrency()->code}} ${minVal.toLocaleString()}`;
    maxValueDisplay.textContent = `{{app('currencies')->getCurrency()->code}} ${maxVal.toLocaleString()}`;

    // Update track color between the two handles
    let minPercent = ((minVal - 0) / ({{$max_price}} - 0)) * 100;
    let maxPercent = ((maxVal - 0) / ({{$max_price}} - 0)) * 100;
    track.style.background = `linear-gradient(to right, #ddd ${minPercent}%, #A2E2FF ${minPercent}%, #A2E2FF ${maxPercent}%, #ddd ${maxPercent}%)`;
}

// Initialize track color
updateRange();

</script>