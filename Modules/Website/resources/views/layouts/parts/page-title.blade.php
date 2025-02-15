    <div class="col-lg-12">
        <div class="product-page__header">
            @if(isset($car))
                <h1> {{__('lang.Rent') }} {{$title}}  -  {{ ($car?->company?->name ?? '') .  ($car?->id ?  (' #' . $car?->id) : '')  }} </h1>
            @else
                <h1>{{$title}}</h1>
            @endif

            @if($description)
                <p>{!!$description!!}</p>
                <span  class="read-more-page ">{{__('lang.Read More')}}</span>
            @endif
        </div>
    </div>
