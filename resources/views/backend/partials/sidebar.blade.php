<div id="kt_aside" class="aside aside-default  aside-hoverable " data-kt-drawer="true" data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_aside_toggle">

    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto px-10 pt-9 pb-5" id="kt_aside_logo">
        <!--begin::Logo-->
        <a href="{{ route('admin.dashboard') }}">
            <img alt="Logo" src="{{ asset($systemSetting->logo ?? 'backend/media/logos/logo-default.svg') }}"
                class="max-h-50px logo-default theme-light-show" />
            {{-- <img alt="Logo" src="{{ asset($systemSetting->logo ?? 'backend/media/logos/logo-default.svg') }}"
                class="max-h-50px logo-default theme-dark-show" /> --}}
            <img alt="Logo" src="{{ asset($systemSetting->logo ?? 'backend/media/logos/logo-default.svg') }}"
                class="max-h-50px logo-minimize" />
        </a>
        <!--end::Logo-->
    </div>
    <!--end::Brand-->

    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid ps-3 pe-1">
        <!--begin::Aside Menu-->

        <!--begin::Menu-->
        <div class="menu menu-sub-indention menu-column menu-rounded menu-title-gray-600 menu-icon-gray-400 menu-active-bg menu-state-primary menu-arrow-gray-500 fw-semibold fs-6 my-5 mt-lg-2 mb-lg-0"
            id="kt_aside_menu" data-kt-menu="true">

            <div class="hover-scroll-y mx-4" id="kt_aside_menu_wrapper" data-kt-scroll="true"
                data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
                data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="20px"
                data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer">

                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-element-11 fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </div>
                <div class="menu-item">
                    <div class="menu-content">
                        <div class="separator mx-1 my-2"></div>
                    </div>
                </div>


                <div data-kt-menu-trigger="click"
                    class="menu-item {{ request()->routeIs(['admin.blog.categories.*','admin.version.*','admin.available.balance.*','admin.product.*', 'admin.blog.*']) ? 'active show' : '' }} menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fa-regular fa-file fs-2"></i>
                        </span>
                        <span class="menu-title">Category</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a href="{{ route('admin.blog.categories.index') }}"
                                class="menu-link {{ request()->routeIs(['admin.blogs.categories.*']) ? 'active show' : '' }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Category</span>
                            </a>
                        </div>
                    </div>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a href="{{ route('admin.version.index') }}"
                                class="menu-link {{ request()->routeIs(['admin.version.*']) ? 'active show' : '' }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Version</span>
                            </a>
                        </div>
                    </div>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a href="{{ route('admin.available.balance.index') }}"
                                class="menu-link {{ request()->routeIs(['admin.available.balance.*']) ? 'active show' : '' }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Avialable Amount</span>
                            </a>
                        </div>
                    </div>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a href="{{ route('admin.product.index') }}"
                                class="menu-link {{ request()->routeIs(['admin.product.*']) ? 'active show' : '' }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Product</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div data-kt-menu-trigger="click"
                    class="menu-item {{ request()->routeIs([
                        'admin.cms.hero_section.*',
                        'admin.cms.about_section.*',
                        'admin.cms.our_story.*',
                        'admin.cms.our_mission.*',
                        'admin.cms.what_we_offer.*',
                        'admin.cms.our_vision.*',
                        'admin.cms.why_choose_us.*',
                        'admin.cms.offer-section.*',
                        'admin.cms.how_it_works.*',
                        'admin.cms.why_choose_items.*',
                        'admin.cms.our_process.*',
                    ])
                        ? 'active show'
                        : '' }} menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fa-regular fa-file fs-2"></i>
                        </span>
                        <span class="menu-title">CMS</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a href="{{ route('admin.cms.hero_section.index') }}"
                                class="menu-link {{ request()->routeIs(['admin.cms.hero_section.*']) ? 'active show' : '' }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Hero Section</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a href="{{ route('admin.cms.about_section.index') }}"
                                class="menu-link {{ request()->routeIs(['admin.cms.about_section.*']) ? 'active show' : '' }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">About Us</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a href="{{ route('admin.cms.our_story.index') }}"
                                class="menu-link {{ request()->routeIs(['admin.cms.our_story.*']) ? 'active show' : '' }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Our Story</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a href="{{ route('admin.cms.our_mission.index') }}"
                                class="menu-link {{ request()->routeIs(['admin.cms.our_mission.*']) ? 'active show' : '' }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Our Mission</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a href="{{ route('admin.cms.our_vision.index') }}"
                                class="menu-link {{ request()->routeIs(['admin.cms.our_vision.*']) ? 'active show' : '' }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Our Vision</span>
                            </a>
                        </div>

                        {{-- <div class="menu-item">
                            <a href="{{ route('admin.cms.what_we_offer.index') }}"
                                class="menu-link {{ request()->routeIs(['admin.cms.what_we_offer.*']) ? 'active show' : '' }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">what We Offer</span>
                            </a>
                        </div> --}}

                        <div class="menu-item">
                            <a href="{{ route('admin.cms.why_choose_us.index') }}"
                                class="menu-link {{ request()->routeIs(['admin.cms.why_choose_us.*']) ? 'active show' : '' }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Why Choose Us</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a href="{{ route('admin.cms.offer-section.index') }}"
                                class="menu-link {{ request()->routeIs(['admin.cms.offer-section.*']) ? 'active show' : '' }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">What We Offer</span>
                            </a>
                        </div>

                        <div class="menu-item">
                            <a href="{{ route('admin.cms.how_it_works.index') }}"
                                class="menu-link {{ request()->routeIs(['admin.cms.how_it_works.*']) ? 'active show' : '' }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">How It Works</span>
                            </a>
                        </div>
                        <div data-kt-menu-trigger="click"
                            class="menu-item {{ request()->routeIs(['admin.cms.why_choose_items.*', 'admin.cms.our_process.*']) ? 'active show' : '' }} menu-accordion">
                            <span class="menu-link">
                                <span class="menu-icon">
                                    <i class="fa-regular fa-file fs-2"></i>
                                </span>
                                <span class="menu-title">About Page</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion">
                                <div class="menu-item">
                                    <a href="{{ route('admin.cms.why_choose_items.index') }}"
                                        class="menu-link {{ request()->routeIs(['admin.cms.why_choose_items.*']) ? 'active show' : '' }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Why Choose Item</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a href="{{ route('admin.cms.our_process.index') }}"
                                        class="menu-link {{ request()->routeIs(['admin.cms.our_process.*']) ? 'active show' : '' }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Our Process</span></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="menu-item">
                    <div class="menu-content">
                        <div class="separator mx-1 my-2"></div>
                    </div>
                </div>

                <div data-kt-menu-trigger="click"
                    class="menu-item {{ request()->routeIs(['faq.*', 'dynamic_page.*']) ? 'active show' : '' }} menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fa-regular fa-file fs-2"></i>
                        </span>
                        <span class="menu-title">Pages</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a href="{{ route('dynamic_page.index') }}"
                                class="menu-link {{ request()->routeIs(['dynamic_page.index', 'dynamic_page.create', 'dynamic_page.update']) ? 'active show' : '' }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Dynamic Page</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div data-kt-menu-trigger="click"
                    class="menu-item {{ request()->routeIs(['profile.setting', 'system.index', 'mail.setting', 'social.index']) ? 'active show' : '' }} menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fa-solid fa-gear fs-2"></i>
                        </span>
                        <span class="menu-title">Setting</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a href="{{ route('profile.setting') }}"
                                class="menu-link {{ request()->routeIs('profile.setting') ? 'active' : '' }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Profile Setting</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="{{ route('system.index') }}"
                                class="menu-link {{ request()->routeIs('system.index') ? 'active' : '' }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">System Setting</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="{{ route('mail.setting') }}"
                                class="menu-link {{ request()->routeIs('mail.setting') ? 'active' : '' }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Mail Setting</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="{{ route('social.index') }}"
                                class="menu-link {{ request()->routeIs('social.index') ? 'active' : '' }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Social Media</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
