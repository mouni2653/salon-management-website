<?php
    $con=mysqli_connect('localhost','root','');
    if(!$con){
        echo "not connected to server";
    }
    if(!mysqli_select_db($con,'booking')){
        echo "database not selected";
    }
    $phone=$_POST['phone'];
    $query="select * from billing where billphno='$phone'";
    $res=mysqli_query($con,$query);
    $numofrows=mysqli_num_rows($res);
    if($numofrows!=0){
?>
<!DOCTYPE html>
<html>
    <head>
    <title>Billings</title>
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
            <th colspan="8"><h2>All Bill Transactions of <?php echo "$phone"; ?></h2></th>
        </tr>
        <tr>
            <th>ID</th>
            <th>reciept no:</th>
            <th>Name</th>
            <th>Phone number</th>
            <th>Date</th>
            <th>services</th>
            <th>Total</th>
            <th>cash/net banking</th>
        </tr>
    <?php 
        while($rows=mysqli_fetch_assoc($res))
        {
    ?>
        <tr>
            <td><?php echo $rows['id']; ?></td>
            <td><?php echo $rows['rcno']; ?></td>
            <td><?php echo $rows['billname']; ?></td>
            <td><?php echo $rows['billphno']; ?></td>
            <td><?php echo date("d-m-Y",strtotime($rows['billdate'])); ?></td>
            <td><?php echo $rows['item']; ?></td>
            <td><?php echo $rows['total']; ?></td>
            <td><?php echo $rows['paidby']; ?></td>
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
    echo "No bill transactions";
}
?>