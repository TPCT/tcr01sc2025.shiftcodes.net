@extends('website::layouts.master')
@section('seo')
    @include('website::layouts.parts.seo', [
        'seo' => \App\Models\SEO::where('type', 'contact-us')->first(),
        "title" => __('lang.Contact Us'),
        "image" => secure_url('/') . '/storage/'. app('settings')->get('header_logo')
    ])
@endsection
@section("content")

    @include('website::layouts.parts.page-banner', [
        "title" => __('lang.Contact Us')
    ])

    <section>
        <div class="container">

            @if(session('success'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <!-- <div class="col-lg-12">
                    <div class="contact_header">
                        <h3>An extensive collection of vehicles to choose from.</h3>
                        <p>Various types of cars are available for rent at tajeercarrent.com. Choose from hundreds of vehicles available for rent, ranging from the luxurious Bugatti, Mercedes, Lamborghini, Ferrari, Rolls Royce</p>
                    </div>
                </div> -->
            </div>
            <div class="row map-bg">
                <div class="col-lg-3">
                    <div class="contact__box_item">
                        <i class="fa fa-map-marker"></i>
                        <h4>{{__('lang.Head Office')}}</h4>
                        <p>{{app('settings')->get('footer_address')}}</p>
                    </div>
                </div>
                <div class="col-lg-3"></div>
                <div class="col-lg-3"></div>
                <div class="col-lg-3">
                    <a href="tel:{{str_replace(' ', '', app('settings')->get('contact_phone') )}}">
                        <div class="contact__box_item">
                            <i class="fa fa-phone"></i>
                            <h4>{{__('lang.Phone')}}</h4>
                            <p>
                                {{app('settings')->get('contact_phone')}}
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3"></div>
                <div class="col-lg-3">
                <a href="https://wa.me/{{str_replace(' ', '', app('settings')->get('contact_whatsapp') )}}">

                    <div class="contact__box_item contact__box_mt">
                        <i class="fa fa-whatsapp"></i>
                        <h4>{{__('lang.Whatsapp')}}</h4>
                        <p>
                            {{app('settings')->get('contact_whatsapp')}}

                        </p>
                    </div>
                    </a>
                </div>


                <div class="col-lg-3">
                <a href="mailto:{{app('settings')->get('contact_email')}}">
                    <div class="contact__box_item contact__box_mt">
                        <i class="fa fa-envelope"></i>
                        <h4>{{__('lang.Email')}}</h4>
                        <p>

                            {{app('settings')->get('contact_email')}}

                        </p>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
    </section>

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
