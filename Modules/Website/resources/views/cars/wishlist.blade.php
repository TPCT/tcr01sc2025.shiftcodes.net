@extends('website::layouts.master')
@section('seo')
    @include('website::layouts.parts.seo', [
        'seo' => \App\Models\SEO::where('type','home')->first(),
        "title" => __('lang.Wishlist'),
        "image" => secure_url('/') . '/storage/'. app('settings')->get('header_logo')
    ])
@endsection
@section("content")

<section class="products-page">
        <div class="container">
            <div class="row">

                @include('website::cars.parts.breadcrumb',[
                    "title_1" => __('lang.Wishlist'),
                    "title_2" => ""
                ])

                @include('website::layouts.parts.page-title',[
                    "title"       => __('lang.Wishlist'),
                    "description" => 'Check your wishlist cars'
                ])


            </div>


                <div class="row mt-50">

                    <div class="col-lg-12">


                        <div class="products-page__content">
                            <div class="row">
                                @foreach($cars as $car)
                                    <div class="col-lg-4">
                                        @include('website::layouts.parts.car', ['car' => $car])
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                    <div class="col-12">
                        {{$cars->appends(request()->input())->links()}}
                    </div>

                </div>


        </div>
    </section>




@endsection
