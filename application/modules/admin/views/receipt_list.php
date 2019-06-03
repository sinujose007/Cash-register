<?php $this->view("admin_header"); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css"/>
<style type="text/css">
    table.dataTable tbody th, table.dataTable tbody td {
        padding: 3px 13px;
        font-size:13px;
        border-width:0.5px;
    }table.dataTable thead th, table.dataTable thead td {
        border-bottom: 1px solid #111;
        padding: 1px 10px;
        font-size:12px;
    }
</style>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Receipts</h1>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-default">
           
          
         <div class="panel-body">
                <div class="table-responsive">

                    <table id="bk_kpng" class="display table table-bordered table-striped mg-t datatable editable-datatable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
								<th>#</th>
                                <th>Create Date</th>
								<th>USER</th>
                                <th>Receipt Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>                                        
                            <?php
                            if (isset($report_sup) && is_array($report_sup) && !empty($report_sup)) {
                                foreach ($report_sup as $loaded) { $i=1;?>

                                    <tr>
									    <td><?=$i?></td>
                                        <td><?php echo $loaded['CREATE_DATE']; ?></td>
										<td><?php echo $loaded['NAME']; ?></td>
                                        <td><?php echo $loaded['RECEIPT_NAME']; ?></td>
										<?php if($loaded['STATUS'] == 0 ) { ?>
										    <td>Created&nbsp;&nbsp;
											<a href='<?=base_url()?>admin/list_products_receipts/<?=$loaded['RECEIPT_PK']?>' >View Products</a>&nbsp;&nbsp;
											</td>
										<?php } else{ ?>
											<td>Finished&nbsp;&nbsp;
											</td>
										<?php } ?>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                               
                            <?php } else { ?>
                                <tr><td colspan="4"> No Records Found </td></tr>
                            <?php } ?> 

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
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="//code.jquery.com/jquery-1.12.3.js"></script>  
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script> 
<!-- /#wrapper -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
<!-- Core Scripts - Include with every page -->
<script src="<?= $assetsurl ?>js/bootstrap.min.js"></script>
<script src="<?= $assetsurl ?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
<!-- SB Admin Scripts - Include with every page -->
<script src="<?= $assetsurl ?>js/sb-admin.js"></script>
<script src="<?= $assetsurl ?>js/jquery.datetimepicker.js"></script>
</body>
</html>