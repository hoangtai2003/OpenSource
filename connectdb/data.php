/* The code is retrieving data from a database table called "quanhuyen" based on a specific condition. */
<?php
include("./connect.php");
$key = $_REQUEST["id"];
$sql = "select * from quanhuyen where idTT = '$key'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
    ?>
        <option><?= $row['nameQH']?></option>
    <?php }
}
?>
