<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-xl-none"
            id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="#">
            <span class="ms-1 font-weight-bold">UM Publication</span>
        </a>
    </div>

    <hr class="horizontal dark mt-0">

    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            {{-- Dashboard --}}
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}" 
                href="{{ route('dashboard') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons text-primary">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            {{-- Publications --}}
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'publications' ? 'active' : '' }}" 
                href="{{ route('publications') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons text-dark">menu_book</i>
                    </div>
                    <span class="nav-link-text ms-1">Publications</span>
                </a>
            </li>

            {{-- Authors --}}
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'authors' ? 'active' : '' }}" 
                href="{{ route('authors') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons text-warning">people</i>
                    </div>
                    <span class="nav-link-text ms-1">Authors</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
