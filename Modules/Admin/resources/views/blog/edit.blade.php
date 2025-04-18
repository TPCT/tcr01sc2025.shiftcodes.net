@extends('admin::layouts.master')

@section('content')
    <div class="layout-px-spacing">
        <form action="{{url('/')}}/admin/blog/{{$item->id}}" method="post" enctype="multipart/form-data">
            @method("PUT")
            @csrf
            <div class="page__header_title custom__page_header_title">
                <h4>{{__('admin.edit')}} {{__('admin.article')}}</h4>
                <button class="btn btn-primary btn-rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                    {{__('admin.save')}}

                </button>
            </div>

            <div class="row layout-spacing">
                @include("admin::layouts.parts.app.alerts")
                <div class="col-lg-10">
                    <div class="statbox widget box box-shadow mb-20">

                        <div class="widget-content widget-content-area">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                                @foreach(\Config::get("app.languages") as $key => $value)
                                <div class="form-group row mb-4">
                                    <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.title')}} {{$value}}</label>
                                    <div class="col-xl-9 col-lg-9 col-sm-10">
                                        <input  type="text" required class="form-control" value="{{$item->getTranslation('title', $key)}}" name="title_{{$key}}" >
                                    </div>
                                </div>
                                @endforeach

                                @foreach(\Config::get("app.languages") as $key => $value)
                                <div class="form-group row mb-4">
                                    <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.content')}} {{$value}}</label>
                                    <div class="col-xl-9 col-lg-9 col-sm-10">
                                        <textarea  class="form-control body" name="content_{{$key}}" >{!!$item->getTranslation('content', $key)!!}</textarea>
                                    </div>
                                </div>
                                @endforeach

                                <div class="form-group row mb-4">
                                    <label for="hPassword" class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.image')}}</label>
                                    <div class="col-xl-9 col-lg-9 col-sm-10">
                                        <div class="custom-file">
                                            <input type="file"  class="custom-file-input" accept="image/*" name="image" id="customFile">
                                            <label class="custom-file-label" for="customFile">{{__('admin.choose_file')}}</label>
                                        </div>
                                        @if($item->image)
                                        <img src="{{url('/')}}/storage/{{\App\Helpers\WebpImage::generateUrl($item->image)}}" style="width: 100px; margin-top: 10px;">
                                        @endif
                                    </div>
                                </div>

                                @foreach(\Config::get("app.languages") as $key => $value)
                                    <div class="form-group row mb-4">
                                        <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.meta_description')}} {{$value}}</label>
                                        <div class="col-xl-9 col-lg-9 col-sm-10">
                                            <input  type="text" required class="form-control" value="{{$item->seo->getTranslation('description', $key)}}" name="description_{{$key}}">
                                        </div>
                                    </div>
                                @endforeach

                                @foreach(\Config::get("app.languages") as $key => $value)
                                    <div class="form-group row mb-4">
                                        <label class="col-xl-3 col-sm-3 col-sm-2 col-form-label">{{__('admin.meta_keywords')}} {{$value}}</label>
                                        <div class="col-xl-9 col-lg-9 col-sm-10">
                                            <input  type="text" required class="form-control" value="{{$item->seo->getTranslation('keywords', $key)}}" name="keywords_{{$key}}">
                                        </div>
                                    </div>
                                @endforeach

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </form>

    </div>
@endsection
@section('js')
<script>
  tinymce.init({
    selector: 'textarea.body',
    directionality: "rtl",
    plugins: 'autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
  });
</script>
@endsection
