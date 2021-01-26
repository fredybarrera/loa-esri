<div id="layout-sidenav" class="{{ isset($layout_sidenav_horizontal) ? 'layout-sidenav-horizontal sidenav-horizontal container-p-x flex-grow-0' : 'layout-sidenav sidenav-vertical' }} sidenav bg-sidenav-theme">

    <!-- Inner -->
    <ul class="sidenav-inner{{ empty($layout_sidenav_horizontal) ? ' py-1' : '' }}">

        <li class="sidenav-item{{ Request::is('/') ? ' active' : '' }}">
            <a href="{{ route('home') }}" class="sidenav-link"><i class="sidenav-icon ion ion-ios-contact"></i><div>Home</div></a>
        </li>

        <li class="sidenav-item{{ Request::is('page-2') ? ' active' : '' }}">
            <a href="{{ route('page-2') }}" class="sidenav-link"><i class="sidenav-icon ion ion-md-desktop"></i><div>Page 2</div></a>
        </li>

        @foreach(App\Custom::getMenu()['menus'] as $menu)
            <!-- MENÚ MANTENEDOR -->
            @if($menu->tipomenu_id == App\Define::MENU_TIPO_MANTENEDOR)
                @if(sizeof($menu->subMenus)>0)
                    <li class="sidenav-item">
                        <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon {{ $menu->clase_icono }}"></i>
                        <div>{{ $menu->nombre }}</div>
                        </a>
                        <ul class="sidenav-menu">
                            @foreach($menu->subMenus as $objSubMenu)
                                <li class="sidenav-item">
                                    <a href="index.html" class="sidenav-link">
                                        <div>{{ $objSubMenu->nombre }}</div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li class="sidenav-item{{ (Request::is('*'.$menu->link) ? 'class=active' : '') }}">
                        <a href="typography.html" class="sidenav-link"><i class="sidenav-icon {{ $menu->clase_icono }}"></i>
                        <div>{{ $menu->nombre }}</div>
                        </a>
                    </li>
                @endif
            @elseif($menu->tipomenu_id == App\Define::MENU_TIPO_TAREA)
                @if(sizeof($menu->subMenus)>0)
                    <li>Menu tarea</li>
                    <li>Menu tarea</li>
                    <li>Menu tarea</li>
                @else
                    <li class="sidenav-item{{ (Request::is('*'.$menu->link) ? 'class=active' : '') }}">
                        <a href="typography.html" class="sidenav-link"><i class="sidenav-icon {{ $menu->clase_icono }}"></i>
                        <div>{{ $menu->nombre }}</div>
                        </a>
                    </li>
                @endif
            @elseif($menu->tipomenu_id == App\Define::MENU_TIPO_DASHBOARD)
                @if(sizeof($menu->subMenus)>0)
                    <li>Menu tarea</li>
                    <li>Menu tarea</li>
                    <li>Menu tarea</li>
                @else
                    <li class="sidenav-item{{ (Request::is('*'.$menu->link) ? 'class=active' : '') }}">
                        <a href="typography.html" class="sidenav-link"><i class="sidenav-icon {{ $menu->clase_icono }}"></i>
                        <div>{{ $menu->nombre }}</div>
                        </a>
                    </li>
                @endif
            @endif
        @endforeach
    </ul>
</div>
