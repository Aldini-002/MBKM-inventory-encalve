<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/"
                        class="nav-link {{ str_contains(request()->route()->getName(),'dashboard')? 'active': '' }}">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item {{ str_contains(request()->route()->getName(),'furnitures')? 'menu-open': '' }}">
                    <a href="#"
                        class="nav-link {{ str_contains(request()->route()->getName(),'furnitures')? 'active': '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Furniture
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/furnitures"
                                class="nav-link {{ str_contains(request()->route()->getName(),'furnitures')? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar furniture</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ str_contains(request()->route()->getName(),'categories')? 'menu-open': '' }}">
                    <a href="#"
                        class="nav-link {{ str_contains(request()->route()->getName(),'categories')? 'active': '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Kategori
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/categories"
                                class="nav-link {{ str_contains(request()->route()->getName(),'categories')? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar kategori</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ str_contains(request()->route()->getName(),'materials')? 'menu-open': '' }}">
                    <a href="#"
                        class="nav-link {{ str_contains(request()->route()->getName(),'materials')? 'active': '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Material
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/materials"
                                class="nav-link {{ str_contains(request()->route()->getName(),'materials')? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar material</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ str_contains(request()->route()->getName(),'finishings')? 'menu-open': '' }}">
                    <a href="#"
                        class="nav-link {{ str_contains(request()->route()->getName(),'finishings')? 'active': '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Finishing
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/finishings"
                                class="nav-link {{ str_contains(request()->route()->getName(),'finishings')? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar finishing</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ str_contains(request()->route()->getName(),'applications')? 'menu-open': '' }}">
                    <a href="#"
                        class="nav-link {{ str_contains(request()->route()->getName(),'applications')? 'active': '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Application
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/applications"
                                class="nav-link {{ str_contains(request()->route()->getName(),'applications')? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar application</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ str_contains(request()->route()->getName(),'stockins')? 'menu-open': '' }}">
                    <a href="#"
                        class="nav-link {{ str_contains(request()->route()->getName(),'stockins')? 'active': '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Stok masuk
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/stockins"
                                class="nav-link {{ str_contains(request()->route()->getName(),'stockins')? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Stok masuk</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ str_contains(request()->route()->getName(),'stockouts')? 'menu-open': '' }}">
                    <a href="#"
                        class="nav-link {{ str_contains(request()->route()->getName(),'stockouts')? 'active': '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Stok keluar
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/stockouts"
                                class="nav-link {{ str_contains(request()->route()->getName(),'stockouts')? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Stok keluar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ str_contains(request()->route()->getName(),'supliers')? 'menu-open': '' }}">
                    <a href="#"
                        class="nav-link {{ str_contains(request()->route()->getName(),'supliers')? 'active': '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Pemasok
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/supliers"
                                class="nav-link {{ str_contains(request()->route()->getName(),'supliers')? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pemasok</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ str_contains(request()->route()->getName(),'buyers')? 'menu-open': '' }}">
                    <a href="#"
                        class="nav-link {{ str_contains(request()->route()->getName(),'buyers')? 'active': '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Pembeli
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/buyers"
                                class="nav-link {{ str_contains(request()->route()->getName(),'buyers')? 'active': '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pembeli</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">EXAMPLES</li>

                <li class="nav-item">
                    <a href="pages/calendar.html" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Calendar
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
