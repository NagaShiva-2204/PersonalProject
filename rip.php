<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Personal Finance Tracker | RiP</title>
  <style>
      * {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
        text-decoration: none;
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
      .viewOne{
        width: 100vw;
        height: calc(auto - 40px);
        background: rgba(54, 162, 235, 0.2);
        display: flex;
        
      }
      .viewBox{
        width: 100vw;
        padding: 20px;
        margin: 10px;
        border-radius: 20px;
        border: solid 3px rgba(54, 162, 235, 0.2);
        background: white;
      }
      .viewBox h3{
        color: rgba(54, 162, 235, 1);
        font-size: 40px;
        text-align: left;
        margin-top: 100px;
        margin-left: 40px;
      }
      .viewBox button{
        background-color: rgba(54, 162, 235, 1); 
        margin-top: 10px;
        margin-left: 80px; 
        margin-right: 10px;
        margin-bottom: 110px; 
        border-radius: 10px; 
        padding: 10px; 
        width: 400px;
      }
      .aboutRip{
        width: auto;
        height: 400px;
        border: solid 3px rgba(54, 162, 235, 0.2);
        border-radius: 20px;
        background: rgba(54, 162, 235, 0.2);
        margin-top: 20px;
      }
      .aboutRip h4{
        text-align: center;
        margin-top: 10px;
        color: white;
        font-size: 25px;
        text-shadow: 
                -2px -2px 0 rgba(54, 162, 235, 1),
                2px -2px 0 rgba(54, 162, 235, 1),
                -2px 2px 0 rgba(54, 162, 235, 1),
                2px 2px 0 rgba(54, 162, 235, 1); 
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
            <button><a href="register.php">SignUp</a></button>
            <button><a href="login.php">SignIn</a></button>
          </ul>
      </div>
  </div>
  <div class="viewOne">
    <div class="viewBox">
      <h3><p>Our RiP will say RiP</p>
          <p>to all your financial stress</p>
      </h3>
      <button><a href="register.php">SignUp for free</a></button>
      <div class="aboutRip">
        <h4>What's breathtaking in RiP</h4>
      </div>
    </div>
  </div>
</body>
</html>