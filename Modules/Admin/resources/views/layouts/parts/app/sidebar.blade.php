       <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">
            
            <nav id="sidebar">
                <div class="shadow-bottom"></div>
                <ul class="list-unstyled menu-categories" id="accordionExample">

                    @can('home')
                    <li class="menu">
                        <a href="/admin" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span>{{__('admin.home')}}</span>
                            </div>
                        </a>
                    </li>
                    @endcan


                    @can('offices')

                    <li class="menu">
                        <a href="#companies" data-toggle="collapse" aria-expanded="false"class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>                               
                                <span>{{__('admin.offices')}}</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="companies" data-parent="#accordionExample">
                            <li>
                                <a href="{{url('/')}}/admin/companies?type=default"> {{__('admin.rent_without_drivers')}}</a>
                            </li>
                            <li>
                                <a href="{{url('/')}}/admin/companies?type=driver"> {{__('admin.cars_with_driver')}}</a>
                            </li>
                            <li>
                                <a href="{{url('/')}}/admin/companies?type=yacht">  {{__('admin.yacht_rental')}}</a>
                            </li>
                        </ul>
                    </li>
                    <!-- <li class="menu">
                        <a href="{{url('/')}}/admin/companies" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>                               
                                <span>{{__('admin.rental_offices')}}</span>
                            </div>
                        </a>
                    </li> -->
                    @endcan

                    @can('cars')

                    @if(auth()->user()->type == "admin" || auth()->user()->company->type =="default")
                    <li class="menu">
                        <a href="#cars" data-toggle="collapse" aria-expanded="false"class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>                               
                                <span>{{__('admin.cars')}}</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="cars" data-parent="#accordionExample">
                            <li>
                                <a href="{{url('/')}}/admin/cars?type=default"> {{__('admin.all')}}</a>
                            </li>
                            <li>
                                <a href="{{url('/')}}/admin/cars?status=active&type=default"> {{__('admin.active')}}</a>
                            </li>
                            <li>
                                <a href="{{url('/')}}/admin/cars?status=pending&type=default"> {{__('admin.pending')}}</a>
                            </li>
                            
                        </ul>
                    </li>
                    @endif

                    @if(auth()->user()->type == "admin" || auth()->user()->company->type =="driver")
                    <li class="menu">
                        <a href="#carsdriver" data-toggle="collapse" aria-expanded="false"class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>                               
                                <span>{{__('admin.cars_by_driver')}}</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="carsdriver" data-parent="#accordionExample">
                            <li>
                                <a href="{{url('/')}}/admin/cars?type=driver"> {{__('admin.all')}}</a>
                            </li>
                            <li>
                                <a href="{{url('/')}}/admin/cars?status=active&type=driver"> {{__('admin.active')}}</a>
                            </li>
                            <li>
                                <a href="{{url('/')}}/admin/cars?status=pending&type=driver">{{__('admin.pending')}}</a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    @if(auth()->user()->type == "admin" || auth()->user()->company->type =="yacht")
                    <li class="menu">
                        <a href="#yacht" data-toggle="collapse" aria-expanded="false"class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>                               
                                <span>{{__('admin.yacht')}}</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="yacht" data-parent="#accordionExample">
                            <li>
                                <a href="{{url('/')}}/admin/cars?type=yacht"> {{__('admin.all')}}</a>
                            </li>
                            <li>
                                <a href="{{url('/')}}/admin/cars?status=active&type=yacht"> {{__('admin.active')}}</a>
                            </li>
                            <li>
                                <a href="{{url('/')}}/admin/cars?status=pending&type=yacht"> {{__('admin.pending')}}</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @endcan

                    @can('pages')
                    <li class="menu">
                        <a href="{{url('/')}}/admin/pages" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>                               
                                <span>{{__('admin.pages')}}</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="{{url('/')}}/admin/blog" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>                               
                                <span>{{__('admin.blog')}}</span>
                            </div>
                        </a>
                    </li>
                    @endcan


                    @can('website_home_page')
                    <li class="menu">
                        <a href="#home" data-toggle="collapse" aria-expanded="false"class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>                               
                                <span>{{__('admin.page')}} {{__('admin.home')}}</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="home" data-parent="#accordionExample">
                            <li>
                                <a href="{{url('/')}}/admin/sections"> {{__('admin.categories')}} {{__('admin.home')}}</a>
                            </li>
                            <li>
                                <a href="{{url('/')}}/admin/banners"> {{__('admin.banner')}}</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu">
                        <a href="#contentpage" data-toggle="collapse" aria-expanded="false"class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>                               
                                <span>{{__('admin.content')}} {{__('admin.pages')}}</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="contentpage" data-parent="#accordionExample">
                            <li>
                                <a href="{{url('/')}}/admin/content/home"> {{__('admin.home')}}</a>
                            </li>
                            <li>
                                <a href="{{url('/')}}/admin/content/driver"> {{__('admin.cars_with_driver')}}</a>
                            </li>
                            <li>
                                <a href="{{url('/')}}/admin/content/yacht"> {{__('admin.yacht_rental')}}</a>
                            </li>
                            <li>
                                <a href="{{url('/')}}/admin/content/listcar"> {{__('admin.add_your_car')}}</a>
                            </li>
                        </ul>
                    </li>
                    @endcan

                    

                    @can('definitions')
                    
                    <li class="menu">
                        <a href="#dashboard2" data-toggle="collapse" aria-expanded="false"class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>                               
                                <span>{{__('admin.settings')}} {{__('admin.cars')}}</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="dashboard2" data-parent="#accordionExample">
                            <li>
                                <a href="{{url('/')}}/admin/brands"> {{__('admin.brands')}}</a>
                            </li>
                            <li>
                                <a href="{{url('/')}}/admin/models?type=car"> {{__('admin.models')}}</a>
                            </li>
                            <li>
                                <a href="{{url('/')}}/admin/types"> {{__('admin.types')}}</a>
                            </li>
                            <li>
                                <a href="{{url('/')}}/admin/features?type=car"> {{__('admin.features')}}</a>
                            </li>
                            <li>
                                <a href="{{url('/')}}/admin/colors"> {{__('admin.colors')}}</a>
                            </li>
                            <li>
                                <a href="{{url('/')}}/admin/years"> {{__('admin.years')}}</a>
                            </li>

                        </ul>
                    </li>
                    <li class="menu">
                        <a href="#yachtsettings" data-toggle="collapse" aria-expanded="false"class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>                               
                                <span>{{__('admin.settings')}} {{__('admin.yacht')}}</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="yachtsettings" data-parent="#accordionExample">
                            <li>
                                <a href="{{url('/')}}/admin/models?type=yacht">{{__('admin.models')}}</a>
                            </li>
                            <li>
                                <a href="{{url('/')}}/admin/features?type=yacht"> {{__('admin.features')}}</a>
                            </li>
 

                        </ul>
                    </li>
                    @endcan

                    @can('customers')
                    <li class="menu">
                        <a href="{{url('/')}}/admin/customers" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>                               
                                <span>{{__('admin.customers')}}</span>
                            </div>
                        </a>
                    </li>
                    @endcan

                    @can('areas')
                    <li class="menu">
                        <a href="#countries" data-toggle="collapse" aria-expanded="false"class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>                               
                                <span>{{__('admin.areas')}}</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="countries" data-parent="#accordionExample">
                            <li>
                                <a href="{{url('/')}}/admin/countries">{{__('admin.countries')}}</a>
                            </li>
                            <li>
                                <a href="{{url('/')}}/admin/cities"> {{__('admin.cities')}}</a>
                            </li>

                        </ul>
                    </li>
                    @endcan

                    @can('settings')
                    <li class="menu">
                        <a href="{{url('/')}}/admin/notifications" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>                               
                                <span>{{__('admin.notifications')}}</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="{{url('/')}}/admin/messages" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>                               
                                <span>{{__('admin.messages')}}</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="{{url('/')}}/admin/currencies" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>                               
                                <span>{{__('admin.currencies')}}</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="{{url('/')}}/admin/settings" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>                               
                                <span>{{__('admin.settings')}}</span>
                            </div>
                        </a>
                    </li>
                    @endcan

                    @if(auth()->user()->type == "user")


                    <li class="menu">
                        <a href="{{url('/')}}/admin/offers" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>                               
                                <span>{{__('admin.offers_sidebar')}} {{__('admin.cars')}}</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu">
                        <a href="{{url('/')}}/admin/companies/{{auth()->user()->company->id}}/edit" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>                               
                                <span>{{__('admin.settings')}} {{__('admin.office')}}</span>
                            </div>
                        </a>
                    </li>
                    @endif

       
                </ul>
                
            </nav>

        </div>