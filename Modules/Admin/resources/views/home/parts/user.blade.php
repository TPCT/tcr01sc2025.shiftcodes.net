    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
            <form id="home-filter" action="/admin" method="get">
                <div class="home-filter">
                    <p>{{__('admin.period')}}:</p>
                    <select class="form-control home-period-filter" name="period" id="exampleFormControlSelect1">
                        <option value="">{{__('admin.all')}}</option>
                        <option @if(request()->get('period') == "today") selected @endif value="today">{{__('admin.today')}}</option>
                        <option @if(request()->get('period') == "yesterday") selected @endif value="yesterday">{{__('admin.yesterday')}}</option>
                        <option @if(request()->get('period') == "week") selected @endif value="week">{{__('admin.week')}}</option>
                        <option @if(request()->get('period') == "month") selected @endif value="month">{{__('admin.month')}}</option>
                        <option @if(request()->get('period') == "year") selected @endif value="year">{{__('admin.year')}}</option>

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
                                <span class="w-value">{{auth()->user()->company->getCarsCount()}} / {{auth()->user()->company->getCarsLimit()}}</span>
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
                                <span class="w-value">{{auth()->user()->company->getRefreshCarsCount()}} / {{auth()->user()->company->getRefreshLimit()}}</span>
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
                                <span class="w-value">{{auth()->user()->company->getViewsCount(request()->get('period'))}}</span>
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
                                <span class="w-value">{{auth()->user()->company->getActionsByType('phone',request()->get('period'))}}</span>
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
                                <span class="w-value">{{auth()->user()->company->getActionsByType('whatsapp',request()->get('period'))}}</span>
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
                                <span class="w-value">{{auth()->user()->company->getActionsByType('email',request()->get('period'))}}</span>
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
                        <!-- loop through dates from beginig of company created_at until today -->
                        @for($i = now()->format('Y-m-d'); $i >= auth()->user()->company->created_at->format('Y-m-d'); $i = \Carbon\Carbon::parse($i)->subDay()->format('Y-m-d'))
                        <tr>
                            <td class="text-center">{{$i}}</td>
                            <td class="text-center">{{auth()->user()->company->getActionsByTypeDate('phone',$i)}}</td>
                            <td class="text-center">{{auth()->user()->company->getActionsByTypeDate('whatsapp',$i)}}</td>
                            <td class="text-center">{{auth()->user()->company->getActionsByTypeDate('email',$i)}}</td>
                            <td class="text-center">{{auth()->user()->company->getViewsCountDate($i)}}</td>
                        </tr>
                        @endfor

                    </tbody>
                </table>


            </div>



        </div>
