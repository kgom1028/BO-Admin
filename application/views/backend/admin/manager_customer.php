<div class="row">
	<div class="col-md-12">

    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
					<?php echo get_phrase('User List');?>
                </a>
			</li>

		</ul>
    	<!------CONTROL TABS END------->

		<div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane box active" id="list">
				<span style="font-size: medium;font-weight: bold;color: red;"><?php echo $this->session->flashdata('flash_message');?></span>

                <table class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
							<th><div><?php echo get_phrase('name');?></div></th>
              <th><div><?php echo get_phrase('email');?></div></th>
							<th><div><?php echo get_phrase('first_name');?></div></th>
							<th><div><?php echo get_phrase('last_name');?></div></th>
							<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php
							foreach($customers as $row):
						?>
                        <tr>
							<td><?php echo $row['username'];?></td>
							<td><?php echo $row['email'];?></td>
							<td><?php echo $row['firstname'];?></td>
							<td><?php echo $row['lastname'];?></td>
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/manage_customer/do_delete/<?php echo $row['id'];?>');">
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
