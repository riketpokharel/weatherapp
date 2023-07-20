  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <!-- Font awesome CSS -->
      <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
      />
      <!-- Title and css file -->
      <title>Document</title>
      <link rel="stylesheet" href="weather.css" />
    </head>
    <body>
      <!-- Start of body section -->
      <section class="container">
        <div class="second">
          <h1>Weather App</h1>
          <h4 id="showDate"></h4>

          <!-- Form start -->
          <form action="" id="form">
            <input
              type="text"
              id="citys"
              name="city"
              placeholder="Search city"
            /><button id="fetchBtn">
              <i class="fa fa-search" id="fetchBtn"></i>
            </button>
          </form>
          <!-- Form end -->

          <br />
          <img id="icon" />
          <h2 id="temp">20°C</h2>
          <p id="text">clear</p>
          <h3 id="cname"><i class="fa fa-map-marker"></i>Warwick</h3>
          <hr />
          <div class="row">
            <div class="one">
              <img src="images/image4.png" alt="" />
              <p id="humidity">66%</p>
              <p>Humidity</p>
            </div>
            <div class="one">
              <img src="images/image5.png" alt="" />
              <p id="wind">66%</p>

              <p>Wind Speed</p>
            </div>
            <div class="one">
              <img src="images/image6.png" alt="" />
              <p id="air">66%</p>

              <p>Air Pressure</p>
            </div>
          </div>
        </div>

        <div class="third">
          <!-- Weather table -->
          <table border="2" class="styled-table">
            <tr>
            <th>city</th>
            <th>temperature</th>
            <th>humidity</th>
            <th>pressure</th>
            <th>wind_speed</th>
            <th>date</th>
            <tr>
          
        </div>
      </section>

      <!-- End of body section -->

      <!-- PHP code -->
      <?php
  include("connection.php");

  $query = "SELECT * FROM weather WHERE dat BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW() GROUP BY DATE(dat)";
  $data = mysqli_query($conn, $query);
  $total = mysqli_num_rows($data);
  
  if ($total != 0) {
      while ($result = mysqli_fetch_assoc($data)) {
          echo "
              <tr>
                  <td>".$result['city']."</td>
                  <td>".$result['temperature']."</td>
                  <td>".$result['humidity']."</td>
                  <td>".$result['pressure']."</td>
                  <td>".$result['wind_speed']."</td> 
                  <td>".$result['dat']."</td> 
              </tr>
          ";
      }
  } else {
      echo "no records found";
  }
  
?>
<!-- End of php code -->


      <script src="weather.js"></script>
  </table>
  <!-- End of weather table -->
    </body>
  </html>
