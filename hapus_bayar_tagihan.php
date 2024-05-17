<?php
$hapus=mysqli_query($conn,"delete from bayar_tagihan where idbayar='$_GET[id]'");
if($hapus)
{
echo "<script>window.alert('Data Berhasil dihapus');document.location='../tampil-bayar-tagihan.html'</script>";
}
?>