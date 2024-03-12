<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    <style>
    *{
        text-decoration: none;
    }
    body{
      background: rgba(54, 162, 235, 0.2);
    }
    .menuBar {
        width: 100vw;
        height: 40px;
        padding-top: 15px;
        padding-bottom: 15px;
        background: rgba(54, 162, 235, 1);
      }
      .navdiv{
      display: flex; align-items: center; justify-content: space-between;
      }
      .logo a{
        font-size: 35px; font-weight: 600; color: white; margin-left: 20px;
      }
      li{
        list-style: none; display: inline-block;
      }
      li a{
        color: white; font-size: 18px; font-weight: bold; margin-right: 25px;
      }
      button{
        background-color: black; margin-left: 10px; margin-right: 10px; border-radius: 10px; padding: 10px; width: 90px;
      }
      button a{
        color: white; font-weight: bold; font-size: 15px;
      }
    .header{
      background: rgba(54, 162, 235, 1);
    }
    .btn{
      background: rgba(54, 162, 235, 1);
    }
  </style>
</head>
<body>
<div class="menuBar">
    <div class="navdiv">
        <div class="logo"><a href="#">RiP</a> </div>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
            <button><a href="chart.php">Summary</a></button>
            <button><a href="rip.php">SignOut</a></button>
          </ul>
    </div>
</div>

<div class="header">
    <h2>Entry</h2>
</div>
<form id="expenseForm" method="post" action="index.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
      <label for="transaction_type">Transaction Type:</label>
            <select name="transaction_type" id="transaction_type">
                <option value="">Select</option>
                <option value="Income">Income</option>
                <option value="Expenses">Expenses</option>
            </select>
    </div>
    <div class="input-group">
        <label for="category">Category:</label>
            <select name="category" id="category">
                <option value="">Select</option>
                <option value="Salary">Salary</option>
                <option value="Rent & bills">Rent & bills</option>
                <option value="Sport">Sport</option>
                <option value="Travel">Travel</option>
                <option value="Personal care">Personal care</option>
                <option value="Groceries">Groceries</option>
                <option value="Entertainment">Entertainment</option>
                <option value="Gift">Gift</option>
                <option value="Food">Food</option>
            </select>
    </div>
    <div class="input-group">
        <label for="date">Date:</label>
            <input type="date" name="date" id="date" value="<?php echo $date; ?>" required>
    </div>
    <div class="input-group">
        <label for="amount">Amount:</label>
            <input type="number" name="amount" id="amount" value="<?php echo $amount; ?>"required>
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="submit_input">Submit</button>
    </div>
</form>
</body>
</html>