    <section class="search-banner">
        <img class="search-image" alt="search" src="{{ asset("/website/images/search_bg.webp") }}">
        <form action="{{LaravelLocalization::getLocalizedURL(null, route('website.cars.filter'))}}" method="get">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="search-banner-field">
                            <div class="search-banner-field__input">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19.836" height="19.836" viewBox="0 0 19.836 19.836">
  <path id="_211818_search_icon" data-name="211818_search_icon" d="M84.136,82.632l-5.853-5.858a7.864,7.864,0,1,0-1.2,1.2l5.847,5.858ZM67.182,76.842A7.027,7.027,0,1,1,72.152,78.9,6.985,6.985,0,0,1,67.182,76.842Z" transform="translate(-64.3 -64)" fill="#3a1b50"/>
</svg>

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
