<?php
$user_id = $this->session->userdata('user_id');
$user = $this->ion_auth->user($user_id)->row();
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url()?>assets/AdminLTE-2.0.5/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?= ($this->session->userdata('user_id'))? $user->username: 'anonymous' ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">

                        <li>
                            <a href="dashboard2">
                                <i class="fa fa-laptop"></i> <span>DASHBOARD</span>
                                <small class="label pull-right bg-red">3</small>
                            </a>
                        </li>
                        <?php
                        // Cek Grup user pada io Auth
                        $inGroup=[];
                        $user_groups = $this->ion_auth->get_users_groups($user->id)->result();
                        if(count($user_groups)>0){
                            for($x=0 ; $x < count($user_groups) ; $x++){
                                array_push($inGroup, $user_groups[$x]->id);
                            }  
                        }
                        //echo in_array('2', $inGroup);
                        //print_r($inGroup);
                        $menu = $this->db->get_where('menu', array('is_parent' => 0,'is_active'=>1));
                        foreach ($menu->result() as $m) {
                            // chek ada sub menu
                            $submenu = $this->db->get_where('menu',array('is_parent'=>$m->id,'is_active'=>1));
                            if($submenu->num_rows()>0){
                                // tampilkan submenu
                                if(in_array($m->group, $inGroup)){ // cek grup dulu sebelum ditampilkan menu ini  
                                 
                                        echo "<li class='treeview'>
                                            ".anchor('#',  "<i class='$m->icon'></i>".strtoupper($m->name.' - '. $m->group).' <i class="fa fa-angle-left pull-right"></i>')."
                                                <ul class='treeview-menu'>";
                                        foreach ($submenu->result() as $s){
                                            echo "<li>" . anchor($s->link, "<i class='$s->icon'></i> <span>" . strtoupper($s->name).' = '.$s->group) . "</span></li>";
                                        }
                                            echo"</ul>
                                              </li>";
                                }       
                            }else{
                                if(in_array($m->group, $inGroup)){
                                    echo "<li>" . anchor($m->link, "<i class='$m->icon'></i> <span>" . strtoupper($m->name .' x '. $m->group)) . "</span></li>";
                                }    
                            }
                            
                        }
                        ?>

                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">