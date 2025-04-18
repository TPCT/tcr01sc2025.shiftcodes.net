@extends('admin::layouts.master')

@section('content')

            <div class="layout-px-spacing">
                <form data-type="{{$car->type}}" action="{{url('/')}}/admin/cars/{{$car->id}}" id="cars-form" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="page__header_title custom__page_header_title">
                        <h4>{{__('admin.edit')}}</h4>
                        <button onclick="tinyMCE.triggerSave(true,true);" class="btn btn-primary btn-rounded submit-btn">
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
                                        
                                        @if(auth()->user()->type == "admin")
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.office_singular')}} التأجير</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <select class="form-control" name="company_id" required>
                                                    <option value="">{{__('admin.office')}}</option>
                                                    @foreach(\App\Models\Company::all() as $x)
                                                    <option @if($car->company_id == $x->id) selected @endif value="{{$x->id}}">{{$x->name}}</option>
                                                    @endforeach
                                                  
                                                </select>
                                            </div>
                                        </div>
                                        @endif

                                        @foreach(\Config::get("app.languages") as $key => $value)
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.name')}} {{$value}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="text" required class="form-control" value="{{$car->getTranslation('name', $key)}}"  name="name_{{$key}}" >
                                            </div>
                                        </div>
                                        @endforeach

                                        @if($car->type != 'yacht')
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.type')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <select class="form-control" multiple name="type_id[]" required>
                                                   
                                                    @foreach(\App\Models\Type::all() as $x)
                                                    <option @if(in_array($x->id, $car->types()->pluck('car_types.type_id')->toArray())) selected @endif value="{{$x->id}}">{{$x->title}}</option>
                                                    @endforeach
                                                  
                                                </select>
                                            </div>
                                        </div>
                                        @endif

                                        @if($car->type == "default")
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.price')}} {{__('admin.day')}} ({{__('admin.aed')}})</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="number" value="{{$car->price_per_day}}" required  class="form-control" name="price_per_day" >
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.KM Per Day')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="number"  value="{{$car->km_per_day}}"  class="form-control" name="km_per_day" >
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.price')}} {{__('admin.week')}} ({{__('admin.aed')}})</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="number" value="{{$car->price_per_week}}"  class="form-control" name="price_per_week" >
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.price')}} {{__('admin.month')}} ({{__('admin.aed')}})</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="number" value="{{$car->price_per_month}}"  class="form-control" name="price_per_month" >
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.KM Per Month')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="number"  value="{{$car->km_per_month}}"  class="form-control" name="km_per_month" >
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.minimum_day_booking')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="number" value="{{$car->minimum_day_booking}}" required  class="form-control" name="minimum_day_booking" >
                                            </div>
                                        </div>

                                        <!-- <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.price')}} بعد الخصم لل{{__('admin.day')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                
                                                <input  type="number" value="{{$car->day_offer_price}}"  class="form-control" name="day_offer_price" >
                                                <br/>
                                                <input style="margin-left:4px" @if($car->is_day_offer == 1) checked @endif type="checkbox" name="is_day_offer" /> تفعيل {{__('admin.view')}}

                                            </div>
                                           
                                        </div> -->

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.security_deposit')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input required  type="number" value="{{$car->security_deposit}}" class="form-control" name="security_deposit" >
                                            </div>
                                        </div>


                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.price')}} {{__('admin.extra_km')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input required  type="number" value="{{$car->extra_price}}"  class="form-control" name="extra_price" >
                                            </div>
                                        </div>

                                        @else

                                        
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.minimum_hours')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="number" required value="1"  class="form-control" name="minimum_day_booking" >
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.price')}} {{__('admin.hour')}} ({{__('admin.aed')}})</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="number" value="{{$car->price_per_day}}" required  class="form-control" name="price_per_day" >
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.price')}} 3 {{__('admin.hours')}} ({{__('admin.aed')}})</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="number" value="{{$car->price_per_week}}"  class="form-control" name="price_per_week" >
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.price')}} 8 {{__('admin.hours')}} ({{__('admin.aed')}})</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input  type="number" value="{{$car->price_per_month}}"  class="form-control" name="price_per_month" >
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.price')}} {{__('admin.extra_hr')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input   type="number" value="{{$car->extra_price}}"  class="form-control" name="extra_price" >
                                            </div>
                                        </div>
                                        @endif

                                      

                                        @foreach(\Config::get("app.languages") as $key => $value)
                                        <!-- <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">ال{{__('admin.description')}} والمميزات {{$value}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <textarea class="form-control" name="description_{{$key}}">{{$car->getTranslation('description', $key)}}</textarea>
                                            </div>
                                        </div> -->
                                        @endforeach

                                        @foreach(\Config::get("app.languages") as $key => $value)
                                        <!-- <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">ملاحظات للعميل {{$value}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <textarea class="form-control" name="customer_notes_{{$key}}">{{$car->getTranslation('customer_notes', $key)}}</textarea>
                                            </div>
                                        </div> -->
                                        @endforeach

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.features')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <select class="form-control" multiple name="feature_id[]">
                                                   
                                                    @foreach(\App\Models\Feature::where(function($query) use ($car) {
                                                        if($car->type == "default" || $car->type == "driver") {
                                                            $query->where('type', '=', 'car');
                                                        }else {
                                                            $query->where('type', '=', 'yacht');
                                                        }

                                                    })->get() as $x)
                                                    <option @if(in_array($x->id, $car->features()->pluck('car_features.feature_id')->toArray())) selected @endif value="{{$x->id}}">{{$x->name}}</option>
                                                    @endforeach
                                                  
                                                </select>
                                            </div>
                                        </div>

                                        @if($car->type == 'default' || $car->type == 'driver')
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.brand')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <select class="form-control select-brand" name="brand_id" required>
                                                    <option value="">{{__('admin.brand')}}</option>
                                                    @foreach(\App\Models\Brand::all() as $x)
                                                    <option @if($car->brand_id == $x->id) selected @endif value="{{$x->id}}">{{$x->title}}</option>
                                                    @endforeach
                                                  
                                                </select>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.model')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <select class="form-control select-model" name="model_id" required>
                                                    <option value="">{{__('admin.model')}}</option>
                                                    @if($car->type == "yacht")
                                                  
                                                        @foreach(\App\Models\Models::where('type', '=', 'yacht')->get() as $x)
                                                            <option @if($car->model_id == $x->id) selected @endif value="{{$x->id}}">{{$x->title}}</option>
                                                        @endforeach
                                        
                                                    @else
                                                        @foreach($car->brand->models()->get() as $m)
                                                            <option @if($car->model_id == $m->id) selected @endif value="{{$m->id}}">{{$m->title}}</option>
                                                        @endforeach
                                                    @endif
                                                  
                                                </select>
                                            </div>
                                        </div>
                                        @if($car->type == 'default' || $car->type == 'driver')
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.color')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <select class="form-control" name="color_id" required>
                                                    <option value="">{{__('admin.color')}}</option>
                                                    @foreach(\App\Models\Color::all() as $x)
                                                    <option @if($car->color_id == $x->id) selected @endif value="{{$x->id}}">{{$x->title}}</option>
                                                    @endforeach
                                                  
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.year')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <select class="form-control" name="year_id" required>
                                                    <option value="">{{__('admin.year')}}</option>
                                                    @foreach(\App\Models\Year::all() as $x)
                                                    <option @if($car->year_id == $x->id) selected @endif value="{{$x->id}}">{{$x->title}}</option>
                                                    @endforeach
                                                  
                                                </select>
                                            </div>
                                        </div>
                                        @endif

                        

                                        <div class="form-group row mb-4">
                                            <label for="hPassword" class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.image')}} {{__('admin.home')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" accept="image/*" name="image" id="customFile">
                                                    <label class="custom-file-label" for="customFile">{{__('admin.choose_file')}}</label>
                                                </div>
                                                @if($car->image)
                                                <a href="{{url('/')}}/storage/{{\App\Helpers\WebpImage::generateUrl($car->image)}}" target="_blank">
                                                    <img class="image-form" src="{{url('/')}}/storage/{{\App\Helpers\WebpImage::generateUrl($car->image)}}" alt="">
                                                   
                                                </a>
                                                @endif
                                            
                                            </div>

                                        </div>                                          
                                        
                                        <div class="form-group row mb-4">
                                            <label for="hPassword" class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.other_images')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <div id="cars-uploader" class="dropzone"> 
                                                    <div class="dz-message" data-dz-message><span>{{__('admin.choose_file')}}</span></div>
                                                    
                                                </div>
                                                <div class="all-images">
                                                    @foreach($car->images as $img)
                                                    <div class="all-images-item">
                                                    <img src="/storage/{{\App\Helpers\WebpImage::generateUrl($img->image)}}" />
                                                    <a href="/admin/cars/images/{{$img->id}}/delete">{{__('admin.delete')}}</a>
                                                    </div>

                                                    @endforeach
                                                </div>
                                        
                                            </div>

                                        </div>    
                                        
                


  

                                        
                                        
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
                                        
                                            @if($car->type != "yacht")
                                            <div class="form-group row mb-4">
                                                <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.engine')}}</label>
                                                <div class="col-xl-9 col-lg-9 col-sm-10">
                                                    <input value="{{$car->engine_capacity}}"  type="text"   class="form-control" name="engine_capacity" >
                                                </div>
                                            </div>  
                                            
                                            <div class="form-group row mb-4">
                                                <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.qty')}} {{__('admin.doors')}}</label>
                                                <div class="col-xl-9 col-lg-9 col-sm-10">
                                                    <input value="{{$car->doors}}"  type="number"   class="form-control" name="doors" >
                                                </div>
                                            </div> 
                                            
                                            <div class="form-group row mb-4">
                                                <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.qty')}} {{__('admin.bags')}}</label>
                                                <div class="col-xl-9 col-lg-9 col-sm-10">
                                                    <input value="{{$car->bags}}"  type="number"   class="form-control" name="bags" >
                                                </div>
                                            </div>  
                                           @endif

                                            <div class="form-group row mb-4">
                                                <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.qty')}} {{__('admin.passengers')}}</label>
                                                <div class="col-xl-9 col-lg-9 col-sm-10">
                                                    <input value="{{$car->passengers}}" type="number"   class="form-control" name="passengers" >
                                                </div>
                                            </div>  
                                            
                                        



                                            @if(auth()->user()->type == "admin")
                                            <div class="form-group row mb-4">
                                                <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.status')}}</label>
                                                <div class="col-xl-9 col-lg-9 col-sm-10">
                                                    <select class="form-control" name="status" required>
                                                        <option @if($car->status == 'active') selected @endif value="active">{{__('admin.active')}}</option>
                                                        <option @if($car->status == 'pending') selected @endif value="pending">{{__('admin.pending')}}</option>
                                                       
                                                    
                                                    </select>
                                                </div>
                                            </div>
                                            @endif
                                        
                                        </div>
                                    </div>

                                </div>
                            </div>

                            
                        </div>

                        @if($car->type != "default" )

                        <div class="col-lg-12">
                            @include("admin::layouts.parts.content", [
                                "content" => \App\Models\Content::where([["type", "car"],["resource_id", $car->id]])->first(),
                                "seo" => \App\Models\SEO::where([["type", "car"],["resource_id", $car->id]])->first(),
                                "faq" => \App\Models\Faq::where([["type", "car"],["resource_id", $car->id]])->get()
                            ])  
                        </div> 

                        @endif


              
              
                    </div>

                </form>



            </div>

@endsection
