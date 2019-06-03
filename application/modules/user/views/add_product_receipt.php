<?php $this->view("admin_header"); ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php if (isset($mode)) echo ucfirst($mode);
else echo "Create"; ?>  Add Product Receipt</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row" class="vendordata">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Put  Information
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div id="messages">
                                <?php if (isset($error) && $error != '') { ?>
                                <div class="alert alert-danger">
                                <?php echo $error; ?>
                                </div> <?php } ?>
                                <?php if (isset($message) && $message != '') { ?>
                                <div class="alert alert-success">
								<?php echo $message; ?>
                                </div> <?php } ?>
                        </div>
                        <div class="col-lg-6">
                            <form action="<?=base_url()?>user/product_receipt_submit" method="post" enctype="multipart/form-data" id="product_form">
                                <input type="hidden" name="RECEIPT_FK" id="RECEIPT_FK" value="<?php echo $RECEIPT_PK;  ?>"  />                                
                               
                                <div class="form-group">
                                    <label>Receipt Name</label>
									<span><?=$receipt['RECEIPT_NAME']?></span>
                                 </div>
								 <div class="form-group">
                                    <label>Select Product</label>
									<select required="required" name="BARCODE" id="BARCODE" >
									<option value="">Select</option>
									<?php foreach($plist as $k=>$v){ ?>
									<option value="<?=$v['BARCODE']?>"><?=$v['PRODUCT_NAME']?></option>
									<?php } ?>
									</select>
                                 </div>
                                
                                <button id="denomsubmitbutton" type="submit" class="btn btn-default"><?php if (isset($mode)) echo ucfirst($mode); else echo "Create"; ?></button>
                                <!-- <button type="reset" class="btn btn-default">Reset</button>-->
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

</div>
<!-- /#page-wrapper -->
<?php $this->view("admin_footer"); ?>
                                        
