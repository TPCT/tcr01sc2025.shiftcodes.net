@extends('website::layouts.master')
@section('seo')
    @include('website::layouts.parts.seo', [
        'seo' => \App\Models\SEO::where('type','section')->where('resource_id', $section->id)->first(),
        "title" => $section->title,
        "image" => secure_url('/') . '/storage/'. app('settings')->get('header_logo')
    ])
@endsection
@section("content")

<section class="products-page">
        <div class="container">
            <div class="row">

                @include('website::cars.parts.breadcrumb',[
                    "title_1" => $section->title,
                    "title_2" => ""
                ])

                @include('website::layouts.parts.page-title',[
                    "title"       => $section->title,
                    "description" => $section->description
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


    @include('website::layouts.parts.content', [
        "content" => \App\Models\Content::where('type','section')->where('resource_id', $section->id)->first()
    ])

    @include('website::layouts.parts.faq', [
        "faq" => \App\Models\Faq::where('type','section')->where('resource_id', $section->id)->get()
    ])

@endsection
