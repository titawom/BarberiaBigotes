<html>
<meta http-equiv="Content-Type"'.' content="text/html; charset=utf8"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style.css">
<style>
	.titulo {
		display: flex;
    	align-items: baseline;
	}
</style>
<body>
<?php
require ('connectDB.php');

session_start();
	if(isset($_POST['ac'])){
		
		$conn = new mysqli($servername, $username, $password);

		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "USE BookStore";
		$conn->query($sql);

		$sql = "SELECT * FROM Book WHERE BookID = '".$_POST['ac']."'";
		$result = $conn->query($sql);

		while($row = $result->fetch_assoc()){
			$bookID = $row['BookID'];
			$quantity = $_POST['quantity'];
			$price = $row['Price'];
		}

		$sql = "INSERT INTO Cart(BookID, Quantity, Price, TotalPrice) VALUES('".$bookID."', ".$quantity.", ".$price.", Price * Quantity)";
		$conn->query($sql);
	}

	if(isset($_POST['delc'])){

		$conn = new mysqli($servername, $username, $password);

		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "USE BookStore";
		$conn->query($sql);

		$sql = "DELETE FROM Cart";
		$conn->query($sql);
	}

	$conn = new mysqli($servername, $username, $password);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "USE BookStore";
	$conn->query($sql);	

	$sql = "SELECT * FROM Book";
	$result = $conn->query($sql);
?>	

<?php
if(isset($_SESSION['id'])){
	echo '<header>';
	echo '<blockquote>';
	echo '<div class="titulo">';
	echo '<a href="index.php"><img class="logo" src="image/logo.png"></a>';
	echo '<form class="hf" action="clientes.php"><input class="hi" type="submit" name="submitButton" value="Clientes"></form>';
	echo '<form class="hf" action="http://3.230.34.142:8069/web/login"><input class="hi" type="submit" name="submitButton" value="Administración"></form>';
	echo '<form class="hf" action="edituser.php"><input class="hi" type="submit" name="submitButton" value="Edit Profile"></form>';
	echo '<form class="hf" action="logout.php"><input class="hi" type="submit" name="submitButton" value="Logout"></form>';
	echo '</div>';
	echo '</blockquote>';
	echo '</header>';
}

if(!isset($_SESSION['id'])){
	echo '<header>';
	echo '<blockquote>';
	echo '<div class="titulo">';
	echo '<a href="index.php"><img class="logo" src="image/logo.png"></a>';
	echo '<form class="hf" action="dates.php"><input class="hi" type="submit" name="submitButton" value="Pedir Cita"></form>';
	echo '<form class="hf" action="iot.php"><input class="hi" type="submit" name="submitButton" value="Iot"></form>';
	echo '<form class="hf" action="login.php"><input class="hi" type="submit" name="submitButton" value="Login"></form>';
	echo '<form class="hf" action="register.php"><input class="hi" type="submit" name="submitButton" value="Register"></form>';
	echo '</div>';
	echo '</blockquote>';
	echo '</header>';
}
echo '<blockquote>';
	echo "<table id='myTable' style='width:80%; float:left'>";
	echo "<tr>";
    while($row = $result->fetch_assoc()) {
	    echo "<td>";
	    echo "<table>";
	   	echo '<tr><td>'.'<img src="'.$row["Image"].'"width="80%">'.'</td></tr><tr><td style="padding: 5px;">Título: '.$row["BookTitle"].'</td></tr><tr><td style="padding: 5px;">Tipo: '.$row["Type"].'</td></tr><tr><td style="padding: 5px;">'.$row["Price"].' €</td></tr><tr><td style="padding: 5px;">
	   	<form action="" method="post">
	   	Quantity: <input type="number" value="1" name="quantity" style="width: 20%"/><br>
	   	<input type="hidden" value="'.$row['BookID'].'" name="ac"/>
	   	<input class="button" type="submit" value="Add to Cart"/>
	   	</form></td></tr>';
	   	echo "</table>";
	   	echo "</td>";
    }
    echo "</tr>";
    echo "</table>";

	$sql = "SELECT Book.BookTitle, Book.Image, Cart.Price, Cart.Quantity, Cart.TotalPrice FROM Book,Cart WHERE Book.BookID = Cart.BookID;";
	$result = $conn->query($sql);

    echo "<table style='width:20%; float:right;'>";
    echo "<th style='text-align:left;'><i class='fa fa-shopping-cart' style='font-size:24px'></i> Cart <form style='float:right;' action='' method='post'><input type='hidden' name='delc'/><input class='cbtn' type='submit' value='Empty Cart'></form></th>";
    $total = 0;
    while($row = $result->fetch_assoc()){
    	echo "<tr><td>";
    	echo '<img src="'.$row["Image"].'"width="20%"><br>';
    	echo $row['BookTitle']."<br>".$row['Price']." €<br>";
    	echo "Quantity: ".$row['Quantity']."<br>";
    	echo "Total Price: ".$row['TotalPrice']." €</td></tr>";
    	$total += $row['TotalPrice'];
    }
    echo "<tr><td style='text-align: right;background-color: #f2f2f2;''>";
    echo "Total: <b>".$total." €</b><center><form action='checkout.php' method='post'><input class='button' type='submit' name='checkout' value='CHECKOUT'></form></center>";
    echo "</td></tr>";
	echo "</table>";
	echo '</blockquote>';
?>
</body>
</html>