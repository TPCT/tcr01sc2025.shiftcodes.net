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
                                <i class='fas fa-car'></i>
                            </div>
                            <div class="w-content">
                                <span class="w-value">{{$cars_count}}</span>
                                <span class="w-numeric-title">{{__('admin.cars')}}</span>
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
                                <i class="fas fa-sync-alt"></i>
                            </div>
                            <div class="w-content">
                                <span class="w-value">{{$refresh_count}}</span>
                                <span class="w-numeric-title">{{__('admin.refreshes')}}</span>
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
                                <i class="fas fa-eye"></i>
                            </div>
                            <div class="w-content">
                                <span class="w-value">{{$visits}}</span>
                                <span class="w-numeric-title">{{__('admin.visits')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                <div class="widget-one widget ">
                    <div class="widget-content">
                        <div class="w-numeric-value">
                            <div class="w-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="w-content">
                                <span class="w-value">{{$phone}}</span>
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
                                <span class="w-value">{{$whatsapp}}</span>
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
                                <span class="w-value">{{$email}}</span>
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
                            <th class="text-center">{{__('admin.date')}}</th>
                            <th class="text-center">{{__('admin.phone_calls')}}</th>
                            <th class="text-center">{{__('admin.whatsapp')}}</th>
                            <th class="text-center">{{__('admin.email')}}</th>
                            <th class="text-center">{{__('admin.visits')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($actions as $action)
                           <tr>
                               <td class="text-center">{{$action->date}}</td>
                               <td class="text-center">{{$action->phone ?? 0}}</td>
                               <td class="text-center">{{$action->whatsapp ?? 0}}</td>
                               <td class="text-center">{{$action->email ?? 0}}</td>
                               <td class="text-center">{{auth()->user()->company->getViewsCountDate($action->date)}}</td>
                           </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    {{$actions->links()}}
                    <br/>
                    <br/>
                </div>

            </div>



        </div>
