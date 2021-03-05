<!-- <!doctype html>
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
        <h2 style="margin-top:0px">T06_main List</h2> -->
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('_06_main/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('_06_main/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('_06_main'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Kode</th>
		<th>Nama</th>
		<!-- <th>Created At</th>
		<th>Updated At</th> -->
		<th>Action</th>
            </tr><?php
            foreach ($_06_main_data as $_06_main)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $_06_main->Kode ?></td>
			<td><?php echo $_06_main->Nama ?></td>
			<!-- <td><?php echo $_06_main->created_at ?></td>
			<td><?php echo $_06_main->updated_at ?></td> -->
			<td style="text-align:center" width="200px">
				<?php
				echo anchor(site_url('_06_main/read/'.$_06_main->idmain),'Read');
				echo ' | ';
				echo anchor(site_url('_06_main/update/'.$_06_main->idmain),'Update');
				echo ' | ';
				echo anchor(site_url('_06_main/delete/'.$_06_main->idmain),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('_06_main/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('_06_main/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    <!-- </body>
</html> -->
