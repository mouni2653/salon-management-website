<?php
    $con=mysqli_connect('localhost','root','');
    if(!$con){
        echo "not connected to server";
    }
    if(!mysqli_select_db($con,'booking')){
        echo "database not selected";
    }
    $name=$_POST['cname'];
    $phoneno=$_POST['phone'];
    $date=$_POST['date'];
    $sdate=strtotime($_POST['date']);
    $servicedate=date("Y-m-d",$sdate);
    $time=$_POST['time'];
    $service=$_POST['service'];
    $details=$_POST['details'];
    $sql="INSERT INTO APPOINTMENT(name,phone,bookingdate,servicedate,time,service,details) VALUES ('$name','$phoneno',CURDATE(),'$servicedate','$time','$service','$details')";
    $count="select cphno from customers where cphno='$phoneno'";
    $data=mysqli_query($con,$count);
    $c=mysqli_num_rows($data);
    if($c==0){
         $sql2="INSERT INTO CUSTOMERS(cname,cphno) VALUES('$name','$phoneno')";
         mysqli_query($con,$sql2);
    }
    if(!mysqli_query($con,$sql)){
        echo "Sorry Please try again";
    }
    else{
        require 'phpmail/PHPMailerAutoload.php';
        $mail=new PHPMailer;
        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->Port=587;
        $mail->SMTPAuth=true;
        $mail->SMTPSecure='tls';
        
        $mail->Username='kairasalon123@gmail.com';
        $mail->Password='kaira1234';
        $mail->isHTML(true);
        $mail->setFrom('kairasalon123@gmail.com','kaira');
        $mail->addAddress('kairasalon123@gmail.com');
        $mail->Subject='You have an appointment req';
        $mail->Body='from '.$name.'<br>phno: '.$phoneno.'<br>booked on Date:'.$date.' and time at:'.$time.'<br>service: '.$service.'<br>Details: '.$details;
        if(!$mail->send()){
            echo "Sorry Please try again";
        }
        else{
            echo "Thank You! Your appointment has been scheduled";
        }
    }
?>