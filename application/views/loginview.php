<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash Receipt</title>
    <!-- Core CSS - Include with every page -->
    <link href="<?=$assetsurl?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=$assetsurl?>font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?=$assetsurl?>css/sb-admin.css" rel="stylesheet">

</head>

<body>

    <div class="container">
        <div class="row">
		<?php 
			$loginerror = getsessiondata('loginerror');
			if($loginerror)
			{
				if(is_array($loginerror))
				foreach($loginerror as $error)
				{ ?>
					<div class="alert alert-danger">
						<?=$error?><!--Whoops! We didn't recognise your username or password. Please try again.-->
					</div>
				<?php } else{ ?>
					<div class="alert alert-danger">
						<?=$loginerror?><!--Whoops! We didn't recognise your username or password. Please try again.-->
					</div>
				<?php } 
			} 

		?>
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
						<form action="<?php echo base_url()."login/submitlogin/";?>" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="user_username" type="text" autofocus />
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="user_password" type="password"  />
                                </div>
                                <input type="hidden" name="user_validation_check" value="<?=$validationcode?>" >
                                <!-- Change this to a button or input when using this as a form -->
                                <button onClick="$('form').submit()" class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Scripts - Include with every page -->
    <script src="<?=$assetsurl?>js/jquery-1.10.2.js"></script>
    <script src="<?=$assetsurl?>js/bootstrap.min.js"></script>
    <script src="<?=$assetsurl?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?=$assetsurl?>js/sb-admin.js"></script>

</body>
</html>
