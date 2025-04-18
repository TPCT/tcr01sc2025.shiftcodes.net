    @if($content)
    @if($content->title || $content->description || $content->image)
        <section class="home__about">
            <div class="container">
                <div class="row">
                    @if($content->image)
                    <div class="col-lg-6">
                        <img loading="lazy" width="550" height="350" alt="{{$content->title}}" src="{{asset("/storage/") . "/" . \App\Helpers\WebpImage::generateUrl($content->image)}}" />
                    </div>
                    @endif
                    <div class="col-lg-6">
                        <div class="home__about_content">
                            @if($content->title)
                            <h1>{{$content->title}}</h1>
                            @endif
                            {!! $content->description !!}

                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if($content->title_2 || $content->description_2 || $content->image_2)
        <section class="home__about">
            <div class="container">
                <div class="row">
                    @if($content->image_2)
                    <div class="col-lg-6">
                        <img loading="lazy" width="550" height="350" alt="{{$content->title_2}}" src="{{asset("/storage/{$content->image_2}")}}" />
                    </div>
                    @endif
                    <div class="col-lg-6">
                        <div class="home__about_content">
                            @if($content->title_2)
                            <h2>{{$content->title_2}}</h2>
                            @endif
                            {!! $content->description_2 !!}

                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if($content->title_3 || $content->description_3 || $content->image_3)
        <section class="home__about">
            <div class="container">
                <div class="row">
                    @if($content->image_3)
                    <div class="col-lg-6">
                        <img loading="lazy" width="550" height="350" alt="{{$content->title_3}}" src="{{asset("/storage/{$content->image_3}")}}" />
                    </div>
                    @endif
                    <div class="col-lg-6">
                        <div class="home__about_content">
                            @if($content->title_3)
                            <h3>{{$content->title_3}}</h3>
                            @endif
                            {!! $content->description_3 !!}

                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif


    @endif
