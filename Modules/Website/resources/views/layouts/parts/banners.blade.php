    @if(count($banners) > 0)
    <section class="home__banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div data-is-autoplay="true" data-is-loop="yes" data-items-large="1" data-items-small="1"  class="home__features_content home__rental_companies owl-carousel owl-theme">
                        @foreach($banners as $item)
                        <a href="{{ $item->company ? LaravelLocalization::localizeUrl("/c/{$item->company->id}/{$item->company->slug}") : $item->link}}">
                            <div class="home__banner_item">
                                <img width="1100" height="300" alt="{{$item->id}}" src="{{asset("/storage/") . "/" . \App\Helpers\WebpImage::generateUrl($item->image)}}" />
                            </div>
                        </a>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
