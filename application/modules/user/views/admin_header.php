<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cash Register</title>

    <!-- Core CSS - Include with every page -->
   <link href="<?=$assetsurl?>css/bootstrap.min.css" rel="stylesheet">
     <link href="<?=$assetsurl?>font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?=$assetsurl?>css/sb-admin.css" rel="stylesheet">
</head>

<body>

    <div id="wrapper">

        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
           
			 <div class="navbar-header">               
                <a class="navbar-brand" href="index">Cash Register Management</a>
            </div>
			<div> <?php if(isset($error) && !is_array($error)){ echo $error; } ?> </div>
            
            <div class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu">
						<li><a href="<?=base_url()?>user/create_receipt">Create Receipt</a> </li>
						<li><a href="<?=base_url()?>user/list_all_receipts">List Receipts</a> </li>	
						<li><a href="<?=base_url()?>login/user_logout">Logout</a> </li						
					</ul>
                    <!-- /#side-menu -->
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav><input type="hidden" id="currentpage" value="<?php if(isset($pageinfo['url_method'])){ echo $pageinfo['url_method']; } else echo ''; ?>"  />