@extends('website::layouts.master')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/nouislider@14.6.3/distribute/nouislider.min.css" rel="stylesheet">
@endsection
@section('seo')
    @include('website::layouts.parts.seo', [
        'seo' => \App\Models\SEO::where('type', 'city')->where('resource_id', $city->id)->first(),
        "title" => $city->page_title ?? $city->title,
        "image" => secure_url('/') . '/storage/'. app('settings')->get('header_logo')
    ])
@endsection

@section("content")
    <section class="products-page">
        <div class="container">
            <div class="row">
                @include('website::cars.parts.breadcrumb',[
                    "title_1" => __('lang.City'),
                    "title_2" => $city->title
                ])

                @include('website::layouts.parts.page-title',[
                    "title" => $city->page_title ?? $city->title,
                    "description" => $city->page_description
                ])
            </div>

            <form action="{{secure_url('/')}}/{{\Request::path()}}" method="get">

                <div class="row mt-50">

                    <div class="col-lg-3">
                        @include('website::cars.parts.filters')
                    </div>

                    <div class="col-lg-9">

                        <div class="products-page__sort_by_holder">
                            <div class="products-page__sort_by">
                                <span>{{__('lang.Sort By')}} </span>
                                <select class="form-control order-by" name="order_by">
                                    <option @if(!request()->get('order_by')) selected @endif value="">{{__('lang.Latest')}}</option>
                                    <option @if(request()->get('order_by') == "price_low") selected @endif value="price_low">{{__('lang.Price Low')}}</option>
                                    <option @if(request()->get('order_by') == "price_high") selected @endif value="price_high">{{__('lang.Price High')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="products-page__content">
                            @foreach($cars as $car)
                                @include('website::cars.parts.car', ['car' => $car])
                            @endforeach
                        </div>

                        <div class="col-12">
                            {{$cars->appends(request()->input())->links()}}
                        </div>

                    </div>

                </div>
            </form>

        </div>
    </section>

    @include('website::layouts.parts.content', [
        "content" => \App\Models\Content::where('type','city')->where('resource_id', $city->id)->first()
    ])

    @include('website::layouts.parts.faq', [
        "faq" => \App\Models\Faq::where('type','city')->where('resource_id', $city->id)->get()
    ])

@endsection
@section('js')
<script>
        var slider = document.getElementById('price-range');

        noUiSlider.create(slider, {
            start: [{{request()->get('min_price') ? request()->get('min_price') : 1}}, {{request()->get('max_price') ? request()->get('max_price') : 10000}}],
            connect: true,
            range: {
                'min': 1,
                'max': 10000
            }
        });

        // Get the input fields
        var input0 = document.getElementById('input-with-keypress-0');
        var input1 = document.getElementById('input-with-keypress-1');

        // When the slider value changes, update the input and span
        slider.noUiSlider.on('update', function (values, handle) {
            if (handle) {
                input1.value = values[handle];
            } else {
                input0.value = values[handle];
            }
        });
    </script>
@endsection
@section('libs')
<script  src="https://cdn.jsdelivr.net/npm/nouislider@14.6.3/distribute/nouislider.min.js"></script>
@endsection
