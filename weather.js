// Load data from local storage on page load
window.addEventListener("DOMContentLoaded", () => {
  const storedWeatherData = JSON.parse(localStorage.getItem("weatherData"));
  if (storedWeatherData) {
    populateCityOptions(storedWeatherData);
    const selectedCity = document.getElementById("citys").value;
    displayWeatherData(selectedCity, storedWeatherData);
  } else {
    // Default city data (Warwick)
    const defaultCityName = "Warwick";
    fetchData(defaultCityName);
  }
});

// Populate city options in the select dropdown
function populateCityOptions(weatherData) {
  const selectElement = document.getElementById("citys");
  for (const cityName in weatherData) {
    const option = document.createElement("option");
    option.value = cityName;
    option.textContent = cityName;
    selectElement.appendChild(option);
  }
}

// Fetch data from OpenWeatherAPI
async function fetchData(cityName) {
  const apiKey = "1eb14fa2fbe4143f836955bdfbb0e570";
  const apiUrl = `https://api.openweathermap.org/data/2.5/weather?units=metric&q=${cityName}&appid=${apiKey}`;

  try {
    const response = await fetch(apiUrl);
    const data = await response.json();

    const cityNameValue = cityName.toLowerCase();
    const cityData = {
      temperature: Math.round(data.main.temp),
      humidity: data.main.humidity,
      pressure: data.main.pressure,
      windSpeed: data.wind.speed,
      date: new Date().toLocaleDateString(),
      icon: data.weather[0].icon,
      description: data.weather[0].description, // Store weather description
    };

    // Retrieve existing weather data from local storage or create a new object
    const storedWeatherData =
      JSON.parse(localStorage.getItem("weatherData")) || {};

    // Update the city data
    storedWeatherData[cityNameValue] = cityData;

    localStorage.setItem("weatherData", JSON.stringify(storedWeatherData));

    populateCityOptions(storedWeatherData);
    displayWeatherData(cityName, storedWeatherData);
  } catch (error) {
    console.log(error);
  }
}
fetchData();
// Display weather data for a specific city
function displayWeatherData(cityName, weatherData) {
  const selectedCityData = weatherData[cityName.toLowerCase()];

  if (selectedCityData) {
    document.getElementById(
      "temp"
    ).textContent = `${selectedCityData.temperature}°C`;
    document.getElementById(
      "humidity"
    ).textContent = `${selectedCityData.humidity}%`;
    document.getElementById(
      "wind"
    ).textContent = `${selectedCityData.windSpeed} km/h`;
    document.getElementById(
      "air"
    ).textContent = `${selectedCityData.pressure} hPa`;
    document.getElementById(
      "cname"
    ).innerHTML = `<i class="fa fa-map-marker"></i> ${cityName}`;
    document.getElementById("text").innerText = selectedCityData.description;
    document
      .getElementById("icon")
      .setAttribute(
        "src",
        `https://openweathermap.org/img/wn/${selectedCityData.icon}.png`
      );
    document.getElementById("showDate").innerText = selectedCityData.date;
  }
}

const form = document.getElementById("form");
form.addEventListener("submit", (event) => {
  event.preventDefault();
  const cityName = document.getElementById("citys").value;
  const storedWeatherData = JSON.parse(localStorage.getItem("weatherData"));
  fetchData(cityName, storedWeatherData);
});
