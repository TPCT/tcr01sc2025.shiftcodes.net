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
                                            <h4>{{__('admin.pages')}}</h4>
                                            <a href="{{url('/')}}/admin/pages/create" class="btn btn-primary btn-rounded">
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
                                                    
                                                    <th class="text-center">{{__('admin.name')}}</th>
                                                    <th class="text-center">{{__('admin.link')}}</th>
 
                                                    <th class="text-center dt-no-sorting">{{__('admin.actions')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $item)
                                                <tr>
                                                    
                                                   
                                                    <td class="text-center">
                                                        @foreach(\Config::get("app.languages") as $key => $value)
                                                            {{$item->getTranslation("name",$key)}} <br/>
                                                        @endforeach
                                                    </td>
                                                    <td class="text-center">{{$item->slug}}</td>
                                                   
                       
                                                    <td class="text-center">
                                                        <ul class="table-controls">
                                                            <li>
                                                                <a href="{{url('/')}}/admin/pages/{{$item->id}}/edit" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{__('admin.edit')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                                </a>
                                                             </li>
                                                            <li>
                                                                <form action="{{url('/')}}/admin/pages/{{$item->id}}" method="post">
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