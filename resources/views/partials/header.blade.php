<div class="header-wrapper col m-0">
    <div class="row">
        <form class="form-inline search-full col" action="#" method="get">
            <div class="form-group w-100">
                <div class="Typeahead Typeahead--twitterUsers">
                    <div class="u-posRelative">
                        <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text"
                            placeholder="Search Mofi .." name="q" title="" autofocus>
                        <div class="spinner-border Typeahead-spinner" role="status"><span
                                class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
                    </div>
                    <div class="Typeahead-menu"></div>
                </div>
            </div>
        </form>
        <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper"><a href="index.html"><img class="img-fluid" src="/assets/images/logo/logo.png"
                        alt=""></a></div>
            <div class="toggle-sidebar">
                <svg class="stroke-icon sidebar-toggle status_toggle middle">
                    <use href="/assets/svg/icon-sprite.svg#toggle-icon"></use>
                </svg>
            </div>
        </div>
        <div class="nav-right col-xxl-8 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
            <ul class="nav-menus">
                <li>
                    <div class="form-group w-100">
                        <div class="Typeahead Typeahead--twitterUsers">
                            <div class="u-posRelative d-flex align-items-center">
                                <svg class="search-bg svg-color">
                                    <use href="/assets/svg/icon-sprite.svg#search"></use>
                                </svg>
                                <input class="demo-input py-0 Typeahead-input form-control-plaintext w-100"
                                    type="text" placeholder="Search Mofi .." name="q" title="">
                            </div>
                        </div>
                    </div>
                </li>
                <li class="fullscreen-body">
                    <span>
                        <svg id="maximize-screen">
                            <use href="/assets/svg/icon-sprite.svg#full-screen"></use>
                        </svg>
                    </span>
                </li>
                <li>
                    <div class="mode">
                        <svg>
                            <use href="/assets/svg/icon-sprite.svg#moon"></use>
                        </svg>
                    </div>
                </li>
                <li class="profile-nav onhover-dropdown px-0 py-0">
                    <div class="d-flex profile-media align-items-center"><img class="img-30"
                            src="/assets/images/dashboard/profile.png" alt="">
                        <div class="flex-grow-1"><span>Helmi</span>
                            <p class="mb-0 font-outfit">Administrator<i class="fa fa-angle-down"></i>
                            </p>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        <li>
                            <form action="#" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-link" type="submit">
                                    <span class="text-danger">Log out</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
