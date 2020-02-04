
        <h2 style="margin-top:0px">Menu <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Name <?php echo form_error('name') ?></label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Link <?php echo form_error('link') ?></label>
            <input type="text" class="form-control" name="link" id="link" placeholder="Link" value="<?php echo $link; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Icon <?php echo form_error('icon') ?> </label>
            <!--input type="text" class="form-control select-icon " name="icon" id="icon" placeholder="Icon" value="<?php echo $icon; ?>" /-->
            <select name="icon" id="fa-select" class="select-icon fa-select"></select> <span id="icon"></span>
        </div>
	    <div class="form-group">
            
            <!--input type="text" class="form-control" name="is_active" id="is_active" placeholder="Is Active" value="<?php echo $is_active; ?>" /-->
            <input type="checkbox" class="form-controls" name="is_active" id="is_active" placeholder="Is Active" value="<?php echo $is_active; ?>" />
            <label for="int">Is Active <?php echo form_error('is_active') ?></label>
        </div>

	    <div class="form-group">
            <label for="int">Is Parent <?php echo form_error('is_parent') ?></label>
            <!--input type="text" class="form-control" name="is_parent" id="is_parent" placeholder="Is Parent" value="<?php echo $is_parent; ?>" /-->
            <?php 
            $attr = [
                'type'=>"text",
                'class'=>"form-control",
                'name'=>"group",
                'id'=>"group",
                'placeholder'=>"Group"
            ];
            $this->db->order_by('group');
            $datamenu = $this->db->get('menu')->result();
            $dataGroup = $this->db->get('groups')->result();
            $options = [0=>'0 Main Menu'];
            $optionsGroup=[0=>'0 Main Menu'];
            $data = [];
            error_reporting(0);
        foreach ($datamenu as $mkey) {
            foreach ($dataGroup as $gkey) {
                   if($mkey->group == $gkey->id){
                    //$optionsGroup[$gkey->name] = array();
                        foreach ($datamenu as $skey) {
                            if($skey->group == $gkey->id){
                                //$text = $this->db->get_where('groups',['id'=>$skey->group])->row('description').' > '.$skey->id.' '.$skey->name;
                                $text = $this->db->get_where('groups',['id'=>$skey->group])->row('description').' > '.$skey->id.' '.$skey->name;
                                //array_push($optionsGroup[$gkey->name][$skey->id], $options[$gkey->name][$skey->id] = 'text');     
                                array_push($options[$gkey->name][$skey->id], $options[$gkey->name][$skey->id] = $text);     
                            }   
                        }
                    }
                }        
        }
            
            //print_r($options);
             echo  form_dropdown('is_parent', $options, $is_parent, $attr);
             echo '<!--';
             print_r($options);
             //print_r($optionsGroup);
             echo '-->';
            ?>
        </div>
	    <div class="form-group">
            <label for="int">Group <?php echo form_error('group') ?></label>
            <?php 
            $attr = [
                'type'=>"text",
                'class'=>"form-control",
                'name'=>"group",
                'id'=>"group",
                'placeholder'=>"Group"
            ];

            $option = $this->db->get('groups')->result();
            $options = [''=>'Pilih Group akses'];
            foreach($option as $row ){
                array_push($options, $options[$row->id] = $row->id.'. '.$row->name);
            }
            //print_r($options);
             echo  form_dropdown('group', $options, $group, $attr);
            ?>
            <!--input type="text" class="form-control" name="group" id="group" placeholder="Group" value="<?php echo $group; ?>" /-->
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('menu') ?>" class="btn btn-default">Cancel</a>
	</form>
   





<?php
/* End of file menu/menu_form */
/* Location: ./application/view/menu/menu_form */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-16 20:08:23 */
/* http://harviacode.com */

/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 16 Jan 2020 */
/*Template name : template/AdminLTE */
/*============================================================================*/
?>