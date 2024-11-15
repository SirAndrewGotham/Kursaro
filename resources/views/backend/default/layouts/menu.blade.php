<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li>
            <select class="searchable-field form-control">

            </select>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('index_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/homes*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-home c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.index.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('home_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.homes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/homes") || request()->is("admin/homes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-home c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.home.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('group_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/categories*") ? "c-show" : "" }} {{ request()->is("admin/courses*") ? "c-show" : "" }} {{ request()->is("admin/contact-types*") ? "c-show" : "" }} {{ request()->is("admin/contacts*") ? "c-show" : "" }} {{ request()->is("admin/course-features*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-graduation-cap c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.group.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/categories") || request()->is("admin/categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-list-ol c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.category.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('course_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.courses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/courses") || request()->is("admin/courses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-chalkboard-teacher c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.course.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('contact_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.contact-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/contact-types") || request()->is("admin/contact-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-bezier-curve c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contactType.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('contact_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.contacts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/contacts") || request()->is("admin/contacts/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-phone-volume c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contact.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('course_feature_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.course-features.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/course-features") || request()->is("admin/course-features/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.courseFeature.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('promo_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/banners*") ? "c-show" : "" }} {{ request()->is("admin/banner-spots*") ? "c-show" : "" }} {{ request()->is("admin/banner-types*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fab fa-adversal c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.promo.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('banner_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.banners.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/banners") || request()->is("admin/banners/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-flag c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.banner.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('banner_spot_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.banner-spots.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/banner-spots") || request()->is("admin/banner-spots/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-map-pin c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bannerSpot.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('banner_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.banner-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/banner-types") || request()->is("admin/banner-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-american-sign-language-interpreting c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bannerType.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('back_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/feedbacks*") ? "c-show" : "" }} {{ request()->is("admin/prospects*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-bullhorn c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.back.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('feedback_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.feedbacks.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/feedbacks") || request()->is("admin/feedbacks/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-pen-nib c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.feedback.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('prospect_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.prospects.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/prospects") || request()->is("admin/prospects/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-chalkboard-teacher c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.prospect.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('system_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/languages*") ? "c-show" : "" }} {{ request()->is("admin/pages*") ? "c-show" : "" }} {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.system.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('language_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.languages.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/languages") || request()->is("admin/languages/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-globe c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.language.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('page_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.pages.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/pages") || request()->is("admin/pages/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.page.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>
