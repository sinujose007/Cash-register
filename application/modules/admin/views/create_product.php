<?php $this->view("admin_header"); ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php if (isset($mode)) echo ucfirst($mode);
else echo "Create"; ?> Product</h1>
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
                            <form action="<?= (isset($mode) && $mode == 'update') ? "update_product" : "create_product"; ?>" method="post" enctype="multipart/form-data" id="product_form">
                                <input type="hidden" name="mode" value="<?php if (isset($mode) && $mode != '') echo $mode; else echo "create"; ?>" id="mode" />
                                <?php if (isset($mode) && $mode == 'update' && isset($pdata) && is_array($pdata) && isset($pdata['PRODUCT_PK'])) {
                                    ?>
                                    <input type="hidden" name="PRODUCT_PK" id="PRODUCT_PK" value="<?php echo $pdata['PRODUCT_PK']; ?>"  />  <?php } ?>                                
                               
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input required="required" <?php if ($mode == 'update') { ?> readonly="readonly" <?php } ?> type="text" id="PRODUCT_NAME" placeholder="Product Name" name="PRODUCT_NAME" class="form-control" value="<?php if (isset($mode) && $mode == 'update' && isset($pdata) && is_array($pdata) && isset($pdata['PRODUCT_NAME'])) echo $pdata['PRODUCT_NAME']; ?>" >
                                </div>
                                
                                <div class="form-group">
                                    <label>Product Cost</label>
                                    <input required="required" type="text" id="PRODUCT_COST" placeholder="Product Value" name="PRODUCT_COST" class="form-control" value="<?php if (isset($mode) && $mode == 'update' && isset($pdata) && is_array($pdata) && isset($pdata['PRODUCT_COST'])) echo $pdata['PRODUCT_COST']; ?>">
                                   
                                </div>
                                <div class="form-group">
                                    <label>Barcode</label>
                                    <input required="required" type="text" id="BARCODE" placeholder="Barcode" name="BARCODE" class="form-control" value="<?php if (isset($mode) && $mode == 'update' && isset($pdata) && is_array($pdata) && isset($pdata['BARCODE'])) echo $pdata['BARCODE']; ?>">
                              
                                </div>
                                <div class="form-group">
                                    <label>Product VAT</label>
									<select class="form-control" required="required" name="VAT_FK" id="VAT_FK" >
									<option value="">Select</option>
									<?php foreach($vat as $k=>$v){ ?>
										<option value="<?=$v['VAT_PK']?>"><?=$v['VAT_CLASS']?>- [ <?=$v['VAT_RATE']?> % ] </option>
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
                                        
