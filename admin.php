<?php
$uname="mouni";
$psw="mounika1234";
session_start();

if(isset($_SESSION['uname'])){
    ?>
    <html>
    <head>
        <link rel="stylesheet" href="admin1.css">
    </head>
    <body>
    <div id="welcome">
    <h2>welcome kaira</h2>
    <a href='logout.php'><input class="cursor" type=button value=logout name=logout></a>
    <a href='bill.html' target="_blank"><input class="cursor" type=button value=bill name=bill></a>
    </div>
    <div class='adminbill'>
    <h2 id="bookhead">Bill Transactions</h2>
    <div id="bookdiv">
    <form>
    <p id="pbook1">click to get all bill transactions:</p>
    <a href='allbill.php' target="_blank"><input class="cursor" type=button value=getall name=getall></a>
    </form>
    <form action="datebill.php" autocomplete="off" method="post" target="_blank">
    <p id="pbook1">Get all bill transactions by date:</p>
    <input type="date" name=date required>
    <input type="submit" class="cursor" value="get" class='datebook'>
    </form>
    <form action="phonebill.php" autocomplete="off" method="post" target="_blank">
    <p id="pbook1">Bill details by phonenumber:</p>
    <input  type="tel" pattern="^\d{10}$" name="phone" required>
    <input  type="submit" class="cursor" value="get" class='datebook'>
    </form>
    <form action="rcnobill.php" autocomplete="off" method="post" target="_blank">
    <p id="pbook1">Bill details by reciept no:</p>
    <input  type="text" name="rcno" required>
    <input  type="submit" class="cursor" value="get" class='datebook'>
    </form>
    <form>
    <p id="pbook1">click to get all customer details :</p>
    <a href='allcustomers.php' target="_blank"><input class="cursor" type=button value=getall name=getall></a></form>
    </div>
    </div>
    <div class='adminbook'>
    <h2 id="bookhead">Bookings</h2>
    <div id="bookdiv">
    <form>
    <p id="pbook1">click to get all appointments :</p>
    <a href='allbookings.php' target="_blank"><input class="cursor" type=button value=getall name=getall></a></form>
    <form action="servicedate.php" autocomplete="off" method="post" target="_blank">
    <p id="pbook1">Get appointments by service date:</p>
    <input type="date" name=servicedate required>
    <input type="submit" class="cursor" value="get" class='datebook'>
    </form>
    <form action="bookingdate.php" autocomplete="off" method="post" target="_blank">
    <p id="pbook1">Get appointments by Booking date:</p>
    <input type="date" name=bookingdate required>
    <input type="submit" class="cursor" value="get" class='datebook'>
    </form>
    <form action="phonebookings.php" autocomplete="off" method="post" target="_blank">
    <p id="pbook1">Appointment details by phonenumber:</p>
    <input  type="tel" pattern="^\d{10}$" name="phone" required>
    <input  type="submit" class="cursor" value="get" class='datebook'>
    </form>
    </div>
    </div>
    <div class='admincontact'>
    <h2 id="bookhead">Contact Requests</h2>
    <div id="bookdiv">
    <form>
    <p id="pbook1">click to get all contact requests:</p>
    <a href='allcontact.php' target="_blank"><input class="cursor" type=button value=getall name=getall></a></form>
    <form action="datecontact.php" autocomplete="off" method="post" target="_blank">
    <p id="pbook1">Get contact requests by date:</p>
    <input type="date" name=date required>
    <input type="submit" class="cursor" value="get" class='datebook'>
    </form>
    </div>
    </div>
    </body>
    </html>
<?php
}
else{
    if($_POST['uname']==$uname && $_POST['psw']==$psw){
        $_SESSION['uname']=$uname;
        echo "<script>location.href='admin.php'</script>";
    }
    else{
        echo "<script>alert('username or password incorrect');</script>";
        echo "<script>location.href='index.html'</script>";
    }
}
?>