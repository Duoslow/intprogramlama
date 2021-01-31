<?php include_once("../config.php"); ?>
<?php $listbolum = $baglanti->query("SELECT * FROM uniler WHERE adi = '$_POST[uni_ad]' AND fakulte = '$_POST[fakulte]' "); ?>
<option value='0'>-</option>
<?php foreach ($listbolum as $list) { ?>
	<option value="<?php echo $list['bolum']; ?>"><?php echo $list['bolum']; ?></option>
<?php } ?>