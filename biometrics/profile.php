<?php  
include 'includes/config.php';
?>
<html>
<head>
<title>RIDE HISTORY</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<style>
    .bs-example{
        margin: 20px;
    }
</style>
</head>
<body>
    <br><br>
<?php
    $tid = $_GET['tid'];
    $msql="SELECT DISTINCT * FROM pdata INNER JOIN ridehistory ON pdata.pname = ridehistory.rname WHERE id='$tid' ";
    $res = mysqli_query($mysqli,$msql);
    $count = mysqli_num_rows($res);
?>
<div class="bs-example">
    <table class="table">
        <thead>
            <tr>
                <th>Sno.</th>
                <th>Name</th>
                <th>Ride timing</th>
            </tr>
        </thead>
        <?php  
            $i = 0;
            while ( $num = mysqli_fetch_array($res)) 
            {
                $id=$num['id'];
                $pname = $num['pname'];
                $rides = $num['rides'];
                $time = $num['time'];
                $i++;
        ?>
        <tbody>
            <tr class="table-success">
                <td><?php echo $i; ?></td>
                <td><?php echo $pname; ?></td>
                <td><?php echo $time; ?></td>
            </tr>
        </tbody>
        <?php 
        }
        $r = $rides-$i;
        $tid = $_GET['tid'];
        if($r!==0)
        {
        $sq = "UPDATE pdata SET rides = '$r' WHERE id='$tid' ";
        }   
        ?>
    </table>
    <h1 class="text-center">Total tokens left: <?php echo $r; ?></h1>
</div>
</body>
</html>                            