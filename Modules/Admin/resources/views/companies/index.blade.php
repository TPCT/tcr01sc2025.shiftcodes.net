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
                                            <h4>{{__('admin.offices')}}
                                                @if(request()->get('type') == 'default')
                                                    {{__('admin.rental_no_driver')}}
                                                @elseif(request()->get('type') == 'driver')
                                                   {{__('admin.rental_with_driver')}}
                                                @elseif(request()->get('type') == 'yacht')
                                                    {{__('admin.yacht_rental')}}
                                                @endif
                                            </h4>
                                            <a href="{{url('/')}}/admin/companies/create?type={{request()->get('type')}}" class="btn btn-primary btn-rounded">
                                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                                {{__('admin.add')}} {{__('admin.office_singular')}}
                                            </a>
                                        </div>
                                       
                                    </div>                 
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                 
                                <div class="row">
                                    @include("admin::layouts.parts.app.alerts")
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <form action="/admin/companies" method="get">
                                            <div class="filter row">
                                                <div class="form-group col-lg-3">
                                                    <input type="text" value="{{request()->get('search')}}" class="form-control" name="search" id="search" placeholder="{{__('admin.search')}} {{__('admin.office_singular')}}">
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <input type="hidden" name="type" value="{{request()->get('type')}}">
                                                    <button class="btn btn-primary" id="search-btn">{{__('admin.filter_results')}}</button>
                                                </div>
                                            </div>
                                        </form>
                                        <table id="style-3" class="table style-3  table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">{{__('admin.image')}}</th>
                                                    <th class="text-center">{{__('admin.name')}} {{__('admin.office')}}</th>
                                                    <th class="text-center">{{__('admin.name')}} {{__('admin.owner')}} {{__('admin.office')}}</th>
                                                    <th class="text-center">{{__('admin.username')}}</th>
                                                    <th class="text-center">{{__('admin.password')}}</th>
                                                    <th class="text-center">{{__('admin.title')}}</th>
                                                    <th class="text-center">{{__('admin.phone')}}</th>
                                                    <th class="text-center">{{__('admin.status')}}</th>
                                                    <th class="text-center dt-no-sorting">{{__('admin.actions')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $item)
                                                <tr>
                                                    
                                                    <td class="text-center">
                                                        <img src="{{url('/')}}/storage/{{\App\Helpers\WebpImage::generateUrl($item->image)}}" class="table-img">
                                                    </td>
                                                    <td class="text-center"> 
                                                        {{$item->name}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$item->user ? $item->user->name : ''}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$item->user ? $item->user->username : ''}} 
                                                       
                                                    </td>
                                                    <td class="text-center">
                                                        {{$item->password}} 
                                                       
                                                    </td>
                                                    <td class="text-center">
                                                        {{$item->country->title}}<br/>
                                                        <a style="color:blue" href="{{$item->address}}" target="_blank">عرض الخريطة</a>
                                                    </td>
                                                    <td class="text-center"> 
                                                        {{$item->phone_01}}
                                                        @if($item->phone_02)
                                                        <br/> {{$item->phone_02}}
                                                        @endif
                                                        @if($item->phone_03)
                                                        <br/> {{$item->phone_03}} <br/>
                                                        @endif

                                                    </td>
                                                    <td class="text-center"> {!!$item->status ? '<span style="color:green;font-weight:bold">' . __('admin.active') . '</span>' : '<span style="color:gold;font-weight:bold">' . __('admin.not') . " " .  __('admin.active') . '</span>'!!}</td>
                                                   
                       
                                                    <td class="text-center">
                                                        <ul class="table-controls">
                                                            <li>
                                                                <a href="{{url('/')}}/admin/companies/{{$item->id}}/edit" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{__('admin.edit')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                                </a>
                                                             </li>
                                                            <li>
                                                                <form action="{{url('/')}}/admin/companies/{{$item->id}}" method="post">
                                                                    @csrf
                                                                    @method("DELETE")
                                                                    <button class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{__('admin.delete')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                @endforeach
 
                                            </tbody>
                                        </table>
                                        {{$data->links()}}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

@endsection