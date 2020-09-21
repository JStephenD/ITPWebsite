</div>
</div>

</div>
<div class="mdk-drawer js-mdk-drawer" id="default-drawer">
    <div class="mdk-drawer__content">
        <div class="mdk-drawer__inner" data-simplebar data-simplebar-force-enabled="true">
            <nav class="drawer
                        drawer--dark">
                <div class="drawer-spacer">
                    <div class="media
                                align-items-center">

                        <!-- <a href="index.html"
                                    class="drawer-brand-circle
                                    mr-2">H</a> -->
                        <a href="/">
                            <img src="/assets/images/CIT logo.png" alt="H" width="50px" height="50px" />
                        </a>
                        <div class="media-body">
                            <a href="/" class="h5
                                        m-0
                                        text-link">
                                &nbsp;&nbsp;ITP25533Z</a>
                        </div>
                    </div>
                </div>
                <!-- HEADING -->
                <div class="py-2
                            drawer-heading">
                    Dashboards
                </div>
                <!-- DASHBOARDS MENU -->
                <ul class="drawer-menu" id="dasboardMenu" data-children=".drawer-submenu">
                    <?php if (isset($_SESSION['user'])) { ?>
                        <img class="dp-img" id="dp-img" src="<?= '../' . $_SESSION['user']['dp_url'] ;?>" alt="dp_img">
                        <span class="dp-text" id="dp-text"><?= $_SESSION['user']['first_name'] ;?></span>
                    <?php } ?>
                    <li class="drawer-menu-item <?= preg_match('/user/', $method) ? 'drawer-active' : 'inactive' ?>">
                        <button>
                            <i class="fas fa-user"></i>
                            <span id="sidebar-user-text" class="sidebar-text">
                                User <?= isset($_SESSION['user']) ? ' ( ' . $_SESSION['user']['first_name'] . ' ) ' : ''; ?>
                            </span>
                        </button>
                        <div class="submenu">
                            <ul>
                                <li class="<?= isset($_SESSION['user']) ? '' : 'd-none'; ?>"><a id='sidebar-account' href="/user/account/<?= $_SESSION['user']['id']; ?>"><i class="fas fa-user-circle"></i>Account</a></li>
                                <li class="<?= isset($_SESSION['user']) ? '' : 'd-none'; ?>"><a id='sidebar-logout' href="/user/logout"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
                                <li class="<?= isset($_SESSION['user']) ? 'd-none' : ''; ?>"><a id='sidebar-signup' href="/user/signup"><i class="fas fa-user-plus"></i>Sign up</li></a>
                                <li class="<?= isset($_SESSION['user']) ? 'd-none' : ''; ?>"><a id='sidebar-login' href="/user/login"><i class="fas fa-sign-in-alt"></i>Login</li></a>
                            </ul>
                        </div>
                    </li>
                    <li class="drawer-menu-item <?= preg_match('/citymunicipality/', $method) ? 'drawer-active' : 'inactive' ?>">
                        <button>
                            <i class="fas fa-city"></i>
                            <span class="sidebar-text">
                                City/Municipality
                            </span>
                        </button>
                        <div class="submenu">
                            <ul>
                                <li>
                                    <a id="sidebar-citymun-listing" href="/citymunicipality/listing">
                                        <i class="fas fa-bars"></i>
                                        Listing</a></li>
                                <li>
                                    <a id="sidebar-citymun-add" href="/citymunicipality/add">
                                        <i class="fas fa-plus-circle"></i>
                                        Add</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="drawer-menu-item <?= preg_match('/barangay/', $method) ? 'drawer-active' : '' ?>">
                        <button>
                            <i class="fas fa-home"></i>
                            <span class="sidebar-text">
                                Barangay
                            </span>
                        </button>
                        <div class="submenu">
                            <ul>
                                <li>
                                    <a id="sidebar-barangay-listing" href="/barangay/listing">
                                        <i class="fas fa-bars"></i>
                                        Listing</a></li>
                                <li>
                                    <a id="sidebar-barangay-add" href="/barangay/add">
                                        <i class="fas fa-plus-circle"></i>
                                        Add</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="drawer-menu-item <?= preg_match('/mapping/', $method) ? 'drawer-active' : '' ?>">
                        <button>
                            <i class="fas fa-map-signs"></i>
                            <span class="sidebar-text">
                                Mapping
                            </span>
                        </button>
                        <div class="submenu">
                            <ul>
                                <li>
                                    <a id="sidebar-mapping" href="/mapping">
                                        <i class="fas fa-map-marked-alt"></i>
                                        Mapping</a></li>
                            </ul>
                        </div>
                    </li>



                    <!-- <li class="drawer-menu-item">
                        <a href="/personalDetails.html">
                            <i class="material-icons">
                                face
                            </i>
                            <span class="drawer-menu-text">
                                Personal Details
                            </span>
                        </a>
                    </li> -->
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- // END drawer -->