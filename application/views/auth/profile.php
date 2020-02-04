<?php
$user_id = $this->session->userdata('user_id');

?>
<a href="<?= base_url('Auth/change_password') ?>" class="btn btn-primary">Ganti Password</a>
<a href="<?= base_url('Auth/edit_user/'.$user_id) ?>" class="btn btn-warning">Edit Profile</a>
<a href="<?= base_url() ?>" class="btn "></a>
<hr>
<h3><i class="fa fa-user"></i> Info :</h3>
<table class="table table-bordered table-striped">
    <tr><th width="15%">Anggota Sejak</th>  <td><?php $user = $this->ion_auth->user()->row(); print_r(date('d M Y',$user->created_on)); ?></td></tr>
    <tr><th width="15%">Username</th>  <td><?php $user = $this->ion_auth->user()->row(); print_r($user->username); ?></td></tr>
    <tr><th width="15%">Email</th>  <td><?php $user = $this->ion_auth->user()->row(); print_r($user->email); ?></td></tr>
    <tr><th width="15%">Nama Depan</th>  <td><?php $user = $this->ion_auth->user()->row(); print_r($user->first_name); ?></td></tr>
    <tr><th width="15%">Nama Belakang</th>  <td><?php $user = $this->ion_auth->user()->row(); print_r($user->last_name); ?></td></tr>
    <tr><th width="15%">Bidang</th>  <td><?php $user = $this->ion_auth->user()->row(); print_r($user->company); ?></td></tr>
</table>
<hr>
<h3><i class="fa fa-users"></i> Group :</h3>
<?php
    $user_groups = $this->ion_auth->get_users_groups($user_id)->result();
    //print_r($user_groups);
    echo '<table class="table table-bordered table-striped">';
    echo '<tr>
            <th width="15%">Group</th>
            <th>Description</th>
            </tr>';
    foreach ($user_groups as $p) {
       echo '<tr><td>'.$p->name.'</td><td>'.$p->description.'</td></tr>';
    }
    echo '</table>';
?>