    <div class="product__vertical product__horizontal">

        <div class="product__vertical_top">

            <div class="product__vertical_meta">
                @if($car->is_refresh)
                    <span class="bg-blue">{{__('lang.Featured')}}</span>
                @endif
                <span class="bg-orange">{{__('lang.Verified')}}</span>
                <span class="wishlist wishlist-toggle" data-auth="{{auth()->guard('customers')->check() ? 1 : 0}}" data-id="{{$car->id}}">{{__('lang.Save to wishlist')}}</span>

            </div>
            <a aria-label="{{$car->name}}" href="{{ LaravelLocalization::getLocalizedUrl(null, route('website.cars.show', ['car' => $car])) }}">
                <img alt="{{$car->name}}" src="{{ asset("/storage/") . "/" . \App\Helpers\WebpImage::generateUrl($car->image) }}"/>
            </a>
        </div>
        <div class="product__vertical_bottom">
            <a aria-label="{{$car->name}}" href="{{ LaravelLocalization::getLocalizedUrl(null, route('website.cars.show', ['car' => $car])) }}">
                <h2>{{$car->name}} </h2>
            </a>
            <div class="product__vertical_bottom_features">
                <ul>

                    @if($car->type == "yacht")

                        <li>{{$car->type == "default" ? __('lang.Day') : __('lang.Hour')}} / {{app('currencies')->convert($car->price_per_day)}} {{app('currencies')->getCurrency()->code}}</li>

                        @if($car->price_per_week)
                        <li>
                            @if(!$car->price_per_week) <s> @endif
                            {{$car->type == "default" ? __('lang.Week') : "3 " . __('lang.Hours')}} / {{app('currencies')->convert($car->price_per_week)}} {{app('currencies')->getCurrency()->code}}
                            @if(!$car->price_per_week) </s> @endif
                        </li>
                        @endif

                        @if($car->price_per_month)
                        <li>
                            @if(!$car->price_per_month) <s> @endif
                            {{$car->type == "default" ? __('lang.Month') : "8 " . __('lang.Hours')}} / {{app('currencies')->convert($car->price_per_month)}} {{app('currencies')->getCurrency()->code}}
                            @if(!$car->price_per_month) </s> @endif
                        </li>
                        @endif

                        <li>
                        {{$car->type == 'default' ? __('lang.Minimum of Days') : __('lang.Minimum of Hours') }} / {{$car->minimum_day_booking}}</li>

                        <li>{{$car->type == 'yacht' ? __('lang.Guests')  : __('lang.Passengers')}} / {{$car->passengers}}</li>

                    @else

                        <li>{{__('lang.Minimum of Days')}} / {{$car->minimum_day_booking}}</li>
                        <li>{{__('lang.Deposit')}} / {{app('currencies')->convert($car->security_deposit)}} {{app('currencies')->getCurrency()->code}}</li>
                        <li>

                            {{__('lang.KM Limit Day')}} / {{$car->km_per_day ? $car->km_per_day : 250}}

                        </li>
                        @if($car->km_per_month)
                        <li>

                            {{__('lang.KM Limit Month')}} / {{$car->km_per_month ? $car->km_per_month : 0}}

                        </li>
                        @else
                        <li>{{__('lang.Insurance Type')}} / {{__('lang.Full')}} </li>
                        @endif

                    @endif
                </ul>

                <div class="cm-logo">
                    @if($car->company)
                    <a href="{{LaravelLocalization::localizeUrl("/c/{$car->company->id}/{$car->company->slug}")}}" class="flex-1 link">
                        <div class="home__brands_item">
                                <img loading="lazy" alt="{{$car->company->name . rand(0,999)}}" src="{{asset("/storage/") . "/" . \App\Helpers\WebpImage::generateUrl($car->company->image)}}"/>
                                <h3>{{$car->company->name}}</h3>
                        </div>
                    </a>
                    @endif
                </div>

                <div class="product__horizontal_right">
                    <div class="home__brands_item product__horizontal_fees">

                        @if($car->price_per_day)
                        <h3>
                            <span>{{$car->type == "default" ? __('lang.Day') : __('lang.Hour')}}</span>
                            <span>{{app('currencies')->convert($car->price_per_day)}} {{app('currencies')->getCurrency()->code}}</span>
                        </h3>
                        @endif

                       @if(!$car->price_per_week) <s> @endif
                            <h3>
                                <span>{{$car->type == "default" ? __('lang.Week') : "3 " . __('lang.Hours')}}</span>
                                <span>

                                        {{app('currencies')->convert($car->price_per_week)}} {{app('currencies')->getCurrency()->code}}

                                </span>
                            </h3>
                        @if(!$car->price_per_week) </s> @endif


                        @if(!$car->price_per_month) <s> @endif
                        <h3>
                            <span>{{$car->type == "default" ? __('lang.Month') : "8 " . __('lang.Hours')}}</span>
                            <span>

                                {{app('currencies')->convert($car->price_per_month)}} {{app('currencies')->getCurrency()->code}}

                            </span>
                        </h3>
                        @if(!$car->price_per_month) </s> @endif

                    </div>

                </div>

            </div>
            <div class="product__vertical_actions">
                <ul>
                    @include('website::layouts.parts.car-actions', ['car' => $car])
                </ul>
            </div>
        </div>

    </div>
