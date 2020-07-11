<?php
    $con=mysqli_connect('localhost','root','');
    if(!$con){
        echo "not connected to server";
    }
    if(!mysqli_select_db($con,'booking')){
        echo "database not selected";
    }
    $query="select * from customers order by id desc";
    $res=mysqli_query($con,$query);
    $numofrows=mysqli_num_rows($res);
    if($numofrows!=0){
?>
<!DOCTYPE html>
<html>
    <head>
    <title> Customers Details</title>
    <style>
        #allbook{
            width: 100%;
            border-collapse:collapse;
            text-align: center;
        }
    </style>
    </head>
<body>
    <table id="allbook" align="center" border="1px">
        <tr>
            <th colspan="8"><h2>Customers List</h2></th>
        </tr>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone number</th>
        </tr>
    <?php 
        while($rows=mysqli_fetch_assoc($res))
        {
    ?>
        <tr>
            <td><?php echo $rows['id']; ?></td>
            <td><?php echo $rows['cname']; ?></td>
            <td><?php echo $rows['cphno']; ?></td>
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
    echo "No Customers";
}
?>