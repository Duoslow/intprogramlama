<?php
include('templates/main.php');
require_once("config.php");
?>
<form action="" method="post" class="kuldetay">
<div><span>Adınız:</span> <span><input type="text" name="kitap_adi"></span></div>
<div><span>Soyadınız:</span> <span><input type="text" name="kitap_adi"></span></div>
<div><span>Adres:</span>
 <span>

 <span>İl:</span>
 <script type="text/javascript">  
    var strUser;
    function test1(val){
        $.ajax({
		type: "POST",
		url: "/listeleme/ilcelist.php",
		data:'il_id='+val,
		success: function(data){
			$("#ilceler").html(data);
		}
	});
    }
</script>

 <select name="yazar_id" id='il' onchange="test1(this.value)">
 <option value='0'>-</option>
 <?php
          require_once 'config.php';
          $sqli = "SELECT id,il FROM `iller` ORDER BY id";
          $result = mysqli_query($baglanti, $sqli);
           while ($row = mysqli_fetch_array($result)) {
            echo '<option value='.$row['id'].'>'.$row['il'].'</option>';
           }
  ?>
  </select>
 <span>İlçe:</span>
 <select name="yazar_id" id="ilceler">
    <option value="">Lütfen önce il seçin!</option>
 </select>
 <span>Adres:</span><input type="text" name="kitap_adi">
 </span></div>



 <div><span>Üniversite:</span>
 <span>

 <span>Üniversite:</span>
 <script type="text/javascript">  
    
    function test2(val){
        $.ajax({
		type: "POST",
		url: "/listeleme/unifakulte.php",
		data:'uni_ad='+val,
		success: function(data){
			$("#fakulteler").html(data);
		}
	});
    }
    function test3(val,val2){
        console.log(val)

        $.ajax({
		type: "POST",
		url: "/listeleme/unibolum.php",
		data:{'uni_ad':document.getElementById('uniler').value,'fakulte': val },
		success: function(data){
			$("#bolumler").html(data);
		}
	});
    }
</script>

 <select name="yazar_id" id='uniler' onchange="test2(this.value)">
 <option value='0'>-</option>
 <?php
          require_once 'config.php';
          $sqli = "select id,adi from uniler group by adi having count(*) >1 order by id";
          $result = mysqli_query($baglanti, $sqli);
           while ($row = mysqli_fetch_array($result)) {
            echo '<option value="'.$row['adi'].'">'.$row['adi'].'</option>';
           }
  ?>
  </select>
 <span>Fakülte:</span>
 <select name="yazar_id" id="fakulteler" onchange="test3(this.value)">
    <option value="">Lütfen önce Üniversite seçin!</option>
 </select>
 <span>Bölüm:</span>
 <select name="yazar_id" id="bolumler">
    <option value="">Lütfen önce fakülte seçin!</option>
 </select>
 </span></div>

<div><span>Doğum tarihi:</span><span> <input type="date" name="yayin_tarihi"></span></div>

<input type="submit" value="Bilgilerimi Güncelle"  id="kitap" name="">
</form>
<?php
include('templates/bottom.php');
?>