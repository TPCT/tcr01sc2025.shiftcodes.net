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
                                                {{__('admin.notifications')}}
                                            </h4>
                                            <a href="/admin/notifications/create" class="btn btn-primary btn-rounded">
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
                                        <table id="style-3" class="table style-3  table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">{{__('admin.title')}}</th>
                                                    <th class="text-center">{{__('admin.content')}}</th>
                                                    <th class="text-center">{{__('admin.date')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $item)
                                                <tr>
                                                    
                                         
                                                    <td class="text-center">
                                                        {{$item->title}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$item->body}}
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