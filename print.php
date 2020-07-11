<?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    $con=mysqli_connect('localhost','root','');
    if(!$con){
        echo "not connected to server";
    }
    if(!mysqli_select_db($con,'booking')){
        echo "database not selected";
    }
    $name=$_POST["name"];
    $phno=$_POST["phno"];
    $date=strtotime($_POST["date"]);
    $ndate=date('Y-m-d',$date);
    $num1=count($_POST["item"]);
    $rcqry="SELECT `rcno` FROM `billing` ORDER BY id DESC LIMIT 1";
    $lstrc=mysqli_query($con,$rcqry);
    $data=mysqli_fetch_assoc($lstrc);
    $rcno=$data['rcno'];
    $rcno++;
    $paidby=$_POST["paid"];
    if($num1>0){
        $inc="";
        $price1="";
        $total=0;
        $item1="";
        for ($i=0; $i<$num1;$i++){
            $inc.=$_POST["item"][$i]." ".$_POST["price"][$i]." ";
            $price1.=$_POST["price"][$i]."</br>";
            $item1.=$_POST["item"][$i]."</br>";
            $total+=$_POST["price"][$i];
        }
$qry1="INSERT INTO BILLING(billname,billphno,billdate,item,rcno,total,paidby)VALUES('$name','$phno','$ndate','$inc','$rcno','$total','$paidby')";
    }
    if(!mysqli_query($con,$qry1)){
        echo "Sorry Please try again";
    }
    else{
        $count="select cphno from customers where cphno='$phno'";
    $data=mysqli_query($con,$count);
    $c=mysqli_num_rows($data);
    if($c==0){
         $sql2="INSERT INTO CUSTOMERS(cname,cphno) VALUES('$name','$phno')";
         mysqli_query($con,$sql2);
    }
    }
    
?>
<html>
    <head>
        <link rel="stylesheet" href="admin1.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        function printdata()
        {
           var divToPrint=document.getElementById("printtable");
           newWin= window.open("");
           newWin.document.write(divToPrint.outerHTML);
           newWin.print();
           newWin.close();
        }   
    </script>
    <style>
        @media print{
            .printbtn{
                display: none;}
            
            }
    </style>
    </head>
<body>
    <div align="center">
        <table id="printtable" border="1px solid black" style="border-collapse:collapse;width:auto;text-align: center;
    border: 1px solid black;">
            <tbody><tr><td colspan="2"><b>Kaira Salon</b><br>
                Manikanta towers ,Funtimes club road,Vijayawada,520008,
                <br>phone:9858552255
                </td>
            </tr>
            
            <tr>
                <td colspan="2">Name: <b><?php echo " ".$_POST['name']." / ".$_POST['phno']."  ";?></b>Date:<b><?php echo "  ".$_POST['date']." ";?></b> <br> Rc.no:<?php echo "  ".$rcno;?></td>
            </tr>
            <tr>
            <td>Item</td>
            <td>Price</td>
            </tr>
            <tr>
                <td>
                    <?php echo $item1; ?>
                </td>
                <td>
                    <?php echo $price1; ?>
                </td>
            </tr>
            <tr>
                <td>Total</td>
                <td><?php echo $total; ?></td>
            </tr>
            </tbody>
        </table>
        <br>
        <button target="_blank" onclick="printdata()" class="printbtn">print</button>
        <a href="bill.html"><input type="button" value="goback" class="printbtn"></a>
    </div>
</body>
</html>