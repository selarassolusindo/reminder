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
        <h2 style="margin-top:0px">T08_description Read</h2>
        <table class="table">
	    <tr><td>Idsub</td><td><?php echo $idsub; ?></td></tr>
	    <tr><td>Kode</td><td><?php echo $Kode; ?></td></tr>
	    <tr><td>Nama</td><td><?php echo $Nama; ?></td></tr>
	    <tr><td>Created At</td><td><?php echo $created_at; ?></td></tr>
	    <tr><td>Updated At</td><td><?php echo $updated_at; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('_08_description') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>