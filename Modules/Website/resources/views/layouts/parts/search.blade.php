    <section class="search-banner">
        <img class="search-image" alt="search" src="{{ asset("/website/images/search_bg.webp") }}">
        <form action="/search" method="get">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="search-banner-field">
                            <div class="search-banner-field__input">
                                <i class="fa fa-search"></i>
                                <input name="search" placeholder="{{__('lang.Search here')}}" type="text" class="form-control search-cars"/>
                                <div class="search__result">
                                    <ul>

                                    </ul>
                                </div>
                            </div>
                            <div class="search-banner-field__btn">
                                <button>
                                    <img loading="lazy" width="28" height="28" alt="left" src="{{asset("/website/images/icons/left.webp")}}"/>
                                    {{__('lang.View all cars')}}

                                </button>
                            </div>
                        </div>

                        <ul class="search-social">
                            <li>
                                <a href="{{app('settings')->get('app_google_play')}}">
                                    <img width="125" height="37" alt="app" class="apps-image" src="{{asset("/website/images/icons/googleplay.webp")}}" />
                                </a>
                            </li>
                            <li>
                                <a href="{{app('settings')->get('app_apple_store')}}">
                                    <img alt="app" width="115" height="41"  class="apps-image" src="{{asset("/website/images/icons/appstore2.webp")}}" />
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </form>
    </section>
