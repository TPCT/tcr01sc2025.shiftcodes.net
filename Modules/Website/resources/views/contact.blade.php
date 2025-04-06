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
                    <div class="contact__box_item contact__box_mt">
                        <i class="fa fa-map-marker"></i>
                        <h4>{{__('lang.Head Office')}}</h4>
                        <p>{{app('settings')->get('footer_address')}}</p>
                    </div>
                </div>
                <div class="col-lg-3"></div>
                <div class="col-lg-3"></div>
                <div class="col-lg-3">
                    <a href="tel:{{str_replace(' ', '', app('settings')->get('contact_phone') )}}">
                        <div class="contact__box_item contact__box_mt">
                        <svg id="phone-svgrepo-com_1_" data-name="phone-svgrepo-com (1)" xmlns="http://www.w3.org/2000/svg" width="15.457" height="15.457" viewBox="0 0 15.457 15.457">
  <g id="Group_2510" data-name="Group 2510" transform="translate(1.562 0)">
    <path id="Path_1041" data-name="Path 1041" d="M20.327,11.406a7.674,7.674,0,0,0-2.292-1.981c-.408-.233-.9-.259-1.133.156a9.3,9.3,0,0,1-.735.8,1.369,1.369,0,0,1-1.948-.193L12.739,8.712,11.26,7.233a1.369,1.369,0,0,1-.193-1.948,9.3,9.3,0,0,1,.8-.735c.414-.233.389-.725.156-1.133a7.674,7.674,0,0,0-1.981-2.292,1.013,1.013,0,0,0-1.19.179L8.2,1.957C6.129,4.029,7.149,6.369,9.222,8.442l1.894,1.894L13.01,12.23c2.072,2.072,4.412,3.093,6.485,1.02l.654-.654A1.014,1.014,0,0,0,20.327,11.406Z" transform="translate(-6.808 -0.747)" fill="#3e1f50"/>
    <path id="Path_1042" data-name="Path 1042" d="M16.279,13.9a3.68,3.68,0,0,1-.83-.1,7.369,7.369,0,0,1-3.366-2.133L8.294,7.876A7.37,7.37,0,0,1,6.161,4.51,3.572,3.572,0,0,1,7.274,1.027L7.927.374A1.264,1.264,0,0,1,9.42.149,7.774,7.774,0,0,1,11.5,2.539a1.274,1.274,0,0,1,.168.962.855.855,0,0,1-.4.514,8.54,8.54,0,0,0-.739.668A1.115,1.115,0,0,0,10.7,6.3l2.959,2.959a1.116,1.116,0,0,0,1.622.162,8.632,8.632,0,0,0,.668-.739.855.855,0,0,1,.514-.4,1.27,1.27,0,0,1,.959.166,7.782,7.782,0,0,1,2.392,2.084h0a1.264,1.264,0,0,1-.225,1.493l-.654.653A3.7,3.7,0,0,1,16.279,13.9ZM8.825.516a.754.754,0,0,0-.533.222l-.653.654a3.05,3.05,0,0,0-.976,3,6.881,6.881,0,0,0,2,3.118L12.447,11.3a6.882,6.882,0,0,0,3.118,2,3.054,3.054,0,0,0,3-.976l.654-.653a.752.752,0,0,0,.134-.888h0A7.155,7.155,0,0,0,17.159,8.9a.79.79,0,0,0-.563-.116.346.346,0,0,0-.215.176L16.354,9a7.6,7.6,0,0,1-.789.852,1.625,1.625,0,0,1-2.275-.224L10.332,6.667a1.752,1.752,0,0,1-.558-1.519,1.782,1.782,0,0,1,.334-.755A7.6,7.6,0,0,1,10.96,3.6L11,3.577a.347.347,0,0,0,.176-.215.793.793,0,0,0-.118-.566A7.481,7.481,0,0,0,9.18.6.76.76,0,0,0,8.825.516Z" transform="translate(-6.063 0)" fill="#3e1f50"/>
  </g>
  <path id="Path_1043" data-name="Path 1043" d="M37.157,37.744H37.13a5.378,5.378,0,0,1-2.988-1.361.258.258,0,0,1,.361-.367,4.94,4.94,0,0,0,2.679,1.215.258.258,0,0,1-.026.514Z" transform="translate(-25.29 -26.683)" fill="#3e1f50"/>
  <path id="Path_1044" data-name="Path 1044" d="M18.868,17.289a.256.256,0,0,1-.164-.059,4.92,4.92,0,0,1-1.638-3.006.258.258,0,1,1,.513-.053,4.472,4.472,0,0,0,1.453,2.661.258.258,0,0,1-.165.456Z" transform="translate(-12.669 -10.35)" fill="#3e1f50"/>
  <path id="Path_1045" data-name="Path 1045" d="M.257,51.1a.263.263,0,0,1-.074-.011.258.258,0,0,1-.173-.321l.675-2.25a.36.36,0,0,1,.689,0L1.8,49.943l.428-1.427a.36.36,0,0,1,.689,0l.428,1.427.428-1.427a.36.36,0,0,1,.689,0l.428,1.427.428-1.427a.36.36,0,0,1,.689,0l.428,1.427.428-1.427a.36.36,0,0,1,.689,0l.233.776a1.81,1.81,0,0,0,3.544-.52v-.508a.258.258,0,0,1,.515,0v.508A2.325,2.325,0,0,1,7.3,49.44l-.084-.28-.428,1.427a.36.36,0,0,1-.689,0L5.667,49.16l-.428,1.427a.36.36,0,0,1-.689,0L4.121,49.16l-.428,1.427a.36.36,0,0,1-.689,0L2.576,49.16l-.428,1.427a.36.36,0,0,1-.689,0L1.03,49.16.5,50.913A.258.258,0,0,1,.257,51.1Z" transform="translate(0 -35.64)" fill="#3e1f50"/>
</svg>

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
