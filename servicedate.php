<?php
    $con=mysqli_connect('localhost','root','');
    if(!$con){
        echo "not connected to server";
    }
    if(!mysqli_select_db($con,'booking')){
        echo "database not selected";
    }
    $date=$_POST['servicedate'];
    $newdate=date('Y-m-d',strtotime($date));
    $query="select * from appointment where servicedate='$newdate'";
    $res=mysqli_query($con,$query);
    $numofrows=mysqli_num_rows($res);
    if($numofrows!=0){
?>
<!DOCTYPE html>
<html>
    <head>
    <title>All bookings</title>
    <style>
        #allbook{
            width: 100%;
            border-collapse:collapse;
        }
    </style>
    </head>
    <body>
    <table id="allbook" align="center" border="1px">
        <tr>
            <th colspan="8"><h2>List of appointments on <?php echo date('d-m-Y',strtotime($date));?></h2></th>
        </tr>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone number</th>
            <th>Booking date</th>
            <th>Service date</th>
            <th>Time</th>
            <th>Service</th>
            <th>Details</th>
        </tr>
    <?php 
        while($rows=mysqli_fetch_assoc($res))
        {
    ?>
        <tr>
            <td><?php echo $rows['id']; ?></td>
            <td><?php echo $rows['name']; ?></td>
            <td><?php echo $rows['phone']; ?></td>
            <td><?php echo date('d-m-Y',strtotime($rows['bookingdate'])); ?></td>
            <td><?php echo date('d-m-Y',strtotime($rows['servicedate'])); ?></td>
            <td><?php echo $rows['time']; ?></td>
            <td><?php echo $rows['service']; ?></td>
            <td><?php echo $rows['details']; ?></td>
        </tr>
        <?php    
        }
        ?>
    
    </table>
</body>
</html>
<?php
}
else{
    echo "No Appointments";
}
?>