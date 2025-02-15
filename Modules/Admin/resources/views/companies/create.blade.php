@extends('admin::layouts.master')

@section('content')

            <div class="layout-px-spacing">
                <form action="{{url('/')}}/admin/companies" method="post" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="type" value="{{request()->get('type')}}">

                    <div class="page__header_title custom__page_header_title">
                        <h4>{{__('admin.add')}} {{__('admin.office_singular')}}
                            @if(request()->get('type') == 'default')
                                {{__('admin.rental_no_driver')}}
                            @elseif(request()->get('type') == 'driver')
                               {{__('admin.rental_with_driver')}}
                            @elseif(request()->get('type') == 'yacht')
                                {{__('admin.yacht_rental')}}
                            @endif
                        </h4>
                        <button class="btn btn-primary btn-rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                            {{__('admin.save')}} 

                        </button>
                    </div>



                    <div class="row layout-spacing">
                        @include("admin::layouts.parts.app.alerts")
                        <div class="col-lg-7">
                            <div class="statbox widget box box-shadow mb-20">

                                <div class="widget-content widget-content-area">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.name')}} {{__('admin.owner')}} {{__('admin.office')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="text" required  class="form-control" name="owner_name" >
                                            </div>
                                        </div>

                                        @foreach(\Config::get("app.languages") as $key => $value)
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.name')}} {{__('admin.office')}} {{$value}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="text" required class="form-control" name="name_{{$key}}" >
                                            </div>
                                        </div>
                                        @endforeach


                                        @foreach(\Config::get("app.languages") as $key => $value)
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.description')}} {{$value}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <textarea  required class="form-control" name="description_{{$key}}"></textarea>
                                            </div>
                                        </div>
                                        @endforeach

                                                                            
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.username')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="text" required  class="form-control" name="owner_username" >
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.password')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="text" required  class="form-control" name="password" >
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label for="hPassword" class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.image')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <div class="custom-file">
                                                    <input type="file" required class="custom-file-input" accept="image/*" name="image" id="customFile">
                                                    <label class="custom-file-label" for="customFile">{{__('admin.choose_file')}}</label>
                                                </div>
                                            
                                            </div>

                                        </div>    
                                        
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.phone')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="text" required class="form-control" name="phone_01" >
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.whatsapp')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="text"  class="form-control" name="phone_02" >
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.email')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="email" class="form-control" name="owner_email" >
                                            </div>
                                        </div>


  

                                        
                                        
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="statbox widget box box-shadow mb-20">

                                <div class="widget-content widget-content-area">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                   

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.country')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <select class="form-control select-country" name="country_id" required>
                                                    <option value="">{{__('admin.country')}}</option>
                                                    @foreach(\App\Models\Country::all() as $country)
                                                    <option value="{{$country->id}}">{{$country->title}}</option>
                                                    @endforeach
                                                  
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.cities')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <select class="form-control select-city" required multiple name="city_id[]">
                                                    
                                                   
                                                  
                                                </select>
                                            </div>
                                        </div>

                                     
                                        
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label"> google map iframe</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="text"  class="form-control" name="address" >
                                            </div>
                                        </div>



  

                                        
                                        
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="statbox widget box box-shadow">

                                <div class="widget-content widget-content-area">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                   

               

                                     
                                        @foreach(\App\Models\Section::all() as $section)
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{$section->title}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="number" value="0"  class="form-control" name="section_max_{{$section->id}}" >
                                            </div>
                                        </div>
                                        @endforeach



  

                                        
                                        
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="statbox widget box box-shadow ">

                                <div class="widget-content widget-content-area ">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        
                                    

                                        @if(request()->get('type') == 'default')
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.types')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <select class="form-control"  multiple name="type_id[]" >
                                                    
                                                    @foreach(\App\Models\Type::all() as $type)
                                                    <option value="{{$type->id}}">{{$type->title}}</option>
                                                    @endforeach
                                                  
                                                </select>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.name')}} {{__('admin.delagite')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="text"  class="form-control" name="responsible_name" >
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">@if(request()->get('type') == 'default') {{__('admin.qty')}} {{__('admin.cars')}} @elseif(request()->get('type') == 'driver') {{__('admin.qty')}} {{__('admin.cars')}} @elseif(request()->get('type') == 'yacht') {{__('admin.qty')}} {{__('admin.yacht')}} @endif</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="number" value="5"  class="form-control" name="cars_limit" >
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.qty')}} {{__('admin.refreshes')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="number" value="5"  class="form-control" name="refresh_limit" >
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.status')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <select class="form-control" name="status" required>
                                                    <option value="1">{{__('admin.active')}}</option>
                                                    <option value="0">{{__('admin.not')}} {{__('admin.active')}}</option>
                                                    
                                                  
                                                </select>
                                            </div>
                                        </div>

    

  
                                                               
    

                                        
                                        
                                        </div>
                                    </div>

                                </div>
                            </div>

                            
                        </div>

                        <!-- <div class="col-lg-12">
                            @include("admin::layouts.parts.content", [
                                "content" => null,
                                "seo"     => null,
                                "faq"     => null
                            ]) 
                        </div> -->
              
              
                    </div>

                </form>



            </div>

@endsection
