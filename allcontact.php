<?php
    $con=mysqli_connect('localhost','root','');
    if(!$con){
        echo "not connected to server";
    }
    if(!mysqli_select_db($con,'booking')){
        echo "database not selected";
    }
    $query="select * from contactform order by contactid desc";
    $res=mysqli_query($con,$query);
    $numofrows=mysqli_num_rows($res);
    if($numofrows!=0){
?>
<!DOCTYPE html>
<html>
    <head>
    <title>All contact req</title>
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
            <th colspan="8"><h2>All contact requests</h2></th>
        </tr>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone number</th>
            <th>Date</th>
            <th>Comments</th>
        </tr>
    <?php 
        while($rows=mysqli_fetch_assoc($res))
        {
    ?>
        <tr>
            <td><?php echo $rows['contactid']; ?></td>
            <td><?php echo $rows['contactname']; ?></td>
            <td><?php echo $rows['contactphno']; ?></td>
            <td><?php echo date("d-m-Y",strtotime($rows['date'])); ?></td>
            <td><?php echo $rows['comments']; ?></td>
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
    echo "No contact requests";
}
?>