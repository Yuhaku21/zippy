document.getElementById("layananSelect").addEventListener("change", function () {
  var selectedOption = this.value;
  if (selectedOption === "ojek") {
    window.location.href = "ojek-online.html";
  } else if (selectedOption === "food") {
    window.location.href = "food-delivery.html";
  } else if (selectedOption === "kurir") {
    window.location.href = "kurir.html";
  }
  // Add more conditions for other options if needed
});
