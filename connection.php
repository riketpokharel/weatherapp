<?php
  // connection to database
$conn = mysqli_connect("sql209.epizy.com","epiz_34251376","jVctmNGM4pz8","epiz_34251376_heralddb");

// get weather data from API
$data = file_get_contents("https://api.openweathermap.org/data/2.5/weather?units=metric&q=warwick&appid=1eb14fa2fbe4143f836955bdfbb0e570");
$json_data = json_decode($data, true);

// extract data from JSON response
$city = $json_data['name'];
$temp = $json_data['main']['temp'];
$humidity = $json_data['main']['humidity'];
$pressure = $json_data['main']['pressure'];
$wind_speed = $json_data['wind']['speed'];

// get today's date in YYYY-MM-DD format
$today = date('Y-m-d');

// check if there is already data for today in the database
$query = "SELECT * FROM weather WHERE dat LIKE '%$today%'";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) == 0) {
  // insert new data if there is no data for today in the database
  $sql = "INSERT INTO weather(city, temperature, humidity, pressure, wind_speed, dat) VALUES ('$city', '$temp', '$humidity', '$pressure', '$wind_speed', NOW())";
  mysqli_query($conn, $sql);
}

?>
