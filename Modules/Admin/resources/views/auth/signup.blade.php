@extends("admin::layouts.auth-master")
@section("content")
    
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">

                    @include('admin::layouts.parts.auth-logo')
                    <h1 class="">سجل حسابك الأن<br/> 
                    وابدء <span>متجر الجمعية الخاص بك</span>
                    </h1>
                    <form class="text-left" action="{{\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedUrl(null, route('website.account.register'))}}" method="post">
                        @csrf
                        <div class="form">

                            
                            @include('admin::layouts.parts.auth-alerts')
                           

                            <div id="name-field" class="field-wrapper input">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <input id="name" name="name" required type="text" class="form-control" placeholder="{{__('admin.name')}}">
                            </div>
                            <div id="email-field" class="field-wrapper input">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
                                <input id="email" name="email" type="email" class="form-control" required value="" placeholder="البريد الاكتروني">
                            </div>
                            <div id="password-field" class="field-wrapper input ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                <input required id="password" name="password" class="form-control" type="password" value="" placeholder="{{__('admin.password')}}">
                            </div>
                            <div id="phone-field" class="field-wrapper input ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                <input required id="phone" name="phone" class="form-control" type="number" value="" placeholder="{{__('admin.phone')}}">
                            </div>
                            <div class="field-wrapper terms_condition">
                                <div class="n-chk new-checkbox checkbox-outline-primary">
                                    <label class="new-control new-checkbox checkbox-outline-primary">
                                        <input type="checkbox" required class="new-control-input">
                                        <span class="new-control-indicator"></span><span>{{__('admin.or')}}افق علي <a href="javascript:void(0);">  شروط الخصوصية والاستخدام </a></span>
                                    </label>
                                </div>
                            </div>
                            <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper toggle-pass">
                                    <p class="d-inline-block">عرض {{__('admin.password')}}</p>
                                    <label class="switch s-primary">
                                        <input type="checkbox" id="toggle-password" class="d-none">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <div class="field-wrapper">
                                    <button type="submit" class="btn btn-primary" value="">تسجيل</button>
                                </div>
                            </div>

                        </div>
                    </form>      
                    <p class="signup-link">لديك حساب بالفعل ؟ <a href="{{\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedUrl(null, route('website.account.login'))}}">الدخول</a></p>
                
                    <p class="terms-conditions">جميع الحقوق محفوظة @ 2024 منتجات <a href="/">خارطة الابداع</a> </p>

                </div>                    
            </div>
        </div>
    </div>

@endsection