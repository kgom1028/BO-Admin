<?php
$edit_data = $this->db->get_where('tbl_notification' , array('id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_customer');?>
            	</div>
            </div>
			<div class="panel-body">

                <?php echo form_open('admin/manage_notification/do_update/'.$row['id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('title');?></label>
                        <div class="col-sm-5">
                            <textarea class="form-control" name="title" value="<?php echo $row['title'];?>"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('content');?></label>
                        <div class="col-sm-5">
                            <textarea class="form-control" name="content" value="<?php echo $row['content'];?>"></textarea>
                        </div>
                    </div>

            		<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('edit_notification');?></button>
						</div>
					</div>
        		</form>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>
