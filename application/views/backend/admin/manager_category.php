<div class="row">
	<div class="col-md-12">

    	<!------CONTROL TABS END-------->
         <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
                    <?php echo get_phrase('category_list');?>
                </a>
            </li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_category');?>
                </a>
            </li>
        </ul>
		<div class="tab-content">
            <!----TABLE LISTING STARTS---->
            <div class="tab-pane box active" id="list">
                <table class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('name');?></div></th>
							          <th><div><?php echo get_phrase('icon_url');?></div></th>
                        <th><div><?php echo get_phrase('options');?></div></th>
						        </tr>
					        </thead>
                  <tbody>
                    	<?php
							               foreach($categories as $row):
						          ?>
                        <tr>
              							<td><?php echo $row['category_name'];?></td>
              							<td><?php echo $row['icon_url'];?></td>
              							<td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                        <!-- EDITING LINK -->
                                        <li>
                                              <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_category/<?php echo $row['id'];?>');">
                                              <i class="entypo-pencil"></i>
                                              <?php echo get_phrase('edit');?>
                                              </a>
                                        </li>
                                              <li class="divider"></li>
                                              <!-- DELETION LINK -->
                                              <li>
                                                  <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/manage_category/do_delete/<?php echo $row['id'];?>');">
                                                    <i class="entypo-trash"></i>
                                                    <?php echo get_phrase('delete');?>
              										                </a>
              									              </li>
                                    </ul>
                                </div>
                      			</td>
                          </tr>
                          <?php endforeach;?>
                </tbody>
            </table>
			</div>

            <!----TABLE LISTING ENDS--->
                <!----CREATION FORM STARTS---->
           <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('admin/manage_category/do_create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data' ));?>
                        <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="category_name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('icon_url');?></label>
                                <div class="col-sm-5">
                                    <input type="file" class="form-control" accept=".png" name="userfile" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('add_category');?></button>
                              </div>
                        </div>
                    </form>
                </div>
            </div>
            <!----CREATION FORM ENDS--->


		</div>
	</div>
</div>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ----->
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		var datatable = $("#table_export").dataTable();

		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});

</script>
