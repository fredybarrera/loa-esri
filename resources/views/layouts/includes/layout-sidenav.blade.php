<div id="layout-sidenav" class="{{ isset($layout_sidenav_horizontal) ? 'layout-sidenav-horizontal sidenav-horizontal container-p-x flex-grow-0' : 'layout-sidenav sidenav-vertical' }} sidenav bg-sidenav-theme">

    <!-- Inner -->
    <ul class="sidenav-inner{{ empty($layout_sidenav_horizontal) ? ' py-1' : '' }}">

        @foreach(App\Custom::getMenu()['menus'] as $menu)
            <!-- MENÚ MANTENEDOR -->
            @if($menu->tipomenu_id == App\Define::MENU_TIPO_MANTENEDOR)
                @if(sizeof($menu->subMenus)>0)
                    <li class="sidenav-item {{ (Request::is('*'.$menu->link) ? 'open' : '') }}">
                        <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon {{ $menu->clase_icono }}"></i>
                        <div>{{ $menu->nombre }}</div>
                        </a>
                        <ul class="sidenav-menu">
                            @foreach($menu->subMenus as $objSubMenu)
                                <li class="sidenav-item {{ (Request::is($objSubMenu->link) ? 'active' : '') }}">
                                    <a href="{{ url('/'.$objSubMenu->link) }}" class="sidenav-link">
                                        <div>{{ $objSubMenu->nombre }}</div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li class="sidenav-item {{ (Request::is('*'.$menu->link) ? 'active' : '') }}">
                        <a href="{{ url('/'.$menu->link) }}" class="sidenav-link"><i class="sidenav-icon {{ $menu->clase_icono }}"></i>
                        <div>{{ $menu->nombre }}</div>
                        </a>
                    </li>
                @endif
            @elseif($menu->tipomenu_id == App\Define::MENU_TIPO_TAREA)
                @if(sizeof($menu->subMenus)>0)
                    <li class="sidenav-item">
                        <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon {{ $menu->clase_icono }}"></i>
                        <div>{{ $menu->nombre }}</div>
                        </a>
                        <ul class="sidenav-menu">
                            @foreach($menu->subMenus as $objSubMenu)
                                <li class="sidenav-item">
                                    <a href="{{ url('/'.$objSubMenu->link) }}" class="sidenav-link">
                                        <div>{{ $objSubMenu->nombre }}</div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li class="sidenav-item {{ (Request::is('*'.$menu->link) ? 'active' : '') }}">
                        <a href="{{ url('/'.$menu->link) }}" class="sidenav-link"><i class="sidenav-icon {{ $menu->clase_icono }}"></i>
                        <div>{{ $menu->nombre }}</div>
                        </a>
                    </li>
                @endif
            @elseif($menu->tipomenu_id == App\Define::MENU_TIPO_DASHBOARD)
                @if(sizeof($menu->subMenus)>0)
                    <li class="sidenav-item">
                        <a href="javascript:void(0)" class="sidenav-link sidenav-toggle"><i class="sidenav-icon {{ $menu->clase_icono }}"></i>
                        <div>{{ $menu->nombre }}</div>
                        </a>
                        <ul class="sidenav-menu">
                            @foreach($menu->subMenus as $objSubMenu)
                                <li class="sidenav-item">
                                    <a href="{{ url('/'.$objSubMenu->link) }}" class="sidenav-link">
                                        <div>{{ $objSubMenu->nombre }}</div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li class="sidenav-item {{ (Request::is('*'.$menu->link) ? 'active' : '') }}">
                        <a href="{{ url('/'.$menu->link) }}" class="sidenav-link"><i class="sidenav-icon {{ $menu->clase_icono }}"></i>
                        <div>{{ $menu->nombre }}</div>
                        </a>
                    </li>
                @endif
            @endif
        @endforeach
    </ul>
</div>
