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
        <h2 style="margin-top:0px">T05_property List</h2> -->
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('_05_property/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('_05_property/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('_05_property'); ?>" class="btn btn-default">Reset</a>
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
		<th>Nama</th>
		<!-- <th>Created At</th>
		<th>Updated At</th> -->
		<th>Action</th>
            </tr><?php
            foreach ($_05_property_data as $_05_property)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $_05_property->Nama ?></td>
			<!-- <td><?php echo $_05_property->created_at ?></td>
			<td><?php echo $_05_property->updated_at ?></td> -->
			<td style="text-align:center" width="200px">
				<?php
				echo anchor(site_url('_05_property/read/'.$_05_property->idproperty),'Read');
				echo ' | ';
				echo anchor(site_url('_05_property/update/'.$_05_property->idproperty),'Update');
				echo ' | ';
				echo anchor(site_url('_05_property/delete/'.$_05_property->idproperty),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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
		<?php echo anchor(site_url('_05_property/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('_05_property/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    <!-- </body>
</html> -->
