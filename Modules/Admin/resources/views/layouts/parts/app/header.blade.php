    <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm">

            <ul class="navbar-item theme-brand flex-row  text-center">
                <li class="nav-item theme-logo">
                    <a href="/admin">
                        <img src="/assets/img/logo.webp" class="navbar-logo" alt="logo">
                    </a>
                </li>
          
            </ul>


            <ul class="navbar-item flex-row ml-md-auto">

                <li class="nav-item">
                    <a style="color:white;font-weight:bold" href="/admin/lang/switch" class="nav-link">
                       {{app()->getLocale() == 'ar' ? 'English' : 'العربية'}}
                    </a>

                </li>

         
                <li class="nav-item dropdown user-profile-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <img src="{{auth()->user()->type == 'user' && auth()->user()->company->image ? '/storage/' . auth()->user()->company->image : '/storage/' . \App\Helpers\WebpImage::generateUrl(\App\Models\Setting::first()->header_logo) }}" alt="avatar">
                    </a>
                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        <div class="">
                            <!-- <div class="dropdown-item">
                                <a class="" href="user_profile.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> حسابي</a>
                            </div> -->
                  
                 
                            <div class="dropdown-item">
                                <a class="" href="/admin/logout"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> {{__('admin.logout')}}</a>
                            </div>
                        </div>
                    </div>
                </li>

            </ul>
        </header>
    </div>