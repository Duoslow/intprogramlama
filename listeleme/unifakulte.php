<?php include_once("../config.php"); ?>
<?php $listfakulte = $baglanti->query("SELECT * FROM uniler WHERE adi = '$_POST[uni_ad]' group by fakulte having count(*) >1 "); ?>
<option value='0'>-</option>
<?php foreach ($listfakulte as $list) { ?>
	<option value="<?php echo $list['fakulte']; ?>"><?php echo $list['fakulte']; ?></option>
<?php } ?>