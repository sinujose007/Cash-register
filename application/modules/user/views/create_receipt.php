<?php $this->view("admin_header"); ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php if (isset($mode)) echo ucfirst($mode);
else echo "Create"; ?> Receipt</h1>
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
                            <form action="<?= (isset($mode) && $mode == 'update') ? "update_receipt" : "create_receipt"; ?>" method="post" enctype="multipart/form-data" id="product_form">
                                <input type="hidden" name="mode" value="<?php if (isset($mode) && $mode != '') echo $mode; else echo "create"; ?>" id="mode" />
                                <?php if (isset($mode) && $mode == 'update' && isset($pdata) && is_array($pdata) && isset($pdata['RECEIPT_PK'])) {
                                    ?>
                                    <input type="hidden" name="RECEIPT_PK" id="RECEIPT_PK" value="<?php echo $pdata['RECEIPT_PK']; ?>"  />  <?php } ?>                                
                               
                                <div class="form-group">
                                    <label>Receipt Name</label>
                                    <input required="required" <?php if ($mode == 'update') { ?> readonly="readonly" <?php } ?> type="text" id="RECEIPT_NAME" placeholder="Receipt Name" name="RECEIPT_NAME" class="form-control" value="<?php if (isset($mode) && $mode == 'update' && isset($pdata) && is_array($pdata) && isset($pdata['RECEIPT_NAME'])) echo $pdata['RECEIPT_NAME']; ?>" >
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
                                        
