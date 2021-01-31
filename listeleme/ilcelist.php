<?php include_once("../config.php"); ?>
<?php $listIl = $baglanti->query("SELECT * FROM ilceler WHERE il_id = '$_POST[il_id]'"); ?>
<?php foreach ($listIl as $list) { ?>
	<option value="<?php echo $list['il_id']; ?>"><?php echo $list['ilce']; ?></option>
<?php } ?>