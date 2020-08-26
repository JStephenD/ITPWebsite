<?php

namespace views\modules;

class sidebar
{
    public function get()
    {
        return <<<HTML
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
                        <a href="index.html">
                            <img src="assets/images/CIT logo.png" alt="H" width="50px" height="50px" />
                        </a>
                        <div class="media-body">
                            <a href="/index.html" class="h5
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
                    <li class="drawer-menu-item active">
                        <a href="/cityMunicipality.html">
                            <i class="material-icons">
                                location_city
                            </i>
                            <span class="drawer-menu-text">
                                City/Municipality
                            </span>
                        </a>
                    </li>
                    <li class="drawer-menu-item">
                        <a href="/personalDetails.html">
                            <i class="material-icons">
                                face
                            </i>
                            <span class="drawer-menu-text">
                                Personal Details
                            </span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- // END drawer -->
HTML;
    }
}
