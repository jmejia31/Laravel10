<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ _('WD') }}</a>
            <a href="#" class="simple-text logo-normal">{{ _('White Dashboard') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ _('Dashboard') }}</p>
                </a>
            </li>
            {{--  MODULO DE PERSONAS  --}}
            <li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="true">
                    <i class="fab fa-laravel" ></i>
                    <span class="nav-link-text" >{{ __('people') }}</span>
                    <b class="caret mt-1"></b>
                </a>
                <div class="collapse show" id="laravel-examples">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'users') class="active " @endif>
                            <a href="{{ route('users.view')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ _('Users View') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'users') class="active " @endif>
                            <a href="{{ route('users.create')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ _('Users Create') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'users') class="active " @endif>
                            <a href="{{ route('users.index')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ _('User Manager') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            {{--  =============================  --}}

            <!-- MODULO DE Roles y Permissions -->

            {{--  ADMIN ROLES  --}}
            <li>
                <a data-toggle="collapse" href="#Roles_and_Permissions" aria-expanded="{{ (request()->is('role/*')) ? 'true' : 'false' }}">
                    <i class="fab fa-laravel"></i>
                    <span class="nav-link-text">{{ __('Roles and Permissions') }}</span>
                    <b class="caret mt-1"></b>
                </a>
                <div class="collapse {{ (request()->is('role/*')) ? 'show' : '' }}" id="Roles_and_Permissions">
                    <ul class="nav pl-4">
                        <!-- Subcategoría "Roles" -->
                        <li>
                            <a data-toggle="collapse" href="#subcategoria-roles" aria-expanded="{{ (request()->is('role/*')) ? 'true' : 'false' }}">
                                <i class="fab fa-laravel"></i>
                                <span class="nav-link-text">{{ __('Roles') }}</span>
                                <b class="caret mt-1"></b>
                            </a>
                            <div class="collapse {{ (request()->is('role/*')) ? 'show' : '' }}" id="subcategoria-roles">
                                <ul class="nav pl-4">
                                    <!-- Elemento de "Roles" -->
                                    <li @if ($pageSlug == 'role') class="active " @endif>
                                        <a href="{{ route('role.view') }}">
                                            <i class="tim-icons icon-single-02"></i>
                                            <p>{{ _('Role View') }}</p>
                                        </a>
                                    </li>
                                    <li @if ($pageSlug == 'role') class="active " @endif>
                                        <a href="{{ route('role.create') }}">
                                            <i class="tim-icons icon-single-02"></i>
                                            <p>{{ _('Role Create') }}</p>
                                        </a>
                                    </li>
                                    <li @if ($pageSlug == 'role') class="active " @endif>
                                        <a href="{{ route('role.index') }}">
                                            <i class="tim-icons icon-single-02"></i>
                                            <p>{{ _('Role Manager') }}</p>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- Subcategoría "Permissions" -->
                        <li>
                            <a data-toggle="collapse" href="#subcategoria-permissions" aria-expanded="{{ (request()->is('permission/*')) ? 'true' : 'false' }}">
                                <i class="fab fa-laravel"></i>
                                <span class="nav-link-text">{{ __('Permissions') }}</span>
                                <b class="caret mt-1"></b>
                            </a>
                            <div class="collapse {{ (request()->is('permission/*')) ? 'show' : '' }}" id="subcategoria-permissions">
                                <ul class="nav pl-4">
                                    <!-- Elemento de "Permissions" -->
                                    <li @if ($pageSlug == 'permission') class="active " @endif>
                                        <a href="{{ route('permissions.index') }}">
                                            <i class="tim-icons icon-single-02"></i>
                                            <p>{{ _('Permission Manager') }}</p>
                                        </a>
                                    </li>
                                    <li @if ($pageSlug == 'permission') class="active " @endif>
                                        <a href="{{ route('permissions.create') }}">
                                            <i class="tim-icons icon-single-02"></i>
                                            <p>{{ _('Permission Create') }}</p>
                                        </a>
                                    </li>
                                    <!-- Agrega más elementos de "Permissions" aquí si es necesario -->
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>


            {{--  Modulo de ROLES Y PERMISSIONS  --}}

            {{--  <li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="{{ (request()->is('role/*') || request()->is('permissions/*')) ? 'true' : 'false' }}">
                    <i class="fab fa-laravel"></i>
                    <span class="nav-link-text">{{ __('ROLES Y PERMISSIONS') }}</span>
                    <b class="caret mt-1"></b>
                </a>
                <div class="collapse {{ (request()->is('role/*') || request()->is('permissions/*')) ? 'show' : '' }}" id="laravel-examples">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'role') class="active " @endif>
                            <a href="{{ route('role.index') }}">
                                <i class="tim-icons icon-single-02"></i>
                                <p>{{ _('Roles') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'permissions') class="active " @endif>
                            <a href="{{ route('permissions.index') }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ _('Permissions') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>  --}}

            {{--  <li @if ($pageSlug == 'icons') class="active " @endif>
                <a href="{{ route('pages.icons') }}">
                    <i class="tim-icons icon-atom"></i>
                    <p>{{ _('Icons') }}</p>
                </a>
            </li>  --}}
            {{--  <li @if ($pageSlug == 'maps') class="active " @endif>
                <a href="{{ route('pages.maps') }}">
                    <i class="tim-icons icon-pin"></i>
                    <p>{{ _('Maps') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'notifications') class="active " @endif>
                <a href="{{ route('pages.notifications') }}">
                    <i class="tim-icons icon-bell-55"></i>
                    <p>{{ _('Notifications') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'tables') class="active " @endif>
                <a href="{{ route('pages.tables') }}">
                    <i class="tim-icons icon-puzzle-10"></i>
                    <p>{{ _('Table List') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'typography') class="active " @endif>
                <a href="{{ route('pages.typography') }}">
                    <i class="tim-icons icon-align-center"></i>
                    <p>{{ _('Typography') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'rtl') class="active " @endif>
                <a href="{{ route('pages.rtl') }}">
                    <i class="tim-icons icon-world"></i>
                    <p>{{ _('RTL Support') }}</p>
                </a>
            </li>
            <li class=" {{ $pageSlug == 'upgrade' ? 'active' : '' }} bg-info">
                <a href="{{ route('pages.upgrade') }}">
                    <i class="tim-icons icon-spaceship"></i>
                    <p>{{ _('Upgrade to PRO') }}</p>
                </a>
            </li>  --}}
        </ul>
    </div>
</div>
