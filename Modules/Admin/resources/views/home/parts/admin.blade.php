       

            <div class="row  layout-top-spacing">
                <div class=" col-lg-6 ">
                    <div class="widget-one widget">
                        <div class="widget-content">
                            <div class="w-numeric-value">
                                <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>                            </div>
                                <div class="w-content">
                                    <span class="w-value">{{\App\Models\Car::count()}}</span>
                                    <span class="w-numeric-title">{{__('admin.total')}} {{__('admin.cars')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" col-lg-6 ">
                    <div class="widget-one widget widget-bg-2 ">
                        <div class="widget-content">
                            <div class="w-numeric-value">
                                <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>                            </div>
                                <div class="w-content">
                                    <span class="w-value">{{\App\Models\Company::count()}}</span>
                                    <span class="w-numeric-title">{{__('admin.total')}} {{__('admin.rental_offices')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" col-lg-6 ">
                    <div class="widget-one widget widget-bg-3 ">
                        <div class="widget-content">
                            <div class="w-numeric-value">
                                <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>                            </div>
                                <div class="w-content">
                                    <span class="w-value">{{\App\Models\User::where("type","customer")->count()}}</span>
                                    <span class="w-numeric-title">{{__('admin.total')}} {{__('admin.users')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" col-lg-6 ">
                    <div class="widget-one widget widget-bg-4 ">
                        <div class="widget-content">
                            <div class="w-numeric-value">
                                <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>                            </div>
                                <div class="w-content">
                                    <span class="w-value">{{\App\Models\View::count()}}</span>
                                    <span class="w-numeric-title">{{__('admin.total')}} {{__('admin.website_views')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        

            

   