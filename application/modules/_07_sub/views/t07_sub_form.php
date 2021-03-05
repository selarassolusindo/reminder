<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">T07_sub <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Idmain <?php echo form_error('idmain') ?></label>
            <input type="text" class="form-control" name="idmain" id="idmain" placeholder="Idmain" value="<?php echo $idmain; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Kode <?php echo form_error('Kode') ?></label>
            <input type="text" class="form-control" name="Kode" id="Kode" placeholder="Kode" value="<?php echo $Kode; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('Nama') ?></label>
            <input type="text" class="form-control" name="Nama" id="Nama" placeholder="Nama" value="<?php echo $Nama; ?>" />
        </div>
	    <div class="form-group">
            <label for="timestamp">Created At <?php echo form_error('created_at') ?></label>
            <input type="text" class="form-control" name="created_at" id="created_at" placeholder="Created At" value="<?php echo $created_at; ?>" />
        </div>
	    <div class="form-group">
            <label for="timestamp">Updated At <?php echo form_error('updated_at') ?></label>
            <input type="text" class="form-control" name="updated_at" id="updated_at" placeholder="Updated At" value="<?php echo $updated_at; ?>" />
        </div>
	    <input type="hidden" name="idsub" value="<?php echo $idsub; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('_07_sub') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>