@extends('website::layouts.master')
@section('seo')
    @include('website::layouts.parts.seo', [
        'seo' => \App\Models\SEO::where('type','listcar')->first(),
        "title" => __('lang.List Your Car'),
        "image" => secure_url('/') . '/storage/'. app('settings')->get('header_logo')
    ])
@endsection
@section("content")


    @include('website::layouts.parts.page-banner',[
        "title" => __('lang.List Your Car')
    ])

    @if(session('success'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                </div>
            </div>
    @endif

    @include('website::layouts.parts.content', [
        "content" => \App\Models\Content::where('type','listcar')->first()
    ])



    @include('website::layouts.parts.faq', [
        "faq" => \App\Models\Faq::where('type','listcar')->get()
    ])


    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact_map">
                    {!!app('settings')->get('map')!!}
                    </div>
                </div>
                <div class="col-lg-6">
                    <form action="/contact" method="post">
                        @csrf
                        <div class="contact__form">
                            <h3>{{__('lang.Send us message')}}</h3>
                            <div class="form-group">
                                <label>{{__('lang.Name')}}</label>
                                <input type="text" name="name" required class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>{{__('lang.Email')}}</label>
                                <input type="email" name="email" required class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>{{__('lang.Phone')}}</label>
                                <input type="text" name="phone" required class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>{{__('lang.Message')}}</label>
                                <textarea class="form-control" name="message" required></textarea>
                            </div>
                            <div class="form-group">
                                <button>{{__('lang.Send Message')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


@endsection
