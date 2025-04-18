@php
if (isset($resource)) {
    $title = $resource->page_title;
} elseif (isset($seo) && $seo->meta_title) {
}elseif(isset($car)){
    $title = __('lang.Rent') . " " . $title;
}
@endphp
    <title>{{ $title}}</title>
    <meta property="og:title" content="{{$title}}"/>
    <meta name="twitter:title" content="{{$title}}" />
    <meta name="twitter:card" content="{{$title}}" />
    <meta name="twitter:site" content="{{$title}}">

@if(isset($car))
    @php
        $desc = (explode("<br/>", explode("\n", $car->getFeatures())[0] ?? "")[0] ?: "") .  '#' . $car->id ;
    @endphp
        <meta name="description" content="{{$desc}}">
        <meta property="og:description" content="{{$desc}}" />
        <meta name="twitter:description" content="{{$desc}}" />

    @elseif(\Request::route()?->getName() == 'company')
        <meta name="description" content="{{$company->description}}">
        <meta property="og:description" content="{{$company->description}}" />
        <meta name="twitter:description" content="{{$company->description}}" />
    @else
        @if($seo && $seo->description)
        <meta name="description" content="{{$seo->description}}">
        <meta property="og:description" content="{{$seo->description}}" />
        <meta name="twitter:description" content="{{$seo->description}}" />
        @endif
@endif

@if($seo)
    @if($seo->keywords)
        <meta name="keywords" content="{{$seo->keywords}}" />
    @elseif($seo->description)
        <meta name="description" content="{{$seo->description}}">
        <meta property="og:description" content="{{$seo->description}}" />
        <meta name="twitter:description" content="{{$seo->description}}" />
    @endif
@endif

@if($image)
    <meta property="og:image" content="{{$image}}"/>
    <meta property="og:image:secure_url" content="{{$image}}"/>
    <meta name="twitter:image" content="{{$image}}">
    <meta name="thumbnail" content="{{$image}}">

    <meta property="og:image:height" content="600"/>
    <meta property="og:image:width" content="400"/>
    <meta property="og:image:alt" content=""/>
    <meta property="og:image:type" content="image/webp"/>
@endif
