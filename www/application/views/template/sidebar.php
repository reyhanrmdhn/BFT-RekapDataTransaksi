<!-- #END# Page Loader -->
<div class="wrapper">
    <!-- Sidebar  -->
    <nav class="sidebar sidebar-bunker">
        <div class="sidebar-header">
            <!--<a href="index.html" class="logo"><span>bd</span>task</a>-->
            <a href="index.html" class="logo mx-auto"><img src="<?= base_url() ?>assets/img/logo.png" alt="" style="width:180px;height:auto;"></a>
        </div>
        <!--/.sidebar header-->
        <div class="profile-element d-flex align-items-center flex-shrink-0">
            <div class="avatar">
                <img src="<?= base_url() ?>assets/img/<?= $user['image'] ?>" class="rounded-circle" alt="" style="width:40px;height:40px">
            </div>
            <div class="profile-text">
                <h6 class="m-0"><?= $user['name']; ?></h6>
                <!-- <h6 class="m-0"><?= $this->uri->segment(1) ?></h6> -->
                <span><?= $user['role']; ?></span>
            </div>
        </div>

        <!--/.profile element-->
        <div class="sidebar-body">
            <nav class="sidebar-nav">
                <ul class="metismenu">
                    <?php
                    $role_id = $this->session->userdata('role_id');
                    $this->db->select('*');
                    $this->db->from('user_menu');
                    $this->db->join('user_access_menu', 'user_access_menu.menu_id = user_menu.id');
                    $this->db->where('user_access_menu.role_id', $role_id);
                    $this->db->order_by('user_access_menu.menu_id', 'ASC');
                    $menu = $this->db->get()->result_array();
                    ?>
                    <?php
                    foreach ($menu as $m) {
                    ?>
                        <li class="nav-label"><?= $m['menu']; ?></li>

                        <?php
                        $menuId = $m['menu_id'];
                        $this->db->select('*');
                        $this->db->from('user_sub_menu');
                        $this->db->join('user_menu', 'user_menu.id = user_sub_menu.menu_id');
                        $this->db->where('user_sub_menu.menu_id', $menuId);
                        $this->db->where('user_sub_menu.is_active', 1);
                        $subMenu = $this->db->get()->result_array();

                        foreach ($subMenu as $sm) {
                        ?>
                            <li class="<?php if ($title == $sm['title']) { ?> mm-active <?php } ?>">
                                <a class="material-ripple" href="<?= base_url($sm['url']) ?>">
                                    <i class="<?= $sm['icon'] ?> mr-2"></i>
                                    <?= $sm['title'] ?>
                                </a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </nav>
        </div><!-- sidebar-body -->
    </nav>