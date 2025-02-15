@extends('admin::layouts.master')

@section('content')

            <div class="layout-px-spacing">
                <form action="{{url('/')}}/admin/offers" method="post" enctype="multipart/form-data">
                    @csrf


                    <div class="page__header_title custom__page_header_title">
                        <h4>
                            {{__('admin.offers')}} {{__('admin.cars')}}
                        </h4>
                        <button class="btn btn-primary btn-rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                            {{__('admin.save')}} 

                        </button>
                    </div>



                    <div class="row layout-spacing">
                        @include("admin::layouts.parts.app.alerts")

                        @foreach(auth()->user()->company->sections as $section)
                        <div class="col-lg-6">
                            <div class="statbox widget box box-shadow">
                              
                                <div class="widget-content widget-content-area">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <h4>{{$section->title}}</h4>

                                        <p><b>{{__('admin.available_qty')}}: {{$section->cars()->where('section_cars.company_id', auth()->user()->company->id)->count()}} /{{$section->pivot->max}}</b></p>


                                     
                                   
                                        <div class="form-group row mb-4">
                                           
                                            <div class="col-xl-12 col-lg-12 col-sm-12">
                                                <select class="form-control  basic" name="section[{{$section->id}}][]" multiple="multiple">
                                                    
                                                    @php
                                                        $cars = auth()->user()->company->cars()->get();
                                                    @endphp
                                                    @foreach($cars as $car)
                                                    <option value="{{$car->id}}" @if($section->cars()->where('car_id', $car->id)->count() > 0) selected @endif>{{$car->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        



  

                                        
                                        
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach
              
                    </div>

                </form>
            </div>

@endsection
