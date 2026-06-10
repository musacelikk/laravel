<aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-ion">
    <a href="{{ route('admin.dashboard') }}" class="brand-link border-bottom border-secondary">
        <span class="brand-text font-weight-light ml-3">E-SHOP</span>
    </a>

    <div class="sidebar">
        <nav class="mt-3 px-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <ion-icon name="home" class="nav-icon-ion icon-yellow"></ion-icon>
                        <p class="d-inline mb-0">Dashboard</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.orders*') ? 'menu-open' : '' }}">
                    <a href="{{ route('admin.orders') }}" class="nav-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                        <ion-icon name="cube" class="nav-icon-ion icon-blue"></ion-icon>
                        <p class="d-inline mb-0">Orders</p>
                        <ion-icon name="chevron-back" class="nav-chevron right"></ion-icon>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <ion-icon name="grid" class="nav-icon-ion icon-yellow"></ion-icon>
                        <p class="d-inline mb-0">Categories</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <ion-icon name="apps" class="nav-icon-ion icon-white"></ion-icon>
                        <p class="d-inline mb-0">Products</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.comments.index') }}" class="nav-link {{ request()->routeIs('admin.comments.*') ? 'active' : '' }}">
                        <ion-icon name="chatbubble-outline" class="nav-icon-ion icon-white"></ion-icon>
                        <p class="d-inline mb-0">Comments</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.faq.index') }}" class="nav-link {{ request()->routeIs('admin.faq.*') ? 'active' : '' }}">
                        <ion-icon name="help-circle-outline" class="nav-icon-ion icon-white"></ion-icon>
                        <p class="d-inline mb-0">FAQ</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.messages.index') }}" class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                        <ion-icon name="mail-outline" class="nav-icon-ion icon-white"></ion-icon>
                        <p class="d-inline mb-0">Messages</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <ion-icon name="person" class="nav-icon-ion icon-green"></ion-icon>
                        <p class="d-inline mb-0">Users</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.social.index') }}" class="nav-link {{ request()->routeIs('admin.social.*') ? 'active' : '' }}">
                        <ion-icon name="share-social-outline" class="nav-icon-ion icon-white"></ion-icon>
                        <p class="d-inline mb-0">Social</p>
                    </a>
                </li>

                <li class="nav-header">LABELS</li>

                <li class="nav-item">
                    <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                        <ion-icon name="settings-outline" class="nav-icon-ion icon-white"></ion-icon>
                        <p class="d-inline mb-0">Settings</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
