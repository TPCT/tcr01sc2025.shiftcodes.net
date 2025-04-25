<div class="row">

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
    <form id="home-filter" action="/admin" method="get">
        <div class="home-filter">
            <p>{{__('admin.period')}}:</p>
            <select class="form-control home-period-filter" name="period" id="exampleFormControlSelect1">
                @foreach(\App\Helpers\Utilities::getPeriods() as $key => $value)
                    <option @if(request()->get('period') == $key) selected @endif value="{{$key}}">{{$value}}</option>
                @endforeach
            </select>
        </div>
    </form>
</div>



    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
        <div class="widget-one widget ">
            <div class="widget-content">
                <div class="w-numeric-value">
                    <div class="w-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="w-content">
                        <span class="w-value">{{$total_phone}}</span>
                        <span class="w-numeric-title">{{__('admin.phone_calls')}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
        <div class="widget-one widget widget-bg-2">
            <div class="widget-content">
                <div class="w-numeric-value">
                    <div class="w-icon">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div class="w-content">
                        <span class="w-value">{{$total_whatsapp}}</span>
                        <span class="w-numeric-title">{{__('admin.whatsapp')}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
        <div class="widget-one widget widget-bg-3">
            <div class="widget-content">
                <div class="w-numeric-value">
                    <div class="w-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="w-content">
                        <span class="w-value">{{$total_email}}</span>
                        <span class="w-numeric-title">{{__('admin.email')}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">

        <table id="style-3" class="table style-3  table-hover">
            <thead>
                <tr>
                    <th class="text-center">{{__('admin.Office')}}</th>
                    <th class="text-center">{{__('admin.phone_calls')}}</th>
                    <th class="text-center">{{__('admin.whatsapp')}}</th>
                    <th class="text-center">{{__('admin.email')}}</th>
                    <th class="text-center">{{__('admin.visits')}}</th>
                </tr>
            </thead>
            <tbody>
                <!-- loop through dates from beginig of company created_at until today -->
                @foreach($companies as $company)
                <tr>
                    <td class="text-center">{{$company->name}}</td>
                    <td class="text-center">{{$company->getActionsByType('phone',null)}}</td>
                    <td class="text-center">{{$company->getActionsByType('whatsapp',null)}}</td>
                    <td class="text-center">{{$company->getActionsByType('email',null)}}</td>
                    <td class="text-center">{{$company->getViewsCount(null)}}</td>
                </tr>
                @endforeach

            </tbody>
        </table>


        </div>

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">

    {{$companies->links()}}

    <br/>
    <br/>
    </div>

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">

<table id="style-3" class="table style-3  table-hover">
    <thead>
        <tr>
            <th class="text-center">{{__('admin.Action')}}</th>
            <th class="text-center">{{__('admin.Office')}}</th>
            <th class="text-center">{{__('admin.Car')}}</th>
            <th class="text-center">{{__('admin.Date')}}</th>

        </tr>
    </thead>
    <tbody>
        @foreach($actions as $action)
        <tr>
            <td class="text-center">{{$action->type}}</td>
            <td class="text-center">{{$action->company?->name ?? '' }}</td>
            <td class="text-center">{{$action->car?->name ?? '' }}</td>
            <td class="text-center">{{$action->created_at->format('Y-m-d h:i a')}}</td>
        </tr>
        @endforeach


    </tbody>
</table>


</div>

<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">

{{$actions->links()}}
</div>



</div>
