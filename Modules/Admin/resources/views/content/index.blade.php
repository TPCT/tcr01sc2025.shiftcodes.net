@extends('admin::layouts.master')

@section('content')
            <div class="layout-px-spacing">
                <form action="{{url('/')}}/admin/content/{{$content->type}}" method="post" enctype="multipart/form-data">
                    @method("PUT")
                    @csrf
                    <div class="page__header_title custom__page_header_title">
                        <h4>{{__('admin.content')}} {{__('admin.page')}}
                            @if($content->type == "home")
                                {{__('admin.home')}}
                            @elseif($content->type == "driver")
                                {{__('admin.cars_with_driver')}}
                            @elseif($content->type == "yacht")
                            {{__('admin.yacht_rental')}}
                            @elseif($content->type == "listcar")
                            {{__('admin.add_your_car')}}
                            @endif
                        </h4>
                        <button class="btn btn-primary btn-rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                            {{__('admin.save')}}

                        </button>
                    </div>


                    <div class="row layout-spacing">
                        @include("admin::layouts.parts.app.alerts")


                        <div class="col-lg-12">
                            @include("admin::layouts.parts.content", [
                                "content" => $content,
                                "seo" => $seo,
                                "faq" => $faq
                            ])
                        </div>


                    </div>

                </form>



            </div>

@endsection
