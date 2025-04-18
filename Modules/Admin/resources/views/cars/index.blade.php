@extends('admin::layouts.master')
@section('content')

    <div class="layout-px-spacing">

                

                <div class="row layout-spacing">
                   
                    <div class="col-lg-12">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <div class="page__header_title">
                                            <h4>
                                                @if(request()->get('type') == 'default') 
                                                    {{__('admin.cars')}} 
                                                @elseif(request()->get('type') == 'driver')
                                                    {{__('admin.car_with_driver')}}
                                                @elseif(request()->get('type') == 'yacht')
                                                   {{__('admin.yacht')}}
                                                @endif
                                                @if(request()->get('status') == 'active')
                                                {{__('admin.active')}}
                                                @elseif(request()->get('status') == 'pending')
                                                {{__('admin.pending')}}
                                                @endif
                                            </h4>
                                            <a href="{{url('/')}}/admin/cars/create?type={{request()->get('type')}}" class="btn btn-primary btn-rounded">
                                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                                {{__('admin.add')}} 
                                            </a>
                                        </div>
                                       
                                    </div>                 
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                 
                                <div class="row">
                                    @include("admin::layouts.parts.app.alerts")
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <form action="/admin/cars" method="get">
                                            <div class="filter row">
                                                <div class="form-group col-lg-2">
                                                    <input type="text" value="{{request()->get('search')}}" class="form-control" name="search" id="search" placeholder="{{__('admin.search')}} ">
                                                </div>
                                                <input type="hidden" name="status" value="{{request()->get('status')}}" />
                                                <input type="hidden" name="type" value="{{request()->get('type')}}" />

                                                @if(auth()->user()->type == "admin")
                                                <div class="form-group  col-lg-2">
                                                    <select name="company_id" class="form-control">
                                                        <option value="">{{__('admin.office')}}</option>
                                                        @foreach(\App\Models\Company::where(function($query){
                                                            if(request()->get('type') == 'default') {
                                                                $query->where('type', 'default');
                                                            }else if (request()->get('type') == 'yacht') {
                                                                $query->where('type', 'yacht');
                                                            }else if (request()->get('type') == 'driver') {
                                                                $query->where('type', 'driver');
                                                            }
                                                        })->get() as $company)
                                                        <option value="{{$company->id}}" {{request()->get('company_id') == $company->id ? 'selected' : ''}}>{{$company->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @endif

                                                @if(request()->get('type') != 'yacht')
                                                <div class="form-group  col-lg-2">
                                                    <select name="brand_id" class="form-control">
                                                        <option value="">{{__('admin.brand')}}</option>
                                                        @foreach(\App\Models\Brand::get() as $brand)
                                                        <option value="{{$brand->id}}" {{request()->get('brand_id') == $brand->id ? 'selected' : ''}}>{{$brand->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group  col-lg-2 ">
                                                    <select name="type_id" class="form-control">
                                                        <option value="">{{__('admin.type')}}</option>
                                                        @foreach(\App\Models\Type::get() as $type)
                                                        <option value="{{$type->id}}" {{request()->get('type_id') == $type->id ? 'selected' : ''}}>{{$type->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @endif
                                                <div class="form-group col-lg-2">
                                                    <button class="btn btn-primary " id="search-btn">{{__('admin.filter_results')}}</button>
                                                </div>
                                            </div>
                                        </form>
                                        <form id="cars-list" action="/admin/cars/list/refresh" method="post">
                                            @csrf
                                          
                                            <table id="datatable-cars" class="table style-3  table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">{{__('admin.id')}}</th>
                                                        <th class="text-center">{{__('admin.image')}}</th>
                                                    
                                                        <th class="text-center">{{__('admin.name')}}</th>
                                                        <th class="text-center">{{__('admin.price')}}</th>
                                                        @if(auth()->user()->type == "admin")
                                                        <th class="text-center">{{__('admin.office')}}</th>
                                                        @endif
                                                        @if(request()->get('type') != 'yacht')
                                                        <th class="text-center">{{__('admin.brand')}}</th>
                                                        @endif
                                                        <th class="text-center">{{__('admin.model')}}</th>
                                                        @if(request()->get('type') != 'yacht')
                                                        <th class="text-center">{{__('admin.type')}}</th>
                                                        @endif
                                                        <th class="text-center">{{__('admin.year')}}</th>
                                                        <th class="text-center">{{__('admin.color')}}</th>
                                                        <th class="text-center">{{__('admin.status')}}</th>
                                                        <th class="text-center">{{__('admin.view')}}</th>
                                                        <th class="text-center dt-no-sorting">{{__('admin.actions')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($data as $item)
                                                    <tr data-id="{{$item->id}}">
                                                        <td class="text-center select-checkbox">
                                                            <div class="car-id-holder">
                                                                <input type="checkbox" name="cars[]" value="{{$item->id}}" />
                                                                {{$item->id}}
                                                            </div>
                                                        </td>
                                                       
                                                        <td class="text-center">
                                                            <img src="{{url('/')}}/storage/{{\App\Helpers\WebpImage::generateUrl($item->image)}}" class="table-img">
                                                        </td>
                                                        <td class="text-center"> 
                                                            {{$item->name}}
                                                            @if($item->refreshed_at)
                                                            <br/><span style="color:green;font-weight:bold;font-size:9pt;">{{__('admin.refreshed_at')}} {{$item->refreshed_at->format('Y-m-d h:i')}}</span>
                                                            @endif
                                                         

                                                            
                                                        </td>
                                                        <td>
                                                            {{$item->price_per_day}} / @if(request()->get('type') == 'default') {{__('admin.day')}} @else {{__('admin.hour')}} @endif
                                                            @if($item->price_per_week)
                                                            <br/> {{$item->price_per_week}} / @if(request()->get('type') == 'default') {{__('admin.week')}} @else 3 {{__('admin.hours')}} @endif
                                                            @endif
                                                            @if($item->price_per_month)
                                                            <br/> {{$item->price_per_month}} / @if(request()->get('type') == 'default') {{__('admin.month')}} @else 8 {{__('admin.hours')}} @endif
                                                            @endif
                                                        </td>
                                                        @if(auth()->user()->type == "admin")
                                                        <td class="text-center">
                                                            {{$item->company ? $item->company->name : '-'}}
                                                        </td>
                                                        @endif
                                                        @if(request()->get('type') != 'yacht')
                                                        <td class="text-center">
                                                            {{$item->brand ? $item->brand->title : '-'}} 
                                                        
                                                        </td>
                                                        @endif
                                                        <td class="text-center">
                                                            {{$item->model ? $item->model->title : '-'}} 
                                                        
                                                        </td>
                                                        @if(request()->get('type') != 'yacht')
                                                        <td class="text-center">
                                                            @foreach($item->types as $type)
                                                                {{$type->title}},
                                                            @endforeach
                                                        
                                                        </td>
                                                        @endif
                                                        <td class="text-center">
                                                            {{$item->year ? $item->year->title : '-'}} 
                                                        
                                                        </td>
                                                        <td class="text-center">
                                                            {{$item->color ? $item->color->title : '-'}} 
                                                        
                                                        </td>
                                                    
                                                        <td class="text-center"> {!!$item->status == 'active' ? '<span style="color:green;font-weight:bold">' . __('admin.active') . '</span>' : '<span style="color:darkgoldenrod;font-weight:bold">'. __('admin.pending') . '</span>'!!}</td>
                                                        <td class="text-center"> {!!$item->is_publish && $item->status == 'active' ? '<span style="color:green;font-weight:bold">' . __('admin.offers') . '</span>' : '<span style="color:darkgoldenrod;font-weight:bold">'. __('admin.not') . ' ' . __('admin.offers') . '</span>'!!}</td>
                                                    
                        
                                                        <td class="text-center">
                                                            <ul class="table-controls">
                                                            
                                                                <li>
                                                                    <a class="btn btn-secondary" href="/admin/cars/{{$item->id}}/refresh">
                                                                        <span><i class="fas fa-sync-alt"></i></span>
                                                                    </a>
                                                                </li>
                                                          
                                                                @if($item->status == "active")
                                                                    <li>
                                                                        <a href="{{url('/')}}/admin/cars/{{$item->id}}/visibilty" class="bs-tooltip" title="">
                                                                        @if($item->is_publish)
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 31 31" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye-off"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>                                                                
                                                                        @else
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 27 27" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                                                        @endif
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                                @if(auth()->user()->type == "admin")
                                                                    <li>
                                                                        <a href="{{url('/')}}/admin/cars/{{$item->id}}/status" class="bs-tooltip" title="">
                                                                        @if($item->status == "active")
                                                                            <svg viewBox="0 0 29 29" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>                                                                    
                                                                        @else
                                                                            <svg viewBox="0 0 30 30" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                                                        @endif
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                                <li>
                                                                    <a href="{{url('/')}}/admin/cars/{{$item->id}}/edit" class="bs-tooltip"  ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{url('/')}}/admin/cars/{{$item->id}}/delete" class="bs-tooltip"  >
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>                                                                    
                                                                    </a>
                                                                </li>

                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    @endforeach
    
                                                </tbody>
                                            </table>
                                            {{$data->appends(request()->query())->links() }}

                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

@endsection