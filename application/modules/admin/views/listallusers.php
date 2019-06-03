<?php $this->view("admin_header"); ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Users</h1>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
				<?php if($this->session->flashdata('error')){ ?>
					<div class="alert alert-danger">
						<?=$this->session->flashdata('error')?>
					</div>
				<?php }	?>
				<?php if($this->session->flashdata('success')){ ?>
					<div class="alert alert-success">
						<?=$this->session->flashdata('success')?>
					</div>
				<?php }	?>
                 <div class="panel panel-default">
                        <div class="panel-heading">
                            List of all the Users 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                               <table class="table table-striped table-bordered table-hover dataTable no-footer" id="userslist">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Full Name</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th>Start URL</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; foreach($users as $user) { ?>
                                        <tr>
                                            <td><?php echo $user['user_id']; ?></td>
                                            <td><?php echo $user['user_name']; ?></td>
                                            <td><?php echo $user['user_username']; ?></td>
                                            <td><?php echo $user['user_role_name']; ?></td>
                                            <td><?php echo $user['user_start_url']; ?></td>
                                            <td><a href="update_user?userid=<?php echo $user['user_id']; ?>">Update User</a></td>
                                        </tr>
                                     <?php $i++; } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
            </div>
            <!-- /.row -->
        </div>
        <?php $this->view("admin_footer"); ?>
