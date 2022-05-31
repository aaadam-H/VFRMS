<?php
    include('../connection.php');

    $sql = "SELECT * from image where id='1'";
    $result = mysqli_query($con,$sql);

    if (mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $dir = $row['img_dir'];
?>
        <div class="container">
            <img src="<?php echo $dir?>" alt="" size='50%'>
        </div>
        <?php
    }

?>