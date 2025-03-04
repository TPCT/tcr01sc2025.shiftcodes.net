    <div class="col-lg-12">
        <ul class="breadcrumb-list">
            <li>
                <a href="{{LaravelLocalization::getLocalizedUrl(null, route('home'))}}">{{__('lang.Home')}}</a>
            </li>
            @foreach($breadcrumbs ?? [] as $title => $url)
                <li>
                    @if(app()->getLocale() == 'ar')
                        <i class="fa fa-angle-left"></i>
                    @else
                        <i class="fa fa-angle-right"></i>
                    @endif
                </li>
                <li>
                    @if ($url)
                        <a class="link @if($loop->last) active @endif" href="{{$url}}">
                            <span> {{$title}}</span>
                        </a>
                    @else
                        <span class="@if ($loop->last) active @endif">{{$title}}</span>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

    @section('breadcrumbs')
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement":
            [
                {
                    "@type": "ListItem",
                    "position": 1,
                    "item":
                    {
                        "@id": "{{LaravelLocalization::localizeUrl("/")}}",
                        "name": "Home"
                    }
                },
                {
                    "@type": "ListItem",
                    "position": 2,
                    "item":
                    {
                        "@id": "{{url()->full() }}",
                        "name": "{{$title_1 ?? ''}}"
                    }
                },
                {
                    "@type": "ListItem",
                    "position": 3,
                    "item":
                    {
                        "@id": "{{url()->full() }}",
                        "name": "{{$title_2 ?? ''}}"
                    }
                }
            ]
        }
        </script>
    @endsection
