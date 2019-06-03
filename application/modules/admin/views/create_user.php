<?php $this->view("admin_header"); ?>
<?php if(!isset($mode)) $mode = 'create'; ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo ucfirst($mode); ?> User</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
			<?php if($this->session->flashdata('msg')){ ?>
					<div class="alert alert-danger">
						<?=$this->session->flashdata('msg')?>
					</div>
			<?php }	?>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Put User Information
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="" method="post" onSubmit="return submituser()">
                                    	<input type="hidden" name="mode" id="mode" value="<?php if(isset($mode)) echo $mode; else echo "create"; ?>" />
                                        <?php if(isset($mode) && $mode == 'update' && isset($userdata) && is_array($userdata) && isset($userdata['user_id']))
										{ ?>
                                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $userdata['user_id']; ?>"  />
                                        <?php } ?>
                                        <div class="form-group">
                                            <label>User Full Name</label>
                                            <input type="text" required="required" id="user_full_name" placeholder="Full Name" name="user_full_name" class="form-control" value="<?php if(isset($mode) && $mode == 'update' && isset($userdata) && is_array($userdata) && isset($userdata['user_name'])) echo $userdata['user_name']; ?>" />
                                            <!--<p class="help-block">Example block-level help text here.</p>-->
                                        </div>
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" required="required" id="username" placeholder="Username" name="username" class="form-control" value="<?php if(isset($mode) && $mode == 'update' && isset($userdata) && is_array($userdata) && isset($userdata['user_username'])) echo $userdata['user_username']; ?>" />
                                        </div>
                                         <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" required="required" id="password" placeholder="<?php if(isset($mode) && $mode == 'update' && isset($userdata) && is_array($userdata) && isset($userdata['user_password'])) echo str_repeat("•",strlen($userdata['user_password'])); ?>" name="password" class="form-control" value="<?php if(isset($mode) && $mode=='create' && isset($user_password_new)) { echo $user_password_new; } ?>" />
                                        </div>
                                         <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" required="required" id="user_email" placeholder="Email Address" name="user_email" class="form-control" value="<?php if(isset($mode) && $mode == 'update' && isset($userdata) && is_array($userdata) && isset($userdata['user_email'])) echo $userdata['user_email']; ?>" />
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>User Profile</label>
                                            <select name="user_role"  required="required" id="user_role" class="form-control"<?php if(isset($mode) && $mode == 'update' && isset($userdata) && is_array($userdata) && isset($userdata['user_role_id'])) echo 'disabled="disabled"'; ?> >
                                                <?php foreach($roles as $role) { ?>
                                                	<option value="<?php echo $role['role_id']; ?>" vendordata="<?php if($role['vendor_required'] ==1) echo "required"; ?>" <?php if(isset($mode) && $mode == 'update' && isset($userdata) && is_array($userdata) && isset($userdata['user_role_id']) && $userdata['user_role_id'] == $role['role_id']) echo 'selected="selected"'; ?> ><?php echo $role['role_name']; ?></option>
                                                    <?php } ?>
                                            </select>
                                           <?php if(isset($mode) && $mode == 'update' && isset($userdata) && is_array($userdata) && isset($userdata['user_role_id'])){ ?> <input type="hidden" name="user_role" id="user_role_hidden" value="<?php echo $userdata['user_role_id']; ?>" /> <?php } ?>
                                        </div>                                      
										
                                        <button type="submit" class="btn btn-default"><?php echo ucfirst($mode); ?></button>
                                    </form>
                                </div>
                                
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

<?php $this->view("admin_footer"); ?>