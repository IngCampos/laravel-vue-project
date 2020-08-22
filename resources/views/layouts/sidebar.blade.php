<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Laravel') }}</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseTwo">
            <i class="far fa-window-maximize"></i>
            <span>Public information</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Sections:</h6>
                @if(Auth::user()->permissions->where('pivot.permission_id','2')!="[]")
                <a class="collapse-item" href="{{route('complaints')}}">
                    <i class="fas fa-envelope-open-text"></i>
                    <span>{{ __('Complaints') }}</span>
                </a>
                @endif
                @if(Auth::user()->permissions->where('pivot.permission_id','3')!="[]")
                <a class="collapse-item" href="{{route('advertisements')}}">
                    <i class="fas fa-newspaper"></i>
                    <span>{{ __('Advertisements') }}</span>
                </a>
                @endif
                @if(Auth::user()->permissions->where('pivot.permission_id','4')!="[]")
                <a class="collapse-item" href="{{route('machines')}}">
                    <i class="fas fa-cogs"></i>
                    <span>{{ __('Machines status') }}</span>
                </a>
                @endif
                @if(Auth::user()->permissions->where('pivot.permission_id','5')!="[]")
                <a class="collapse-item" href="{{route('tenders')}}">
                    <i class="fas fa-file-alt"></i>
                    <span>{{ __('Tenders') }}</span>
                </a>
                @endif
            </div>
        </div>
    </li>
    @if(Auth::user()->permissions->where('pivot.permission_id','1')!="[]")
    <hr class="sidebar-divider">
    <div class="sidebar-heading text-center">
        Admin
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{route('users')}}">
            <i class="fas fa-users"></i>
            <span>{{ __('Users') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('permissions')}}">
            <i class="fas fa-key"></i>
            <span>{{ __('Permissions') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-chart-bar"></i>
            <span>Statistics</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Sections:</h6>
                <a class="collapse-item" href="{{route('statistics_system')}}">
                    <i class="fas fa-server"></i>
                    <span>System</span>
                </a>
                <a class="collapse-item" href="{{route('statistics_business')}}">
                    <i class="fas fa-building"></i>
                    <span>Business</span>
                </a>
            </div>
        </div>
    </li>
    @endif
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>