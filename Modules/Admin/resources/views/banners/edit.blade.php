@extends('admin::layouts.master')

@section('content')

            <div class="layout-px-spacing">
                <form action="{{url('/')}}/admin/banners/{{$item->id}}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="page__header_title custom__page_header_title">
                        <h4>{{__('admin.edit')}} {{__('admin.banner')}}</h4>
                        <button class="btn btn-primary btn-rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                            {{__('admin.save')}} 

                        </button>
                    </div>



                    <div class="row layout-spacing">
                        @include("admin::layouts.parts.app.alerts")
                        <div class="col-lg-7">
                            <div class="statbox widget box box-shadow">

                                <div class="widget-content widget-content-area">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.name')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input value="{{$item->title}}" type="text" required class="form-control" name="title" >
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label for="hPassword" class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.image')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <div class="custom-file">
                                                    <input type="file"  class="custom-file-input" accept="image/*" name="image" id="customFile">
                                                    <label class="custom-file-label" for="customFile">{{__('admin.choose_file')}}</label>
                                                </div>
                                                @if($item->image)
                                                <a href="{{url('/')}}/storage/{{\App\Helpers\WebpImage::generateUrl($item->image)}}" target="_blank">
                                                    <img class="image-form" src="{{url('/')}}/storage/{{\App\Helpers\WebpImage::generateUrl($item->image)}}" width="100" height="100" alt="">
                                                </a>
                                                @endif
                                            
                                            </div>

                                        </div>  

                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.office')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <select class="form-control" name="company_id">
                                                    <option value="">{{__('admin.choolse_from_list')}}</option>
                                                    @foreach(\App\Models\Company::all() as $company)
                                                        <option @if($item->company_id == $company->id) selected @endif value="{{$company->id}}">{{$company->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>                                        
                                        
                                        <div class="form-group row mb-4">
                                            <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.or')}} {{__('admin.link')}}</label>
                                            <div class="col-xl-9 col-lg-9 col-sm-10">
                                                <input value="{{$item->link}}" type="text"  class="form-control" name="link" >
                                            </div>
                                        </div>
  

                                        
                                        
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
              
              
                    </div>

                </form>

            </div>

@endsection