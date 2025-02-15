@extends('website::layouts.master')
@section('seo')
    @include('website::layouts.parts.seo', [
        "seo" => \App\Models\SEO::where('type', 'blog')->whereNull('resource_id')->first(),
        "title" => app('settings')->get('blog_title'),
        "image" => secure_url('/') . '/storage/'. app('settings')->get('header_logo')
    ])
@endsection
@section("content")
    <section class="products-page">

        <!--<div class="container d-flex justify-content-center mt-50 mb-50">-->
        <div class="container">

            <div class="row">

                @include('website::cars.parts.breadcrumb', [
                    "title_1" => app('settings')->get('blog_title'),
                    "title_2" => ""
                ])

            </div>
            <div class="row mt-50">
                <div class="col-lg-12">

                    @foreach($blogs as $blog)


                <div class="card card-body">
                            <div class="media align-items-center align-items-lg-start  flex-column flex-lg-row">
                                <div class="mr-2 mb-3 mb-lg-0">
                                    <img src="{{asset("/storage/{$blog->image}")}}" width="150" height="150" alt="" style="max-height:150px;width:200px;">
                                </div>

                                <div class="media-body" style="padding:0px 20px;">
                                    <h6 class="media-title font-weight-semibold">
                                        <a href="{{LaravelLocalization::localizeUrl("blog-details/{$blog->id}")}}" data-abc="true">{{ $blog->title }}</a>
                                    </h6>

                                    <!--  text-center text-lg-left <ul class="list-inline list-inline-dotted mb-3 mb-lg-2">-->
                                    <!--    <li class="list-inline-item"><a href="#" class="text-muted" data-abc="true">Phones</a></li>-->
                                    <!--    <li class="list-inline-item"><a href="#" class="text-muted" data-abc="true">Mobiles</a></li>-->
                                    <!--</ul>-->

                                    <p class="mb-3" >{{ Str::limit(strip_tags($blog->content), 150) }} .....</p>
                                    <a href="{{LaravelLocalization::localizeUrl("blog-details/{$blog->id}")}}" class="btn mt-4 text-white" style="background:#564b89"><i class="icon-cart-add mr-2"></i> {{ __('lang.Read More') }}</a>


                                    <!--<ul class="list-inline list-inline-dotted mb-0">-->
                                    <!--    <li class="list-inline-item">All items from <a href="#" data-abc="true">Mobile point</a></li>-->
                                    <!--    <li class="list-inline-item">Add to <a href="#" data-abc="true">wishlist</a></li>-->
                                    <!--</ul>-->
                                </div>

                                <!--<div class="mt-3 mt-lg-0 ml-lg-3 text-center">-->

                                <!--    <button type="button" class="btn mt-4 text-white" style="background:#564b89"><i class="icon-cart-add mr-2"></i> Read More</button>-->
                                <!--</div>-->
                            </div>
                        </div>

    <!--    </div>                     -->
    <!--    </div>-->
    <!--</div>-->

                    @endforeach

                </div>
                <div class="col-lg-12">
                    {{$blogs->links()}}
                </div>
            </div>

        </div>
         <div class="row">
           @include('website::layouts.parts.suggested-cars', [
                "suggested_cars" => $suggested_cars
            ])
        </div>
    </section>
@endsection
