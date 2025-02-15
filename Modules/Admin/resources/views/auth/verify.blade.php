@extends("admin::layouts.auth-master")
@section("content")
    
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">

                    @include('admin::layouts.parts.auth-logo')
                    
                    <h1 class="">
                        تأكيد {{__('admin.email')}}
                    </h1>
                    <form class="text-left" action="{{url('/')}}/verify" method="post">
                        @csrf
                        <div class="form">

                            
                             @include('admin::layouts.parts.auth-alerts')
                        
                            <p class="form-label">لقد ارسلنا رمز تحقق الي بريدك الالكتروني <br/> <b>{{\Session::get('email')}}</b></p>



                            <div id="otp-field" class="field-wrapper input mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                <input required id="otp" name="otp" type="number" value="" placeholder="رمز التحقق">
                            </div>



                            <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper toggle-pass">
                               
                                </div>
                                <div class="field-wrapper">
                                    <button type="submit" class="btn btn-primary" value="">المتابعة</button>
                                </div>
                            </div>

                        </div>
                    </form>      
                    <p class="signup-link">لم يصلك الرمز ؟ <a href="{{url('/')}}/verify/resend">اعادة ارسال رمز التحقق</a></p>
                
                    <p class="terms-conditions">جميع الحقوق محفوظة @ 2024 منتجات <a href="index.html">خارطة الابداع</a> </p>

                </div>                    
            </div>
        </div>
    </div>

@endsection