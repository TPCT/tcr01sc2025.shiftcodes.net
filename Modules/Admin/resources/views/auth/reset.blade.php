@extends("admin::layouts.auth-master")
@section("content")
    
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">

                    @include('admin::layouts.parts.auth-logo')
                    <h1 class="">استعادة <span>حسابك</span>
                    </h1>
                    <form class="text-left" action="{{url('/')}}/reset" method="post">
                        @csrf
                        <div class="form">

                            
                                @include('admin::layouts.parts.auth-alerts')
                          

                                <div class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
                                    <input required name="email" type="email" class="form-control" placeholder="اكتب بريدك الالكتروني">
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
                    <p class="signup-link">هل تذكرت {{__('admin.password')}} ؟ <a href="{{\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedUrl(null, route('website.account.login'))}}">الدخول</a></p>
                  
                  <p class="terms-conditions">جميع الحقوق محفوظة @ 2024 منتجات <a href="/">خارطة الابداع</a> </p>

                </div>                    
            </div>
        </div>
    </div>

@endsection