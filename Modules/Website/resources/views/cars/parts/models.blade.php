    @if(count($models) > 0)
        <div class="col-lg-12">
            <ul class="product-page__sub_categories">
                @foreach($models as $model)
                    <li><a href="{{ LaravelLocalization::getLocalizedUrl(null, route('website.cars.brands.models', ['brand' => $resource, 'model' => $model])) }}">{{__('lang.Rent')}} {{$model->title}} ({{$model->cars()->count()}})</a></li>
                @endforeach
            </ul>
            <span  class="expand-models">{{__('lang.Read More')}}</span>

        </div>
    @endif
