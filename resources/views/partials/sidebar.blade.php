<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="/">
            <img alt="Logo" src="/metronic/media/logos/default-dark.svg" class="h-25px app-sidebar-logo-default" />
            <img alt="Logo" src="/metronic/media/logos/default-small.svg"
                class="h-20px app-sidebar-logo-minimize" />
        </a>
        <!--end::Logo image-->
        <!--begin::Sidebar toggle-->
        <div id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
            <span class="svg-icon svg-icon-2 rotate-180">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.5"
                        d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                        fill="currentColor" />
                    <path
                        d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                        fill="currentColor" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu"
                data-kt-menu="true" data-kt-menu-expand="false">
                <!--begin:Menu item-->
                <div
                    class="menu-item menu-accordion {{ str_contains(request()->route()->getName(),'dashboard')? 'here show': '' }}">
                    <!--begin:Menu link-->
                    <a href="/"
                        class="menu-link {{ str_contains(request()->route()->getName(),'dashboard')? 'active': '' }}">
                        <span class="menu-title">Dashboard</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div
                    class="menu-item {{ str_contains(request()->route()->getName(),'furnitures')? 'here show': '' }} menu-accordion">
                    <!--begin:Menu link-->
                    <a href="/furnitures"
                        class="menu-link {{ str_contains(request()->route()->getName(),'furnitures')? 'active': '' }}">
                        <span class="menu-title">Furnitures</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">Stock</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div
                    class="menu-item {{ str_contains(request()->route()->getName(),'stock_ins')? 'here show': '' }} menu-accordion">
                    <!--begin:Menu link-->
                    <a href="/stock_ins"
                        class="menu-link {{ str_contains(request()->route()->getName(),'stock_ins')? 'active': '' }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Stock in</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div
                    class="menu-item {{ str_contains(request()->route()->getName(),'stock_outs')? 'here show': '' }} menu-accordion">
                    <!--begin:Menu link-->
                    <a href="/stock_outs"
                        class="menu-link {{ str_contains(request()->route()->getName(),'stock_outs')? 'active': '' }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Stock out</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">Settings</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div
                    class="menu-item {{ str_contains(request()->route()->getName(),'categories')? 'here show': '' }} menu-accordion">
                    <!--begin:Menu link-->
                    <a href="/categories""
                        class="menu-link {{ str_contains(request()->route()->getName(),'categories')? 'active': '' }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Categories</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div
                    class="menu-item {{ str_contains(request()->route()->getName(),'materials')? 'here show': '' }} menu-accordion">
                    <!--begin:Menu link-->
                    <a href="/materials"
                        class="menu-link {{ str_contains(request()->route()->getName(),'materials')? 'active': '' }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Materials</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div
                    class="menu-item {{ str_contains(request()->route()->getName(),'finishings')? 'here show': '' }} menu-accordion">
                    <!--begin:Menu link-->
                    <a href="/finishings"
                        class="menu-link {{ str_contains(request()->route()->getName(),'finishings')? 'active': '' }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Finishings</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div
                    class="menu-item {{ str_contains(request()->route()->getName(),'applications')? 'here show': '' }} menu-accordion">
                    <!--begin:Menu link-->
                    <a href="/applications"
                        class="menu-link {{ str_contains(request()->route()->getName(),'applications')? 'active': '' }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Applications</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
    <!--begin::Footer-->
    <div class="app-sidebar-footer flex-column-auto py-2 px-6" id="kt_app_sidebar_footer">
        <a href="#" onclick="return alert('masih dalam tahap pengembangan')"
            class="btn btn-success btn-sm w-100">
            <span class="btn-label">My Profile</span>
        </a>
    </div>
    <div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
        <a href="#" onclick="return alert('masih dalam tahap pengembangan')"
            class="btn btn-danger btn-sm w-100">
            <span class="btn-label">Logout</span>
        </a>
    </div>
    <!--end::Footer-->
</div>
