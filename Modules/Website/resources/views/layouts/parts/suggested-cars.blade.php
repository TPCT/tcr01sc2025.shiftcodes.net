@if(count($suggested_cars) > 0)
    <section class="home__features">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="home__brands_title">
                        <h3>{{__('lang.Suggested Car Rental')}}</h3>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div data-stage="15" data-items-large="3" data-items-small="1"  class="home__features_content owl-carousel owl-theme">
                        @foreach($suggested_cars as $car)
                            @include('website::layouts.parts.car', ['car' => $car])
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>
@endif
