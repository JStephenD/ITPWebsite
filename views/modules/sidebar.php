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
                    <li 
                        class="drawer-menu-item <?= strpos($method, 'user') ? 'active' : '' ?>">
                        <button>
                            <i class="fas fa-user"></i>
                            <span class="sidebar-text">
                                User
                            </span>
                        </button>
                        <div class="submenu">
                            <ul>
                                <?php if (isset($_SESSION['user'])) { ?>
                                <li>Account</li>
                                <li>Logout</li>
                                <?php } else { ?>
                                <li><a href="/user/signup"><i class="fas fa-user-plus"></i>Sign up</li></a>
                                <li><a href="/user/login"><i class="fas fa-sign-in-alt"></i>Login</li></a>
                                <?php } ?>
                            </ul>
                        </div>
                    </li>
                    <li 
                        class="drawer-menu-item <?= strpos($method, 'citymunicipality') ? 'active' : '' ?>">
                        <button>
                            <i class="fas fa-city"></i>
                            <span class="sidebar-text">
                                City/Municipality
                            </span>
                        </button>
                        <div class="submenu">
                            <ul>
                                <li><a href="/citymunicipality/listing"><i class="fas fa-bars"></i>Listing</a></li>
                                <li><a href="/citymunicipality/add"><i class="fas fa-plus-circle"></i>Add</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="drawer-menu-item <?= strpos($method, 'barangay') ? 'active' : '' ?>">
                        <button>
                            <i class="fas fa-home"></i>
                            <span class="sidebar-text">
                                Barangay
                            </span>
                        </button>
                        <div class="submenu">
                            <ul>
                                <li><a href="/barangay/listing"><i class="fas fa-bars"></i>Listing</a></li>
                                <li><a href="/barangay/add"><i class="fas fa-plus-circle"></i>Add</a></li>
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