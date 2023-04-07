<aside class="main-sidebar sidebar-light-primary elevation-4">
    <a href="{{route('staffmanagement.module')}}" class="brand-link">
        <span class="h3 brand-text font-weight-light">{{app('module')}}</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include("staffmanagement::layouts.menu")
            </ul>
        </nav>
    </div>

</aside>
