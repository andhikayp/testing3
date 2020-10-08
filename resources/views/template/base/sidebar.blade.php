<!-- Sidebar -->
<!--
    Helper classes

    Adding .sidebar-mini-hide to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
    Adding .sidebar-mini-show to an element will make it visible (opacity: 1) when the sidebar is in mini mode
        If you would like to disable the transition, just add the .sidebar-mini-notrans along with one of the previous 2 classes

    Adding .sidebar-mini-hidden to an element will hide it when the sidebar is in mini mode
    Adding .sidebar-mini-visible to an element will show it only when the sidebar is in mini mode
        - use .sidebar-mini-visible-b if you would like to be a block when visible (display: block)
-->
<nav id="sidebar">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <!-- Side Header -->
        <div class="content-header content-header-fullrow px-15">
            <!-- Mini Mode -->
            <div class="content-header-section sidebar-mini-visible-b">
                <!-- Logo -->
                <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                    <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
                </span>
                <!-- END Logo -->
            </div>
            <!-- END Mini Mode -->

            <!-- Normal Mode -->
            <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                <!-- Close Sidebar, Visible only on mobile screens -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                    <i class="fa fa-times text-danger"></i>
                </button>
                <!-- END Close Sidebar -->

                <!-- Logo -->
                <div class="content-header-item">
                    <a class="link-effect font-w700" href="index.html">
                        <i class="si si-fire text-primary"></i>
                        <span class="font-size-xl text-dual-primary-dark">code</span><span class="font-size-xl text-primary">base</span>
                    </a>
                </div>
                <!-- END Logo -->
            </div>
            <!-- END Normal Mode -->
        </div>
        <!-- END Side Header -->

        <!-- Side User -->
        <div class="content-side content-side-full content-side-user px-10 align-parent">
            <!-- Visible only in mini mode -->
            <div class="sidebar-mini-visible-b align-v animated fadeIn">
                <img class="img-avatar img-avatar32" src="{{ asset('img/logo_jatim.png') }}" alt="">
            </div>
            <!-- END Visible only in mini mode -->

            <!-- Visible only in normal mode -->
            <div class="sidebar-mini-hidden-b text-center">
                <a class="img-link" href="be_pages_generic_profile.html">
                    <img class="img-avatar" src="{{ asset('img/logo_jatim.png') }}" alt="">
                </a>
                <ul class="list-inline mt-10">
                    <li class="list-inline-item">
                        <a class="link-effect text-dual-primary-dark font-size-xs font-w600 text-uppercase" href="be_pages_generic_profile.html">J. Smith</a>
                    </li>
                    <li class="list-inline-item">
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <a class="link-effect text-dual-primary-dark" data-toggle="layout" data-action="sidebar_style_inverse_toggle" href="javascript:void(0)">
                            <i class="si si-drop"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a class="link-effect text-dual-primary-dark" href="op_auth_signin.html">
                            <i class="si si-logout"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- END Visible only in normal mode -->
        </div>
        <!-- END Side User -->

        <!-- Side Navigation -->
        <div class="content-side content-side-full">
            <ul class="nav-main">
                <li>
                    <a href="be_pages_dashboard.html"><i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                </li>
                <li class="open">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-badge"></i><span class="sidebar-mini-hide">Page Kits</span></a>
                    <ul>
                        <li class="open">
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><span class="sidebar-mini-hide">Dashboards</span></a>
                            <ul>
                                <li>
                                    <a href="be_pages_dashboard2.html"><span class="sidebar-mini-hide">Dashboard 2</span></a>
                                </li>
                                <li>
                                    <a class="active" href="be_pages_dashboard3.html"><span class="sidebar-mini-hide">Dashboard 3</span></a>
                                </li>
                                <li>
                                    <a href="be_pages_dashboard4.html"><span class="sidebar-mini-hide">Dashboard 4</span></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#"><span class="sidebar-mini-hide">Real Estate</span></a>
                            <ul>
                                <li>
                                    <a href="be_pages_real_estate_dashboard.html">Dashboard</a>
                                </li>
                                <li>
                                    <a href="be_pages_real_estate_listing.html">Listing</a>
                                </li>
                                <li>
                                    <a href="be_pages_real_estate_listing_new.html">Add New Listing</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">User Interface</span></li>
                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i><span class="sidebar-mini-hide">Blocks</span></a>
                    <ul>
                        <li>
                            <a href="be_blocks.html">Styles</a>
                        </li>
                        <li>
                            <a href="be_blocks_tiles.html">Tiles</a>
                        </li>
                        <li>
                            <a href="be_blocks_draggable.html">Draggable</a>
                        </li>
                        <li>
                            <a href="be_blocks_api.html">API</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-moustache"></i><span class="sidebar-mini-hide">Widgets</span></a>
                    <ul>
                        <li>
                            <a href="be_blocks_widgets_users.html">Users</a>
                        </li>
                        <li>
                            <a href="be_blocks_widgets_stats.html">Statistics</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-energy"></i><span class="sidebar-mini-hide">Elements</span></a>
                    <ul>
                        <li>
                            <a href="be_ui_grid.html">Grid</a>
                        </li>
                        <li>
                            <a href="be_ui_icons.html">Icons</a>
                        </li>
                        <li>
                            <a href="be_ui_typography.html">Typography</a>
                        </li>
                        <li>
                            <a href="be_ui_activity.html">Activity</a>
                        </li>
                        <li>
                            <a href="be_ui_buttons.html">Buttons</a>
                        </li>
                        <li>
                            <a href="be_ui_navigation.html">Navigation</a>
                        </li>
                        <li>
                            <a href="be_ui_tabs.html">Tabs</a>
                        </li>
                        <li>
                            <a href="be_ui_modals_tooltips.html">Modals &amp; Tooltips</a>
                        </li>
                        <li>
                            <a href="be_ui_images.html">Images</a>
                        </li>
                        <li>
                            <a href="be_ui_animations.html">Animations</a>
                        </li>
                        <li>
                            <a href="be_ui_ribbons.html">Ribbons</a>
                        </li>
                        <li>
                            <a href="be_ui_timeline.html">Timeline</a>
                        </li>
                        <li>
                            <a href="be_ui_accordion.html">Accordion</a>
                        </li>
                        <li>
                            <a href="be_ui_color_themes.html">Color Themes</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-layers"></i><span class="sidebar-mini-hide">Tables</span></a>
                    <ul>
                        <li>
                            <a href="be_tables_styles.html">Styles</a>
                        </li>
                        <li>
                            <a href="be_tables_responsive.html">Responsive</a>
                        </li>
                        <li>
                            <a href="be_tables_helpers.html">Helpers</a>
                        </li>
                        <li>
                            <a href="be_tables_pricing.html">Pricing</a>
                        </li>
                        <li>
                            <a href="be_tables_datatables.html">DataTables</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-note"></i><span class="sidebar-mini-hide">Forms</span></a>
                    <ul>
                        <li>
                            <a href="be_forms_elements_bootstrap.html">Bootstrap Elements</a>
                        </li>
                        <li>
                            <a href="be_forms_elements_material.html">Material Elements</a>
                        </li>
                        <li>
                            <a href="be_forms_css_inputs.html">CSS Inputs</a>
                        </li>
                        <li>
                            <a href="be_forms_plugins.html">Plugins</a>
                        </li>
                        <li>
                            <a href="be_forms_editors.html">Editors</a>
                        </li>
                        <li>
                            <a href="be_forms_validation.html">Validation</a>
                        </li>
                        <li>
                            <a href="be_forms_wizard.html">Wizard</a>
                        </li>
                        <li>
                            <a href="be_forms_premade.html">Pre-made</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- Sidebar Content -->
</nav>
<!-- END Sidebar -->