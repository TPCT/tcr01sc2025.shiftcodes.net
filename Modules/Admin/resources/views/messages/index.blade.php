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
                                                {{__('admin.messages')}}
                                            </h4>
     
                                        </div>
                                       
                                    </div>                 
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                 
                                <div class="row">
                                    @include("admin::layouts.parts.app.alerts")
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <table id="style-3" class="table style-3  table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">{{__('admin.name')}}</th>
                                                    <th class="text-center">{{__('admin.email')}}</th>
                                                    <th class="text-center">{{__('admin.phone')}}</th>
                                                    <th class="text-center">{{__('admin.msg')}}</th>
                                              
                                                    <th class="text-center">{{__('admin.date')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $item)
                                                <tr>
                                                    
                                         
                                                    <td class="text-center">
                                                        {{$item->name}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$item->email}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$item->phone}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$item->message}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$item->created_at->format('Y-m-d h:i a')}}
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