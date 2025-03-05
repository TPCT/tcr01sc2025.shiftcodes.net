@extends('website::layouts.master')
@section('seo')
    @include('website::layouts.parts.seo', [
        'seo' => \App\Models\SEO::where('type','home')->first(),
        "title" => __('lang.Phone Verification'),
        "image" => secure_url('/') . '/storage/'. app('settings')->get('header_logo')
    ])
@endsection
@section("content")




    <section class="">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">{{__('lang.Phone Verification')}}</h5>
                        </div>
                        <div class="card-body phone-body">
                            <form action="" method="post" id="phone-verify-form">
                                <p>{{__('lang.Please enter your phone number below')}}</p>

                                @csrf
                                <div class="form-group">
                                    <label for="code">{{__('lang.Enter your phone number')}}</label>
                                    <div class="phone-group">

                                        <select class="form-control"  id="phone-prefix" required>

                                            @foreach(\App\Models\Country::$countries_phones as $key => $country)
                                                <option @if($key == "971") selected @endif value="+{{$key}}">{{$country}}</option>
                                            @endforeach

                                        </select>
                                        <input type="number" required id="phone" class="form-control"  placeholder="{{__('lang.Enter your phone number')}}">

                                    </div>
                                </div>
                                <div id="recaptcha-container"></div>
                                <button  type="submit" id="sign-in-button" class="btn btn-primary">{{__('lang.Send Verification Code')}}</button>

                            </form>

                            <form action="#!" method="post" id="code-verify-form">
                                <p>{{__('lang.We sent a verification code to your phone')}}</p>

                                @csrf
                                <div class="form-group">
                                    <label for="code">{{__('lang.Enter the verification code')}}</label>


                                    <input type="number" required id="code" class="form-control"  placeholder="{{__('lang.Enter the verification code')}}">

                                </div>
                                <div class="alert alert-danger verification-error" style="display: none">
                                    {{__('lang.Verification code is invalid')}}
                                </div>
                                <button  type="submit" class="btn btn-primary">{{__('lang.Verify')}}</button>

                            </form>

                            <a href="{{LaravelLocalization::getLocalizedUrl(null, route('website.account.logout'))}}" class="btn btn-dark mt-20">{{__('lang.Logout')}}</a>



            </div>
            </div>
            </div>
            </div>
        </div>
    </section>


@endsection
@section('libs')

<script  src="https://www.gstatic.com/firebasejs/8.10.0/firebase-auth.js"></script>
<script  src="{{secure_url('/')}}/website/firebase/PhoneVerification.js"></script>

@endsection
