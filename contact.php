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
    $comments=$_POST['details'];
    $sql="INSERT INTO CONTACTFORM(contactname,contactphno,comments,date) VALUES('$name','$phoneno','$comments',CURDATE())";
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
        $mail->Subject='You have an contactform req';
        $mail->Body='from '.$name.'<br>phno: '.$phoneno.'<br>Details: '.$comments;
        if(!$mail->send()){
            echo "Message not sent";
        }
        else{
           echo "Thankyou,we will get in touch with you soon!";
        }
    }
?>