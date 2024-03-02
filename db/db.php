<?php 
$connect = new mysqli("localhost","root","","webdienmay");
if($connect){
    mysqli_query($connect,'SET NAMES "UTF8"');
}else {
    echo "error connect";
}
?>