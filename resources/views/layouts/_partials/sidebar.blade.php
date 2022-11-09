<div id="scrollbar">
    <div class="container-fluid">
        <div id="two-column-menu">
        </div>
        <ul class="navbar-nav" id="navbar-nav">
            <li class="menu-title"><span data-key="t-menu">Main Menu</span></li>
            <li class="nav-item">
                <a class="nav-link menu-link {{ set_active('dashboard') }}" href="{{ route('dashboard') }}" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                    <i class="mdi mdi-speedometer"></i> <span data-key="t-dashboards">Dashboard</span>
                </a>
            </li>
            @canany(['activity_log_show'])
            <li class="nav-item">
                <a class="nav-link menu-link collapsed" href="#sidebarAdvanceUI" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAdvanceUI">
                    <i class="mdi mdi-math-log"></i> <span data-key="t-advance-ui">System Log</span>
                </a>
                <div class="menu-dropdown collapse {{ set_show(['activity_log*']) }}" id="sidebarAdvanceUI" style="">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('activity_log.index') }}" class="nav-link {{ set_active(['activity_log*']) }}" data-key="t-chat"> Activity Log</a>
                        </li>
                    </ul>
                </div>
            </li>
            @endcanany
            @canany(['transaction_index'])
            <li class="nav-item">
                <a class="nav-link menu-link {{ set_active('transaction*') }}" href="{{ route('transaction.index') }}" role="button" aria-expanded="false" aria-controls="sidebarApps">
                    <i class="mdi mdi-view-grid-plus-outline"></i> <span data-key="t-apps">Transactions</span>
                </a>
            </li>
            @endcanany
            @canany(['transaction_report'])
            <li class="nav-item">
                <a class="nav-link menu-link {{ set_active('transaction*') }}" href="{{ route('transaction.report') }}" role="button" aria-expanded="false" aria-controls="sidebarApps">
                    <i class="mdi mdi-view-grid-plus-outline"></i> <span data-key="t-apps">Transactions Report</span>
                </a>
            </li>
            @endcanany

            @canany(['car_index','driver_index'])
            <li class="nav-item">
                <a class="nav-link menu-link collapsed" href="#sidebarIcons" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarIcons">
                    <i class="mdi mdi-format-list-bulleted-square"></i> <span data-key="t-icons">Master Data</span>
                </a>
                <div class="collapse menu-dropdown {{ set_show(['car*','driver*']) }}" id="sidebarIcons">
                    <ul class="nav nav-sm flex-column">
                        @can('car_index')
                        <li class="nav-item">
                            <a href="{{ route('car.index') }}" class="nav-link {{ set_active(['car*']) }}" data-key="t-boxicons">Mobil</a>
                        </li>
                        @endcan
                        @can('driver_index')
                        <li class="nav-item">
                            <a href="{{ route('driver.index') }}" class="nav-link {{ set_active(['driver*']) }}" data-key="t-remix">Driver</a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </li>
            @endcanany
            @canany(['user_show', 'role_show','setting_app_show'])
            <li class="nav-item">
                <a class="nav-link menu-link collapsed" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                    <i class="mdi mdi-cog"></i> <span data-key="t-apps">Utilities</span>
                </a>
                <div class="collapse menu-dropdown {{ set_show(['user*', 'roles*', 'settingApp*']) }}" id="sidebarApps">
                    <ul class="nav nav-sm flex-column">
                        @can('user_show')
                        <li class="nav-item ">
                            <a href="{{ route('user.index') }}" class="nav-link {{ set_active(['user*']) }}" data-key="t-calendar"> Users </a>
                        </li>
                        @endcan
                        @can('role_show')
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}" class="nav-link {{ set_active(['roles*']) }}" data-key="t-chat"> Roles </a>
                        </li>
                        @endcan
                        @can('setting_app_show')
                        <li class="nav-item">
                            <a href="{{ route('settingApp.index',1) }}" class="nav-link {{ set_active(['settingApp*']) }}" data-key="t-chat"> Setting Apps </a>
                        </li>
                        @endcan

                    </ul>
                </div>
            </li>
            @endcanany
        </ul>
    </div>
</div>
<div class="sidebar-background"></div>
