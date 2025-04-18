@extends('admin::layouts.master')

@section('content')

            <div class="layout-px-spacing">
                <form action="{{url('/')}}/admin/companies/{{$company->id}}" method="post" enctype="multipart/form-data">
                    @method("PUT")
                    @csrf
                    <div class="page__header_title custom__page_header_title">
                        <h4>{{__('admin.edit')}} {{__('admin.office_singular')}}</h4>
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
                                        
                                        @foreach(\Config::get("app.languages") as $key => $value)
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.name')}} {{__('admin.office')}} {{$value}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="text" required class="form-control" value="{{$company->getTranslation('name', $key)}}" name="name_{{$key}}" >
                                            </div>
                                        </div>
                                        @endforeach

                                                         
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.name')}} {{__('admin.owner')}} {{__('admin.office')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="text" required  class="form-control" value="{{$company->user->name}}" name="owner_name" >
                                            </div>
                                        </div>

                                        @foreach(\Config::get("app.languages") as $key => $value)
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.description')}} {{$value}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <textarea  class="form-control" name="description_{{$key}}">{{$company->getTranslation('description', $key)}}</textarea>
                                            </div>
                                        </div>
                                        @endforeach

                                        @foreach(\Config::get("app.languages") as $key => $value)
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.terms')}} {{$value}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <textarea  class="form-control body" name="terms_{{$key}}">{{$company->getTranslation('terms', $key)}}</textarea>
                                            </div>
                                        </div>
                                        @endforeach

                                                                            
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.username')}} </label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="text" required  class="form-control" value="{{$company->user->username}}" name="owner_username" >
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.password')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="text" required value="{{$company->password}}"  class="form-control" name="password" >
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label for="hPassword" class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.image')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" accept="image/*" name="image" id="customFile">
                                                    <label class="custom-file-label" for="customFile">{{__('admin.choose_file')}}</label>
                                                </div>
                                                @if($company->image)
                                                <a href="{{url('/')}}/storage/{{\App\Helpers\WebpImage::generateUrl($company->image)}}" target="_blank">
                                                    <img class="image-form" src="{{url('/')}}/storage/{{\App\Helpers\WebpImage::generateUrl($company->image)}}" alt="">
                                                </a>
                                                @endif 
                                            
                                            </div>

                                        </div>    
                                        
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.phone')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="text" value="{{$company->phone_01}}" required class="form-control" name="phone_01" >
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">ال{{__('admin.whatsapp')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="text" value="{{$company->phone_02}}"  class="form-control" name="phone_02" >
                                            </div>
                                        </div>

                                    

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.email')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="email" value="{{$company->user->email}}" class="form-control" name="owner_email" >
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
                                                    <option @if($country->id == $company->country_id) selected @endif value="{{$country->id}}">{{$country->title}}</option>
                                                    @endforeach
                                                  
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.cities')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <select class="form-control select-city" required multiple name="city_id[]">
                                                    @foreach($company->country->cities as $city)

                                                    <option @if(in_array($city->id, $company->cities()->pluck('cities.id')->toArray())) selected @endif value="{{$city->id}}">{{$city->title}}</option>
                                                   
                                                    @endforeach
                                                  
                                                </select>
                                            </div>
                                        </div>

                                     
                                        
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">google map iframe</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input value="{{$company->address}}"  type="text"  class="form-control" name="address" >
                                            </div>
                                        </div>



  

                                        
                                        
                                        </div>
                                    </div>

                                </div>
                            </div>

                            @if(auth()->user()->type == "admin" && \App\Models\Section::count() > 0)
                            <div class="statbox widget box box-shadow">

                                <div class="widget-content widget-content-area">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                   

               

                                     
                                        @foreach(\App\Models\Section::all() as $section)
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{$section->title}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="number" min="0"  value="{{$company->sections()->where('company_sections.section_id', $section->id)->first() ? $company->sections()->where('company_sections.section_id', $section->id)->first()->pivot->max : 0}}"  class="form-control" name="section_max_{{$section->id}}" >
                                            </div>
                                        </div>
                                        @endforeach



  

                                        
                                        
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="col-lg-5">
                            <div class="statbox widget box box-shadow ">

                                <div class="widget-content widget-content-area ">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        
                                    

                                        @if($company->type == 'default')
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.types')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <select class="form-control" required multiple name="type_id[]" required>
                                                    
                                                    @foreach(\App\Models\Type::all() as $type)
                                                    <option @if(in_array($type->id, $company->types()->pluck('types.id')->toArray())) selected @endif value="{{$type->id}}">{{$type->title}}</option>
                                                    @endforeach
                                                  
                                                </select>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.name')}} {{__('admin.delagite')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="text" value="{{$company->responsible_name}}"  class="form-control" name="responsible_name" >
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.Delivery Time')}} ({{__('admin.Hours')}})</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="number" value="{{$company->delivery_time}}"  class="form-control" name="delivery_time" >
                                            </div>
                                        </div>

                                        @if($company->type == 'default')
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.Salik Fees')}} (AED)</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="number" value="{{$company->salik_fees}}"  class="form-control" name="salik_fees" >
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.Deposit Refund')}} ({{__('admin.Days')}})</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="number" value="{{$company->deposit_refund}}"  class="form-control" name="deposit_refund" >
                                            </div>
                                        </div>

                                        @endif

                                        
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">VAT ({{__('admin.percentage')}})</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="number" value="{{$company->vat_percentage}}"  class="form-control" name="vat_percentage" >
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.Minimum Age')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="number" value="{{$company->min_age}}"  class="form-control" name="min_age" >
                                            </div>
                                        </div>

                                        

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.Payment Methods')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <select class="form-control" multiple name="payment_methods[]" >
                                                    @foreach(\App\Models\Company::$allPaymentMethods as $paymentMethod)
                                                    <option @if(in_array($paymentMethod, $company->paymentMethods())) selected @endif value="{{$paymentMethod}}">{{__('admin.' . $paymentMethod)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        @if(auth()->user()->type == "admin")
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">@if($company->type == 'default') {{__('admin.qty')}} {{__('admin.cars')}} @elseif($company->type == 'driver') {{__('admin.qty')}} {{__('admin.cars')}} @elseif($company->type == 'yacht') {{__('admin.qty')}} {{__('admin.yacht')}} @endif</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="number" value="{{$company->cars_limit}}"  class="form-control" name="cars_limit" >
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.qty')}} {{__('admin.refreshes')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="number" value="{{$company->refresh_limit}}"  class="form-control" name="refresh_limit" >
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.status')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <select class="form-control" name="status" required>
                                                    <option @if($company->status) selected @endif value="1">{{__('admin.active')}}</option>
                                                    <option  @if(!$company->status) selected @endif value="0">{{__('admin.not')}} {{__('admin.active')}}</option>
                                                    
                                                  
                                                </select>
                                            </div>
                                        </div>

                                        @endif

    

  
                                                               
    

                                        
                                        
                                        </div>
                                    </div>

                                </div>
                            </div>

                            
                        </div>

                        <div class="col-lg-12">
                               <div class="statbox widget box box-shadow ">

                                <div class="widget-content widget-content-area ">
                                    @php 
                                        if($company->type == 'yacht') {
                                            $hoursTypes = [
                                               
                                                "open" => __('admin.open'),
                                                "holiday" => __('admin.holiday')
                                            ];
                                        }else {
                                            $hoursTypes = [
                                                "24" => __('admin.24'),
                                                "open" => __('admin.open'),
                                                "holiday" => __('admin.holiday')
                                            ];
                                        }
                                    @endphp
                                    @foreach(\App\Models\Company::$days as $key => $day)
                                    @php
                                        $h = $company->hours()->where('day', $day)->first();
                                       
                                    @endphp
                                    <div class="hour__item">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h6 @if($key != 0) style="margin-top:20px" @endif>{{__('admin.' . $day)}}</h6>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>{{__('admin.type')}}</label>
                                                    <select class="form-control" name="type_{{$day}}">
                                                        <option value="">{{__('admin.choose')}}</option>
                                                        @foreach($hoursTypes as $key => $value)
                                                        <option @if($company->hours()->where('day', $day)->first() && $company->hours()->where('day', $day)->first()->type == $key) selected @endif value="{{$key}}">{{$value}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>{{__('admin.from')}}</label>
                                                    @php
                                                        $time_from = "";
                                                        if($company->hours()->where('day', $day)->first()){
                                                            $time_from = $company->hours()->where('day', $day)->first()->time_from ? $company->hours()->where('day', $day)->first()->time_from->format('H:i') : "";
                                                        }
                                                        $time_to = "";
                                                        if($company->hours()->where('day', $day)->first()){
                                                            $time_to = $company->hours()->where('day', $day)->first()->time_to ? $company->hours()->where('day', $day)->first()->time_to->format('H:i') : "";
                                                        }
                                                    @endphp
                                                    <input value="{{$time_from}}" type="time" value="" name="time_from_{{$day}}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>{{__('admin.to')}}</label>
                                                    <input value="{{$time_to}}"  type="time" value="" name="time_to_{{$day}}" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>



                        <!-- <div class="col-lg-12">
                            @include("admin::layouts.parts.content", [
                                "content" => \App\Models\Content::where([["type", "company"],["resource_id", $company->id]])->first(),
                                "seo" => \App\Models\SEO::where([["type", "company"],["resource_id", $company->id]])->first(),
                                "faq" => \App\Models\Faq::where([["type", "company"],["resource_id", $company->id]])->get()
                            ]) 
                        </div> -->
              
              
                    </div>

                </form>



            </div>

@endsection
