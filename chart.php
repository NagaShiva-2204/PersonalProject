<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>Document</title>
  <style>
      * {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
        text-decoration: none;
      }
      .chartMenu {
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
        font-size: 35px; font-weight: 600; color: white; margin-left: 10px;
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
      .chartCard {
        width: 100vw;
        height: calc(auto - 40px);
        background: rgba(54, 162, 235, 0.2);
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        
      }
      .chartBox {
        width: 700px;
        height: 300px;
        padding: 20px;
        border-radius: 20px;
        border: solid 3px rgba(54, 162, 235, 1);
        background: white;
        flex: 0 0 calc(93.5% - 10px);
        margin-top: 15px;
        margin-left: 10px; 
        margin-right: 10px;
        margin-bottom: 10px;
      }
      .sumBox {
        width: 700px;
        height: 100px;
        padding: 20px;
        border-radius: 20px;
        border: solid 3px rgba(54, 162, 235, 1);
        background: white;
        flex: 0 0 calc(28.5% - 10px);
        margin-top: 15px;
        margin-left: 10px; 
        margin-right: 10px;
      }
      .cashIn img{
        max-width: 25%;
        height: auto;
      }
      .cashIn h3{
        color: rgba(54, 162, 235, 1);
        font-size: 40px;
        text-align: center;
        margin-top: -70px;
        margin-left: 40px;
      }
      .cashIn p{
        margin-top: 20px;
        margin-left: 15px;
      }
      .cashOut img{
        max-width: 25%;
        height: auto;
      }
      .cashOut h3{
        color: rgba(54, 162, 235, 1);
        font-size: 40px;
        text-align: center;
        margin-top: -75px;
        margin-left: 40px;
      }
      .cashOut p{
        margin-top: 20px;
        margin-left: -10px;
      }
      .saveIn h3{
        color: rgba(54, 162, 235, 1);
        font-size: 40px;
        text-align: center;
        margin-top: -65px;
        margin-left: 40px;
      }
      .saveIn img{
        max-width: 17.5%;
        height: auto;
        margin-left: 20px;
      }
      .saveIn p{
        margin-top: 20px;
        margin-left: 0px;
      }
      
    </style>
</head>
<body>
<?php  
$con = new mysqli('localhost','root','','project');
if(isset($_SESSION['username'])) {
    // Retrieve the specific_username from the form submission
    $specific_username = $_SESSION['username'];
  $query = $con->query("
                  SELECT 
                      t.date,
                      t.total_income,
                      t.total_expenses,
                      SUM(t.net_cash) OVER (ORDER BY t.date) AS running_cash
                  FROM (
                      SELECT 
                          date,
                          SUM(CASE WHEN transaction_type = 'Income' THEN amount ELSE -amount END) AS net_cash,
                          SUM(CASE WHEN transaction_type = 'Income' THEN amount ELSE 0 END) AS total_income,
                          SUM(CASE WHEN transaction_type = 'Expenses' THEN amount ELSE 0 END) AS total_expenses
                      FROM 
                          inputs
                      WHERE
                        username = '$specific_username'
                      GROUP BY 
                          date
                  ) t
                  ORDER BY 
                      t.date;
  ");

  foreach($query as $data)
  {
    $date[] = $data['date'];
    $running_cash[] = $data['running_cash'];
  }

  $query2 = $con->query("
                      SELECT 
                          date,
                          SUM(CASE WHEN transaction_type = 'Expenses' THEN amount ELSE 0 END) AS    expenses
                      FROM 
                          inputs
                      WHERE
                        username = '$specific_username'
                      GROUP BY 
                          date
                      ORDER BY 
                          date;
  ");

  foreach($query2 as $data2)
  {
    $date2[] = $data2['date'];
    $expenses[] = $data2['expenses'];
  }

  $query3 = $con->query("
                        SELECT 
                        date,
                        category,
                        SUM(CASE WHEN transaction_type = 'Expenses' AND category = 'Rent & bills' THEN amount ELSE 0 END) AS rent_expenses,
                        SUM(CASE WHEN transaction_type = 'Expenses' AND category = 'Sport' THEN amount ELSE 0 END) AS sport_expenses,
                        SUM(CASE WHEN transaction_type = 'Expenses' AND category = 'Travel' THEN amount ELSE 0 END) AS travel_expenses,
                        SUM(CASE WHEN transaction_type = 'Expenses' AND category = 'Personal care' THEN amount ELSE 0 END) AS personal_expenses,
                        SUM(CASE WHEN transaction_type = 'Expenses' AND category = 'Groceries' THEN amount ELSE 0 END) AS groceries_expenses,
                        SUM(CASE WHEN transaction_type = 'Expenses' AND category = 'Entertainment' THEN amount ELSE 0 END) AS entertainment_expenses,
                        SUM(CASE WHEN transaction_type = 'Expenses' AND category = 'Gift' THEN amount ELSE 0 END) AS gift_expenses,
                        SUM(CASE WHEN transaction_type = 'Expenses' AND category = 'Food' THEN amount ELSE 0 END) AS food_expenses
                        FROM 
                            inputs
                        WHERE
                          username = '$specific_username'
                        GROUP BY 
                            date
                        ORDER BY 
                            date;
  ");

  foreach($query3 as $data3)
  {
    $date3[] = $data3['date'];
    $rent_expenses[] = $data3['rent_expenses'];
    $sport_expenses[] = $data3['sport_expenses'];
    $travel_expenses[] = $data3['travel_expenses'];
    $personal_expenses[] = $data3['personal_expenses'];
    $groceries_expenses[] = $data3['groceries_expenses'];
    $entertainment_expenses[] = $data3['entertainment_expenses'];
    $gift_expenses[] = $data3['gift_expenses'];
    $food_expenses[] = $data3['food_expenses'];
  }

  $query4 = $con->query("
                      SELECT 
                      DATE_FORMAT(date, '%Y-%m') AS month,
                      SUM(CASE WHEN transaction_type = 'Expenses' THEN amount ELSE 0 END) AS total_expenses
                      FROM 
                          inputs
                      WHERE
                          username = '$specific_username'
                      GROUP BY 
                          DATE_FORMAT(date, '%Y-%m')
                      ORDER BY 
                          month;
  ");

  foreach($query4 as $data4)
  {
    $total_expenses[] = $data4['total_expenses'];
  }

  $query5 = $con->query("
                      SELECT 
                      DATE_FORMAT(date, '%Y-%m') AS month,
                      SUM(CASE WHEN transaction_type = 'Income' THEN amount ELSE 0 END) AS total_income,
                      SUM(CASE WHEN transaction_type = 'Expenses' THEN amount ELSE 0 END) AS total_expenses,
                      (SUM(CASE WHEN transaction_type = 'Income' THEN amount ELSE 0 END) - SUM(CASE WHEN transaction_type = 'Expenses' THEN amount ELSE 0 END)) AS monthly_savings
                      FROM 
                          inputs
                      WHERE
                          username = '$specific_username'
                      GROUP BY 
                          DATE_FORMAT(date, '%Y-%m')
                      ORDER BY 
                          month;
  ");

  foreach($query5 as $data5)
  {
    $monthly_savings[] = $data5['monthly_savings'];
  }
}
?>

<div class="chartMenu">
      <div class="navdiv">
        <div class="logo"><a href="#">User Financial Summary</a> </div>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
            <button><a href="index.php">Entry</a></button>
            <button><a href="rip.php">SignOut</a></button>
          </ul>
      </div>
</div>

<div class="chartCard">
  <div class="sumBox">
    <div class="cashIn">
    <img src="cash_in_hand.jpg" alt="cash in hand">
    <?php  
    $last_running_cash = number_format(end($running_cash));
    echo "<h3>Rs. $last_running_cash</h3>";
    ?>
    <p>Net Worth</p>
    </div>
  </div>
  <div class="sumBox">
    <div class="cashOut">
    <img src="expenses.jpg" alt="Monthly expenses">
    <?php  
    $last_total_expenses = number_format(end($total_expenses));
    echo "<h3>Rs. $last_total_expenses</h3>";
    ?>
    <p>Monthly expenses</p>
    </div>
  </div>
  <div class="sumBox">
    <div class="saveIn">
        <img src="savings.jpg" alt="Monthly savings">
        <?php  
        $last_monthly_savings = number_format(end($monthly_savings));
        echo "<h3>Rs. $last_monthly_savings</h3>";
        ?>
        <p>Monthly savings</p>
    </div>
  </div>
  <div class="chartBox">
    <canvas id="myChart"></canvas>
  </div>

  <div class="chartBox">
    <canvas id="expensesChart"></canvas>
  </div>

  <div class="chartBox">
    <canvas id="expensesBDChart"></canvas>
  </div>
</div>

<script>
  // === include 'setup' then 'config' above ===
  const labels = <?php echo json_encode($date) ?>;
  const data = {
    labels: labels,
    datasets: [{
      label: 'Net Worth',
      data: <?php echo json_encode($running_cash) ?>,
      fill: false,
    borderColor: 'rgb(75, 192, 192)',
    tension: 0.4
    }]
  };

  const config = {
    type: 'line',
    data: data,
    options: {
      maintainAspectRatio: false,
      scales: {
        x: {
          title: {
            display: true,
            text: 'Date',
            color: 'rgba(54, 162, 235, 1)'
          }
        },
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text:'Amount (Rs)',
            color: 'rgba(54, 162, 235, 1)'
          }
        }
      }
    },
  };

  var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
  //expenses chart render
  const labels2 = <?php echo json_encode($date2) ?>;
  const data2 = {
    labels: labels2,
    datasets: [{
      label: 'Expenses',
      data: <?php echo json_encode($expenses) ?>,
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 205, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(201, 203, 207, 0.2)'
      ],
      borderColor: [
        'rgb(255, 99, 132)',
        'rgb(255, 159, 64)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(54, 162, 235)',
        'rgb(153, 102, 255)',
        'rgb(201, 203, 207)'
      ],
      borderWidth: 1
    }]
  };

  const config2 = {
    type: 'bar',
    data: data2,
    options: {
      maintainAspectRatio: false,
      scales: {
        x: {
          title: {
            display: true,
            text: 'Date',
            color: 'rgba(54, 162, 235, 1)'
          }
        },
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text:'Amount (Rs)',
            color: 'rgba(54, 162, 235, 1)'
          }
        }
      }
    },
  };

  var expensesChart = new Chart(
    document.getElementById('expensesChart'),
    config2
  );

  //expensesBD chart render
  const labels3 = <?php echo json_encode($date3) ?>;
  const data3 = {
    labels: labels3,
    datasets: [{
      label: 'Rent & bills',
      data: <?php echo json_encode($rent_expenses) ?>,
      fill: false,
    borderColor: 'rgb(255, 99, 132)',
    tension: 0.4
    },{
      label: 'Sport',
      data: <?php echo json_encode($sport_expenses) ?>,
      fill: false,
    borderColor: 'rgb(255, 159, 64)',
    tension: 0.4
    },{
      label: 'Travel',
      data: <?php echo json_encode($travel_expenses) ?>,
      fill: false,
    borderColor: 'rgb(255, 205, 86)',
    tension: 0.4
    },{
      label: 'Personal care',
      data: <?php echo json_encode($personal_expenses) ?>,
      fill: false,
    borderColor: 'rgb(75, 192, 192)',
    tension: 0.4
    },{
      label: 'Groceries',
      data: <?php echo json_encode($groceries_expenses) ?>,
      fill: false,
    borderColor: 'rgb(54, 162, 235)',
    tension: 0.4
    },{
      label: 'Entertainment',
      data: <?php echo json_encode($entertainment_expenses) ?>,
      fill: false,
    borderColor: 'rgb(153, 102, 255)',
    tension: 0.4
    },{
      label: 'Gift',
      data: <?php echo json_encode($gift_expenses) ?>,
      fill: false,
    borderColor: 'rgb(201, 203, 207)',
    tension: 0.4
    },{
      label: 'Food',
      data: <?php echo json_encode($food_expenses) ?>,
      fill: false,
    borderColor: 'rgb(255, 26, 104)',
    tension: 0.4
    }
    ]
  };

  const config3 = {
    type: 'line',
    data: data3,
    options: {
      maintainAspectRatio: false,
      scales: {
        x: {
          title: {
            display: true,
            text: 'Date',
            color: 'rgba(54, 162, 235, 1)'
          }
        },
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text:'Amount (Rs)',
            color: 'rgba(54, 162, 235, 1)'
          }
        }
      }
    },
  };

  var expensesBDChart = new Chart(
    document.getElementById('expensesBDChart'),
    config3
  );
</script>

</body>
</html>