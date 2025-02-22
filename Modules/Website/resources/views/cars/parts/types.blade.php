@if(count($types) > 0)
    <div class="col-lg-12">
        <ul class="product-page__sub_categories">
            @foreach($types as $type)
            @if($company_id)
                <li><a href="{{LaravelLocalization::localizeUrl("/t/{$type->sync_id}/{$type->slug}?company_id={$company_id}")}}">{{$type->title}}</a></li>
            @else
                <li><a href="{{LaravelLocalization::localizeUrl("/t/{$type->sync_id}/{$type->slug}")}}">{{$type->title}}</a></li>
            @endif
            @endforeach
        </ul>
    </div>
@endif
