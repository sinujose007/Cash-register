<?php $this->view("admin_header"); ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Products</h1>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                 <div class="panel panel-default">
                        <div class="panel-heading">
                            List of all the Products
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="userslist">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product Name</th>
											<th>Barcode</th>
                                            <th>Product Cost</th>
                                            <th>VAT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; foreach($denoms as $denom) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $denom['PRODUCT_NAME']; ?></td>
                                            <td><?php echo $denom['BARCODE']; ?></td>
                                            <td><?php echo $denom['PRODUCT_COST']; ?></td>
											<td><?php echo $denom['VAT_CLASS'].'- ['.$denom['VAT_RATE'] ?> % ]</td>
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
