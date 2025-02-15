@extends('admin::layouts.master')

@section('content')

            <div class="layout-px-spacing settings-page">
                <form action="{{url('/')}}/admin/settings/{{$settings->id}}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="page__header_title custom__page_header_title">
                        <h4>{{__('admin.settings')}}</h4>
                        <button class="btn btn-primary btn-rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                            {{__('admin.save')}} 

                        </button>

                    </div>



                    <div class="row layout-spacing">
                        @include("admin::layouts.parts.app.alerts")
                        <div class="col-lg-9">
                            <div class="statbox widget box box-shadow">

                                <div class="widget-content widget-content-area">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        
                                            @foreach(\Config::get("app.languages") as $key => $value)
                                                <div class="form-group row mb-4">
                                                    <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.name')}} {{$value}}</label>
                                                    <div class="col-xl-9 col-lg-9 col-sm-10">
                                                        <input value='{{$settings->getTranslation("title",$key)}}' type="text" required class="form-control" name="title_{{$key}}" >
                                                    </div>
                                                </div>
                                            @endforeach
        

                                            <div class="form-group row mb-4">
                                                <label for="hPassword" class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.image')}} {{__('admin.header')}}</label>
                                                <div class="col-xl-9 col-lg-9 col-sm-10">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" accept="image/*" name="header_logo" id="customFile">
                                                        <label class="custom-file-label" for="customFile">{{__('admin.choose_file')}}</label>
                                                    </div>
                                                    @if($settings->header_logo)
                                                    <a href="{{url('/')}}/storage/{{$settings->header_logo}}" target="_blank">
                                                        <img class="image-form" src="{{url('/')}}/storage/{{$settings->header_logo}}" width="100" height="100" alt="">
                                                    </a>
                                                    @endif
                                                </div>

                                            </div>   

                                            <div class="form-group row mb-4">
                                                <label for="hPassword" class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.image')}} {{__('admin.footer')}}</label>
                                                <div class="col-xl-9 col-lg-9 col-sm-10">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" accept="image/*" name="footer_logo" id="customFile">
                                                        <label class="custom-file-label" for="customFile">{{__('admin.choose_file')}}</label>
                                                    </div>
                                                    @if($settings->footer_logo)
                                                    <a href="{{url('/')}}/storage/{{$settings->footer_logo}}" target="_blank">
                                                        <img class="image-form" src="{{url('/')}}/storage/{{$settings->footer_logo}}" width="100" height="100" alt="">
                                                    </a>
                                                    @endif
                                                </div>

                                            </div>   

                                                                                        
                                            @foreach(\Config::get("app.languages") as $key => $value)
                                                <div class="form-group row mb-4">
                                                    <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.description')}} {{__('admin.footer')}} {{$value}}</label>
                                                    <div class="col-xl-9 col-lg-9 col-sm-10">
                                                        <input type="text" value="{{$settings->getTranslation('footer_description', $key)}}" required class="form-control" name="footer_description_{{$key}}" >
                                                    </div>
                                                </div>
                                            @endforeach

                                            @foreach(\Config::get("app.languages") as $key => $value)
                                                <div class="form-group row mb-4">
                                                    <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.address')}} {{$value}}</label>
                                                    <div class="col-xl-9 col-lg-9 col-sm-10">
                                                        <input type="text" value="{{$settings->getTranslation('footer_address', $key)}}" required class="form-control" name="footer_address_{{$key}}" >
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div class="form-group row mb-4">
                                                    <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">iframe map</label>
                                                    <div class="col-xl-9 col-lg-9 col-sm-10">
                                                        <textarea class="form-control" name="map" >{{$settings->map}}</textarea>
                                                    </div>
                                            </div>


                                            <div class="form-group row mb-4">
                                                    <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">Head Scripts</label>
                                                    <div class="col-xl-9 col-lg-9 col-sm-10">
                                                        <textarea class="form-control" name="scripts" >{{$settings->scripts}}</textarea>
                                                    </div>
                                            </div>

                                            <div class="form-group row mb-4">
                                                    <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">Body Scripts</label>
                                                    <div class="col-xl-9 col-lg-9 col-sm-10">
                                                        <textarea class="form-control" name="scripts_body" >{{$settings->scripts_body}}</textarea>
                                                    </div>
                                            </div>

                                            @foreach(\Config::get("app.languages") as $key => $value)
                                                  <div class="form-group row mb-4">
                                                    <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">Cars without driver notes {{$value}}</label>
                                                    <div class="col-xl-9 col-lg-9 col-sm-10">
                                                        <textarea class="form-control body" name="default_notes_{{$key}}" >{!! $settings->getTranslation("default_notes", $key) !!}</textarea>
                                                    </div>
                                                </div>
                                            @endforeach

                                            @foreach(\Config::get("app.languages") as $key => $value)
                                                  <div class="form-group row mb-4">
                                                    <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">Cars with driver notes {{$value}}</label>
                                                    <div class="col-xl-9 col-lg-9 col-sm-10">
                                                        <textarea class="form-control body" name="driver_notes_{{$key}}" >{!! $settings->getTranslation("driver_notes", $key) !!}</textarea>
                                                    </div>
                                                </div>
                                            @endforeach

                                            @foreach(\Config::get("app.languages") as $key => $value)
                                                  <div class="form-group row mb-4">
                                                    <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">Yacht notes {{$value}}</label>
                                                    <div class="col-xl-9 col-lg-9 col-sm-10">
                                                        <textarea class="form-control body" name="yacht_notes_{{$key}}" >{!! $settings->getTranslation("yacht_notes", $key) !!}</textarea>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="page__header_title custom__page_header_title mt-20">
                                <h4>{{__('admin.contact_info')}}</h4>
                            </div>                            
                        </div>
                        <div class="col-lg-9">
                            <div class="statbox widget box box-shadow ">

                                <div class="widget-content widget-content-area">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        
                                            <div class="form-group row mb-4">
                                                <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.email')}}</label>
                                                <div class="col-xl-9 col-lg-9 col-sm-10">
                                                    <input type="text" value="{{$settings->contact_email}}" class="form-control" name="contact_email" >
                                                </div>
                                            </div>

                                            <div class="form-group row mb-4">
                                                <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.phone')}}</label>
                                                <div class="col-xl-9 col-lg-9 col-sm-10">
                                                    <input type="text" value="{{$settings->contact_phone}}" class="form-control" name="contact_phone" >
                                                </div>
                                            </div>

                                            
                                            <div class="form-group row mb-4">
                                                <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.whatsapp')}}</label>
                                                <div class="col-xl-9 col-lg-9 col-sm-10">
                                                    <input type="text" value="{{$settings->contact_whatsapp}}" class="form-control" name="contact_whatsapp" >
                                                </div>
                                            </div>

                                            <div class="form-group row mb-4">
                                                <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">facebook</label>
                                                <div class="col-xl-9 col-lg-9 col-sm-10">
                                                    <input type="text" value="{{$settings->contact_facebook}}" class="form-control" name="contact_facebook" >
                                                </div>
                                            </div>

                                            <div class="form-group row mb-4">
                                                <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">twitter</label>
                                                <div class="col-xl-9 col-lg-9 col-sm-10">
                                                    <input type="text" value="{{$settings->contact_twitter}}" class="form-control" name="contact_twitter" >
                                                </div>
                                            </div>

                                            <div class="form-group row mb-4">
                                                <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">instagram</label>
                                                <div class="col-xl-9 col-lg-9 col-sm-10">
                                                    <input type="text" value="{{$settings->contact_instagram}}" class="form-control" name="contact_instagram" >
                                                </div>
                                            </div>

                                            
                                            <div class="form-group row mb-4">
                                                <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">google play url</label>
                                                <div class="col-xl-9 col-lg-9 col-sm-10">
                                                    <input type="text" value="{{$settings->app_google_play}}" class="form-control" name="app_google_play" >
                                                </div>
                                            </div>

                                            <div class="form-group row mb-4">
                                                <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">app store url</label>
                                                <div class="col-xl-9 col-lg-9 col-sm-10">
                                                    <input type="text" value="{{$settings->app_apple_store}}" class="form-control" name="app_apple_store" >
                                                </div>
                                            </div>

 
                          
                                        
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="page__header_title custom__page_header_title mt-20">
                                <h4>{{__('admin.page')}} {{__('admin.cars_with_driver')}}</h4>
                            </div>                            
                        </div>
                        <div class="col-lg-9">
                            <div class="statbox widget box box-shadow">

                                <div class="widget-content widget-content-area">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        
                                            @foreach(\Config::get("app.languages") as $key => $value)
                                                <div class="form-group row mb-4">
                                                    <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.title')}} {{__('admin.page')}} {{$value}}</label>
                                                    <div class="col-xl-9 col-lg-9 col-sm-10">
                                                        <input value='{{$settings->getTranslation("driver_title",$key)}}' type="text" class="form-control" name="driver_title_{{$key}}" >
                                                    </div>
                                                </div>
                                            @endforeach

                                            @foreach(\Config::get("app.languages") as $key => $value)
                                                <div class="form-group row mb-4">
                                                    <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.description')}} {{__('admin.page')}} {{$value}}</label>
                                                    <div class="col-xl-9 col-lg-9 col-sm-10">
                                                        <textarea class="form-control" name="driver_description_{{$key}}" >{{$settings->getTranslation("driver_description",$key)}}</textarea>
                                                    </div>
                                                </div>
                                            @endforeach


                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>  
                        <div class="col-lg-12">
                            <div class="page__header_title custom__page_header_title mt-20">
                                <h4>{{__('admin.page')}} {{__('admin.yacht_rental')}}</h4>
                            </div>                            
                        </div>
                        <div class="col-lg-9">
                            <div class="statbox widget box box-shadow">

                                <div class="widget-content widget-content-area">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        
                                            @foreach(\Config::get("app.languages") as $key => $value)
                                                <div class="form-group row mb-4">
                                                    <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.title')}} {{__('admin.page')}} {{$value}}</label>
                                                    <div class="col-xl-9 col-lg-9 col-sm-10">
                                                        <input value='{{$settings->getTranslation("yacht_title",$key)}}' type="text" class="form-control" name="yacht_title_{{$key}}" >
                                                    </div>
                                                </div>
                                            @endforeach

                                            @foreach(\Config::get("app.languages") as $key => $value)
                                                <div class="form-group row mb-4">
                                                    <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.description')}} {{__('admin.page')}} {{$value}}</label>
                                                    <div class="col-xl-9 col-lg-9 col-sm-10">
                                                        <textarea class="form-control" name="yacht_description_{{$key}}" >{{$settings->getTranslation("yacht_description",$key)}}</textarea>
                                                    </div>
                                                </div>
                                            @endforeach


                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>   
                        <div class="col-lg-12">
                            <div class="page__header_title custom__page_header_title mt-20">
                                <h4>{{__('admin.blog')}}</h4>
                            </div>                            
                        </div>
                        <div class="col-lg-9">
                            <div class="statbox widget box box-shadow">

                                <div class="widget-content widget-content-area">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">

                                                @foreach(\Config::get("app.languages") as $key => $value)
                                                    <div class="form-group row mb-4">
                                                        <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.title')}} {{__('admin.page')}} {{$value}}</label>
                                                        <div class="col-xl-9 col-lg-9 col-sm-10">
                                                            <input class="form-control" name="blog_title_{{$key}}" value="{{$settings->getTranslation('blog_title',$key)}}" />

                                                        </div>
                                                    </div>
                                                @endforeach
                                        
                    
                                                <div class="form-group row mb-4">
                                                    <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.cars')}}</label>
                                                    <div class="col-xl-9 col-lg-9 col-sm-10">
                                                        <select name="car_id[]" multiple class="form-control">
                                                            @foreach(\App\Models\Car::get() as $c)
                                                                <option @if(in_array($c->id, \App\Models\BlogCar::pluck('car_id')->toArray())) selected @endif value="{{$c->id}}" >{{$c->name}}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="page__header_title custom__page_header_title mt-20">
                                <h4>reviews</h4>
                            </div>                            
                        </div>
                        <div class="col-lg-9">
                            <div class="statbox widget box box-shadow">

                                <div class="widget-content widget-content-area">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">

                                               
                                                    <div class="form-group row mb-4">
                                                        <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">google reviews code</label>
                                                        <div class="col-xl-9 col-lg-9 col-sm-10">
                                                            <textarea class="form-control" style="direction:ltr" name="google_reviews_widget">{{$settings->google_reviews_widget}}</textarea>
                                                        </div>
                                                    </div>
                                               
                                        
                    
                                                    <div class="form-group row mb-4">
                                                        <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">facebook reviews code</label>
                                                        <div class="col-xl-9 col-lg-9 col-sm-10">
                                                            <textarea class="form-control" style="direction:ltr" name="facebook_reviews_widget">{{$settings->facebook_reviews_widget}}</textarea>
                                                        </div>
                                                    </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="page__header_title custom__page_header_title mt-20">
                                <h4>{{__('admin.faq')}}</h4>
                            </div>                            
                        </div>
                        <div class="col-lg-9">
                            <div class="statbox widget box box-shadow">

                                <div class="widget-content widget-content-area">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">

                                                @foreach(\Config::get("app.languages") as $key => $value)
                                                    <div class="form-group row mb-4">
                                                        <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.title')}} {{__('admin.page')}} {{$value}}</label>
                                                        <div class="col-xl-9 col-lg-9 col-sm-10">
                                                            <input class="form-control" name="faq_title_{{$key}}" value="{{$settings->getTranslation('faq_title',$key)}}" />
                                                        </div>
                                                    </div>
                                                @endforeach
                                        
                

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div> 

                        <div class="col-lg-12">
                            <div class="page__header_title custom__page_header_title mt-20">
                                <h4>{{__('admin.content')}} {{__('admin.home')}}</h4>
                            </div>                            
                        </div>
                        <div class="col-lg-12">
                            <div class="statbox widget box box-shadow">

                                <div class="widget-content widget-content-area">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            @php
                                                $home = [
                                                    "car_types_title",
                                                    "car_types_description",
                                                    "car_brands_title",
                                                    "car_brands_description",
                                                    "car_companies_title",
                                                    "car_companies_description",
                                                    "book_your_next_trip_left",
                                                    "book_your_next_trip_right",
                                                    "find_your_car_title",
                                                    "find_your_car_description",
                                                ];     
                                            @endphp
                                        
                                            @foreach($home as $section)
                                

                                                @foreach(\Config::get("app.languages") as $key => $value)
                                                    <div class="form-group row mb-4">
                                                        <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">[{{$section}}] -  {{$value}}</label>
                                                        <div class="col-xl-9 col-lg-9 col-sm-10">
                                                            <textarea class="form-control @if($section == 'book_your_next_trip_left' || $section == 'book_your_next_trip_right') body @endif" name="{{$section}}_{{$key}}" >{{$settings->getTranslation($section,$key)}}</textarea>
                                                        </div>
                                                    </div>
                                                @endforeach

                                            @endforeach


                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>  
                        
                        <div class="col-12">
                            <br/>
                            <br/>
                        <a class="btn btn-primary btn-rounded" href="/admin/sitemap/generate">
                           Update Sitemap

                        </a>
                        </div>
                    </div>

                </form>

            </div>

@endsection
@section('js')
<script>
  tinymce.init({
    selector: 'textarea.body',
    directionality: "rtl",
    plugins: 'autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
  });
</script>
@endsection