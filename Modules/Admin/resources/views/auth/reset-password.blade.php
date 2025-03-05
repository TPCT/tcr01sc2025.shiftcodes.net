@extends("admin::layouts.auth-master")
@section("content")
    
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">

                    @include('admin::layouts.parts.auth-logo')
                    <h1 class="">تغيير {{__('admin.password')}}
                    </h1>
                    <form class="text-left" action="{{url('/')}}/reset/password" method="post">
                        @csrf
                        <div class="form">

                            
                                @include('admin::layouts.parts.auth-alerts')
                          

                                <div class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input name="password" type="password" required  placeholder="{{__('admin.password')}} الجديدة">
                                </div>

                                <div class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input name="password_confirmation" type="password" required  placeholder="تأكيد {{__('admin.password')}} الجديدة">
                                </div>
                          
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper toggle-pass">
                             
                                    </div>
                                    <div class="field-wrapper">
                                        <input type="hidden" name="token" value="{{$token}}">
                                        <button type="submit" class="btn btn-primary" value="">المتابعة</button>
                                    </div>
                                    
                                </div>



                        </div>
                    </form>      
                    <p class="signup-link">هل تذكرت {{__('admin.password')}} ؟ <a href="{{\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedUrl(null, route('website.account.login'))}}">الدخول</a></p>
                  
                  <p class="terms-conditions">جميع الحقوق محفوظة @ 2024 منتجات <a href="/">خارطة الابداع</a> </p>

                </div>                    
            </div>
        </div>
    </div>

@endsection