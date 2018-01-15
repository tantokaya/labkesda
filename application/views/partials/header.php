<?php $user = $this->setting_model->get_user_info($this->session->user_id); ?>
<?php $filename = empty($user['avatar'])?'default.png':$user['avatar']; ?>
<?php $total_events = $this->setting_model->get_total_events(); ?>


<header class="main-nav clearfix">

    <div class="navbar-left pull-left">
        <div class="clearfix">
            <ul class="left-branding pull-left">
                <li><span class="left-toggle-switch visible-handheld"><i class="icon-menu7"></i></span></li>
                <li>
                    <a href="#"><div class="logo"></div></a>
                </li>
            </ul>
        </div>
    </div>

    <div class="navbar-right pull-right">
        <div class="clearfix">
            <ul class="pull-right top-right-icons">
                <li class="dropdown user-dropdown">
                    <a href="#" class="btn-user dropdown-toggle hidden-xs" data-toggle="dropdown">
                        <img src="<?=FSPATH . 'avatar/'.$filename;?>" class="img-circle user" alt=""/></a>
                    <a href="#" class="dropdown-toggle visible-xs" data-toggle="dropdown"><i class="icon-more"></i></a>
                    <div class="dropdown-menu">
                        <div class="text-center"><img src="<?=FSPATH.'avatar/'.$filename;?>" class="img-circle img-70" alt=""/></div>
                        <h5 class="text-center"><b>Halo, <?=$user['nama'];?>!</b></h5>
                        <ul class="more-apps">
                            <li><a href="<?=base_url('profil');?>"><i class="icon-profile"></i> Profil Saya</a></li>
                        </ul>
                        <div class="text-center"><a href="<?=base_url('logout');?>" class="btn btn-sm btn-info"><i class="icon-exit3 i-16 position-left"></i> Keluar</a></div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>