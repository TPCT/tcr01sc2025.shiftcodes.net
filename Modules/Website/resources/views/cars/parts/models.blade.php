    @if(count($models) > 0)
        <div class="col-lg-12">
            <ul class="product-page__sub_categories">
                @foreach($models as $model)
{{--                    {{ dd( [$model->brand_id, $model->brand->slug, $model->slug] ) }}--}}
                    {{--                    {{ secure_url('/')}}/{{\Request::path()}}?model_id={{$model->id}}--}}
                    <li><a href="{{ url('/')}}/{{\Request::path()}}?model_id={{$model->id}}">{{__('lang.Rent')}} {{$model->title}} ({{$model->cars()->count()}})</a></li>
{{--                    <li><a href="{{ route('website.brands.models', [$model->brand_id, $model->brand->slug, $model->slug]) }}">{{__('lang.Rent')}} {{$model->title}} ({{$model->cars()->count()}})</a></li>--}}
                @endforeach
            </ul>
            <span  class="expand-models">{{__('lang.Read More')}}</span>

        </div>
    @endif
