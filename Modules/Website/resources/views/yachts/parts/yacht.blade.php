    <div class="product__vertical">

        <div class="product__vertical_top">

            <div class="product__vertical_meta">
                @if($yacht->is_refresh)
                    <span class="bg-blue">{{__('lang.Featured')}}</span>
                @endif
                <span class="bg-orange">{{__('lang.Verified')}}</span>
                <span class="wishlist wishlist-toggle" data-auth="{{auth()->guard('customers')->check() ? 1 : 0}}" data-id="{{$yacht->id}}">{{__('lang.Save to wishlist')}}</span>

            </div>
            <a aria-label="{{$yacht->name}}" href="{{ LaravelLocalization::getLocalizedUrl(null, route('website.yachts.show', ['yacht' => $yacht])) }}">
                <img alt="{{$yacht->name}}" src="{{ asset("/storage/") . "/" . \App\Helpers\WebpImage::generateUrl($yacht->image) }}"/>
            </a>
        </div>
        <div class="product__vertical_bottom">
            <a aria-label="{{$yacht->name}}" href="{{ LaravelLocalization::getLocalizedUrl(null, route('website.yachts.show', ['yacht' => $yacht])) }}">
                <h2>{{$yacht->name}} </h2>
            </a>
            <div class="product__vertical_bottom_features">
                <ul>

                    @if($yacht->type == "yacht")

                        <li>{{$yacht->type == "default" ? __('lang.Day') : __('lang.Hour')}} / {{app('currencies')->convert($yacht->price_per_day)}} {{app('currencies')->getCurrency()->code}}</li>

                        @if($yacht->price_per_week)
                        <li>
                            @if(!$yacht->price_per_week) <s> @endif
                            {{$yacht->type == "default" ? __('lang.Week') : "3 " . __('lang.Hours')}} / {{app('currencies')->convert($yacht->price_per_week)}} {{app('currencies')->getCurrency()->code}}
                            @if(!$yacht->price_per_week) </s> @endif
                        </li>
                        @endif

                        @if($yacht->price_per_month)
                        <li>
                            @if(!$yacht->price_per_month) <s> @endif
                            {{$yacht->type == "default" ? __('lang.Month') : "8 " . __('lang.Hours')}} / {{app('currencies')->convert($yacht->price_per_month)}} {{app('currencies')->getCurrency()->code}}
                            @if(!$yacht->price_per_month) </s> @endif
                        </li>
                        @endif

                        <li>
                        {{$yacht->type == 'default' ? __('lang.Minimum of Days') : __('lang.Minimum of Hours') }} / {{$yacht->minimum_day_booking}}</li>

                        <li>{{$yacht->type == 'yacht' ? __('lang.Guests')  : __('lang.Passengers')}} / {{$yacht->passengers}}</li>

                    @else

                        <li>{{__('lang.Minimum of Days')}} / {{$yacht->minimum_day_booking}}</li>
                        <li>{{__('lang.Deposit')}} / {{app('currencies')->convert($yacht->security_deposit)}} {{app('currencies')->getCurrency()->code}}</li>
                        <li>

                            {{__('lang.KM Limit Day')}} / {{$yacht->km_per_day ? $yacht->km_per_day : 250}}

                        </li>
                        @if($yacht->km_per_month)
                        <li>

                            {{__('lang.KM Limit Month')}} / {{$yacht->km_per_month ? $yacht->km_per_month : 0}}

                        </li>
                        @else
                        <li>{{__('lang.Insurance Type')}} / {{__('lang.Full')}} </li>
                        @endif

                    @endif
                </ul>

                <div class="product__horizontal_right">
                    <div class="home__brands_item product__horizontal_fees">

                        @if($yacht->price_per_day)
                        <h3>
                            <span>{{$yacht->type == "default" ? __('lang.Day') : __('lang.Hour')}}</span>
                            <span>{{app('currencies')->convert($yacht->price_per_day)}} {{app('currencies')->getCurrency()->code}}</span>
                        </h3>
                        @endif

                       @if(!$yacht->price_per_week) <s> @endif
                            <h3>
                                <span>{{$yacht->type == "default" ? __('lang.Week') : "3 " . __('lang.Hours')}}</span>
                                <span>

                                        {{app('currencies')->convert($yacht->price_per_week)}} {{app('currencies')->getCurrency()->code}}

                                </span>
                            </h3>
                        @if(!$yacht->price_per_week) </s> @endif


                        @if(!$yacht->price_per_month) <s> @endif
                        <h3>
                            <span>{{$yacht->type == "default" ? __('lang.Month') : "8 " . __('lang.Hours')}}</span>
                            <span>

                                {{app('currencies')->convert($yacht->price_per_month)}} {{app('currencies')->getCurrency()->code}}

                            </span>
                        </h3>
                        @if(!$yacht->price_per_month) </s> @endif

                    </div>

                </div>

            </div>
            <div class="product__vertical_actions">
                <ul>
                    @include('website::layouts.parts.car-actions', ['car' => $yacht])
                </ul>
            </div>
        </div>

    </div>
