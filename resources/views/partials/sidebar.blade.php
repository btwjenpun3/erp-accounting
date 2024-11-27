<div class="sidebar-wrapper" data-layout="stroke-svg">
    <div>
        <div class="logo-wrapper">
            <a href="index.html">
                {{-- <x-logo /> --}}
            </a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar">
                <svg class="stroke-icon sidebar-toggle status_toggle middle">
                    <use href="/assets/svg/icon-sprite.svg#toggle-icon"></use>
                </svg>
                <svg class="fill-icon sidebar-toggle status_toggle middle">
                    <use href="/assets/svg/icon-sprite.svg#fill-toggle-icon"></use>
                </svg>
            </div>
        </div>
        <div class="logo-icon-wrapper">
            <a href="index.html">
                <img class="img-fluid" src="/assets/images/logo/logo-icon.png" alt="">
            </a>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn">
                        <a href="index.html">
                            <img class="img-fluid" src="/assets/images/logo/logo-icon.png" alt="">
                        </a>
                        <div class="mobile-back text-end">
                            <span>Back</span>
                            <i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
                        </div>
                    </li>
                    <li class="pin-title sidebar-main-title">
                        <div>
                            <h6>Pinned</h6>
                        </div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6 class="lan-1">General</h6>
                        </div>
                    </li>
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a href="{{ route('dashboard.index') }}" class="sidebar-link sidebasr-title"
                            href="javascript:void(0)">
                            <svg class="stroke-icon">
                                <use href="/assets/svg/icon-sprite.svg#stroke-home"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="/assets/svg/icon-sprite.svg#fill-home"></use>
                            </svg>
                            <span class="lan-30">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title active" href="javascript:void(0)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-database text-white">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 6m-8 0a8 3 0 1 0 16 0a8 3 0 1 0 -16 0" />
                                <path d="M4 6v6a8 3 0 0 0 16 0v-6" />
                                <path d="M4 12v6a8 3 0 0 0 16 0v-6" />
                            </svg>
                            <svg class="fill-icon">
                                <use href="/assets/svg/icon-sprite.svg#fill-widget"></use>
                            </svg>
                            <span class="lan">Master</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('master.group.index') }}">Group</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-list-details text-white">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M13 5h8" />
                                <path d="M13 9h5" />
                                <path d="M13 15h8" />
                                <path d="M13 19h5" />
                                <path
                                    d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                <path
                                    d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                            </svg>
                            <svg class="fill-icon">
                                <use href="/assets/svg/icon-sprite.svg#fill-layout"></use>
                            </svg>
                            <span class="lan">List</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a
                                    href="{{ route('list.invoice.po-supplier') }}?start_date={{ \Carbon\Carbon::today()->format('Y-m-d') }}&end_date={{ \Carbon\Carbon::today()->format('Y-m-d') }}">
                                    Invoice
                                </a>
                            </li>
                            <li>
                                <a
                                    href="{{ route('list.material-request') }}?start_date={{ \Carbon\Carbon::today()->format('Y-m-d') }}&end_date={{ \Carbon\Carbon::today()->format('Y-m-d') }}">
                                    Material Request
                                </a>
                            </li>
                            <li>
                                <a
                                    href="{{ route('list.bom') }}?start_date={{ \Carbon\Carbon::today()->format('Y-m-d') }}&end_date={{ \Carbon\Carbon::today()->format('Y-m-d') }}">
                                    BOM
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
