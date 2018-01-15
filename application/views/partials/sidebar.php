<link type="text/css" rel="stylesheet" href="<?=base_url('assets/css/fab.css');?>">
<script src="<?=base_url('assets/js/pages/fab_buttons.js');?>"></script>

<?php $user = $this->setting_model->get_user_info($this->session->user_id); ?>
<aside class="sidebar">
    <div class="left-aside-container">
        <div class="user-profile-container">
            <div class="user-profile clearfix">
                <div class="admin-user-thumb">
                    <?php $filename = empty($user['avatar'])?'default.png':$user['avatar']; ?>
                    <img src="<?=FSPATH.'avatar/'.$filename;?>" alt="avatar" class="img-circle">
                </div>
                <div class="admin-user-info">
                    <ul class="user-info">
                        <li><a href="#" class="text-semibold text-size-large"><?=$user['nama'];?></a></li>
                        <li><a href="#"><small><?=$user['akses'].' - '. $this->session->mark;?></small></a></li>
                    </ul>
                    <div class="logout-icon"><a href="<?=base_url('logout');?>"><i class="icon-exit2"></i></a></div>
                </div>

            </div>
        </div>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="<?php if($this->uri->segment(1) != 'arsip') { echo 'active'; } ?>" id="tab-menu"><a href="#menu" aria-controls="menu" role="tab" data-toggle="tab"><i class="icon-home2"></i></a></li>
<!--            <li role="presentation" class="--><?php //if($this->uri->segment(1) == 'arsip') { echo 'active'; } ?><!--" id="tab-arsip"><a href="#arsip" aria-controls="arsip" role="tab" data-toggle="tab"><i class="icon-folder-open"></i></a></li>-->
            <li role="presentation" class="" id="tab-profile"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="icon-users2"></i></a></li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane <?php if($this->uri->segment(1) != 'arsip') { echo 'fadeIn active'; } ?>" id="menu">
                <ul class="sidebar-accordion acc-menu">

                    <li class="list-title">Menu</li>
                    <li><a href="<?=base_url('dashboard');?>"><i class="icon-display4"></i> Dashboard</a>

                    <?=$menus;?>

                </ul>
            </div>

            <div role="tabpanel" class="tab-pane email <?php if($this->uri->segment(1) == 'arsip') { echo 'fadeIn active'; } ?>" id="arsip">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="email-buttons">
                            <div class="row m-t-5">
                                <div class="col-xs-6 no-padding-left">
<!--                                    <button class="btn bg-primary btn-block btn-float btn-float-lg" type="button"><i class="icon-folder"></i> <span>Publik</span></button>-->
                                    <a href="<?=base_url('arsip');?>" class="btn bg-primary btn-block btn-float btn-float-lg">
                                        <i class="icon-folder-open"></i> Publik
                                    </a>
                                </div>

                                <div class="col-xs-6 no-padding-right">
<!--                                    <button class="btn bg-info btn-block btn-float btn-float-lg" type="button"><i class="icon-folder-remove"></i> <span>Privat</span></button>-->
                                    <a href="<?=base_url('arsip/saya');?>" class="btn bg-info btn-block btn-float btn-float-lg">
                                        <i class="icon-folder-remove"></i> Privat
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="menu-list m-t-10 m-b-20">
                    <li class="list-title">Arsip</li>
<!--                    <li><a href="--><?//=base_url('arsip');?><!--"><i class="icon-folder-open"></i> Publik <!--<span class="badge badge-info">0</span>--></a></li>-->
<!--                    <li><a href="--><?//=base_url('arsip/saya');?><!--"><i class="icon-folder-remove"></i> Privat <!--<span class="badge badge-warning">0</span>--></a></li>-->
<!--                    <li><a href="--><?//=base_url('arsip/kegiatan');?><!--"><i class="icon-folder"></i> Kegiatan<!-- <span class="badge badge-warning">0</span>--></a></li>-->
                </ul>
            </div>



            <div role="tabpanel" class="tab-pane profile fade" id="profile">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="text-center">
                            <img src="<?=FSPATH.'avatar/'.$filename;?>" class="img-responsive img-circle user-avatar" alt=""/>
                            <h4 class="no-margin-bottom m-t-10">Halo! <?=$user['nama'];?></h4>
                            <div class="text-light text-size-small text-white"><?=$user['akses'];?></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</aside>
