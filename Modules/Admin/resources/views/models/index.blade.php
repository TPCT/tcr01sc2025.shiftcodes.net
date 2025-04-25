@extends('admin::layouts.master')
@section('modals')
    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">{{__('admin.add')}}</h5>
                </div>
                <form action="{{url('/')}}/admin/models"  method="post" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    @foreach(\Config::get("app.languages") as $key => $value)
                    <div class="form-group row mb-4">
                        <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.name')}} {{$value}}</label>
                        <div class="col-xl-9 col-lg-9 col-sm-10">
                            <input type="text" required class="form-control" name="title_{{$key}}" >
                        </div>
                    </div>
                    @endforeach

                    @foreach(\Config::get("app.languages") as $key => $value)
                        <div class="form-group row mb-4">
                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.title')}} {{__('admin.page')}} {{$value}}</label>
                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                <input type="text" required class="form-control" name="page_title_{{$key}}" >
                            </div>
                        </div>
                    @endforeach
                  
                    @foreach(\Config::get("app.languages") as $key => $value)
                    <div class="form-group row mb-4">
                        <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.description')}} {{__('admin.page')}} {{$value}}</label>
                        <div class="col-xl-9 col-lg-9 col-sm-10">
                            <textarea class="form-control" name="page_description_{{$key}}"></textarea>
                        </div>
                    </div>
                    @endforeach

                                      
                    @foreach(\Config::get("app.languages") as $key => $value)
                    <div class="form-group row mb-4">
                        <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.feautres')}} {{__('admin.car')}} {{$value}}</label>
                        <div class="col-xl-9 col-lg-9 col-sm-10">
                            <textarea class="form-control" name="page_features_{{$key}}"></textarea>
                        </div>
                    </div>
                    @endforeach

                    @if(request('type') == 'car')
                    <div class="form-group row mb-4">
                        <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.brand')}}</label>
                        <div class="col-xl-9 col-lg-9 col-sm-10">
                            <select required class="form-control" name="brand_id">
                                <option value="">{{__('admin.brand')}}</option>
                                @foreach(\App\Models\Brand::all() as $brand)
                                    <option value="{{$brand->id}}">{{$brand->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif

                    @include("admin::layouts.parts.content", [
                            "content" => null,
                            "seo"     => null,
                            "faq"     => null
                    ])  
         
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> {{__('admin.cancel')}}</button>
                    <input type="hidden" name="type" value="{{request('type')}}">
                    <button type="submit" class="btn btn-primary">{{__('admin.save')}}</button>
                </div>
                </form>
            </div>
        </div>
    </div>
        <!-- Modal -->
        <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Import Content</h5>
                </div>
                <form action="{{url('/')}}/admin/models/content/import"  method="post" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                    
                    <div class="form-group row mb-4">
                        <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">Excel File</label>
                        <div class="col-xl-9 col-lg-9 col-sm-10">
                            <input type="file" required class="form-control" name="file" >
                        </div>
                    </div>
               

             
 

    
         
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> {{__('admin.cancel')}}</button>
                   
                    <button type="submit" class="btn btn-primary">{{__('admin.save')}}</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
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
                                                {{__('admin.models')}}
                                                @if(request('type') == 'car')
                                                {{__('admin.cars')}}
                                                @elseif(request('type') == 'yacht')
                                                {{__('admin.yacht')}}
                                                @endif
                                            </h4>
                                            <div style="margin-right:auto;display:flex;align-items:center;gap:10px">
                                            <button data-toggle="modal" data-target="#addModal" class="btn btn-primary btn-rounded">
                                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                                {{__('admin.add')}}

                                            </button>
                                            <button data-toggle="modal" data-target="#importModal" class="btn btn-primary btn-rounded">
                                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                                Import

                                            </button>

                                        </div>
                                        </div>
                                       
                                    </div>                 
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                
                                        <form action="/admin/models" method="get">
                                            <input type="hidden" name="type" value="{{request('type')}}">
                                            <div class="filter row">
                                                <div class="form-group col-lg-2">
                                                    <input type="text" value="{{request()->get('search')}}" class="form-control" name="search" id="search" placeholder="{{__('admin.search')}} ">
                                                </div>

                                                <div class="form-group col-lg-3">
                                                    <select class="form-control" name="brand_id">
                                                        <option value="">{{__('admin.brand')}}</option>
                                                        @foreach(\App\Models\Brand::all() as $brand)
                                                            <option @if(request()->get('brand_id') == $brand->id) selected @endif value="{{$brand->id}}">{{$brand->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group col-lg-2">
                                                    <button class="btn btn-primary " id="search-btn">{{__('admin.filter_results')}}</button>
                                                </div>
                                            </div>
                                        </form>
                                <div class="row">
                                    @include("admin::layouts.parts.app.alerts")
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <table id="style-3" class="table style-3  table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">ID</th>
                                                    <th class="text-center">{{__('admin.name')}}</th>
                                                    @if(request('type') == 'car')
                                                    <th class="text-center">{{__('admin.brand')}}</th>
                                                    @endif
        
 
                                                    <th class="text-center dt-no-sorting">{{__('admin.actions')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $item)
                                                <tr>
                                                    
                                                    <td class="text-center">{{$item->id}}</td>
                                                    <td class="text-center">
                                                        @foreach(\Config::get("app.languages") as $key => $value)
                                                            {{$item->getTranslation("title",$key)}} <br/>
                                                        @endforeach
                                                    </td>
                                                    @if(request('type') == 'car')
                                                    <td class="text-center">
                                                        @foreach(\Config::get("app.languages") as $key => $value)
                                                            {{$item->brand->getTranslation("title",$key)}} <br/>
                                                        @endforeach
                                                    </td>
                                                    @endif
                                                   
                       
                                                    <td class="text-center">
                                                        <ul class="table-controls">
                                                            <li>
                                                                <a href="{{url('/')}}/admin/models/{{$item->id}}/edit" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{__('admin.edit')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                                </a>
                                                             </li>
                                                            <li>
                                                                <form action="{{url('/')}}/admin/models/{{$item->id}}" method="post">
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
                                        {{$data->appends(request()->query())->links() }}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

@endsection