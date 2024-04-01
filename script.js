document.addEventListener("DOMContentLoaded", function () {
  var map = L.map("mapid").setView([-8.5831, 116.116], 13); // Set initial location to Mataram, NTB, Indonesia
  var marker;
  var totalBayar = 0;

  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 19,
    attribution: 'Map data © <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
  }).addTo(map);

  function onLocationFound(e) {
    if (marker) {
      map.removeLayer(marker);
    }
    marker = L.marker(e.latlng).addTo(map);
    var latitude = e.latlng.lat.toFixed(7);
    var longitude = e.latlng.lng.toFixed(7);
    document.getElementById("titikkoordinat").textContent = "Latitude: " + latitude + ", Longitude: " + longitude;

    // Tentukan biaya berdasarkan lokasi
    var mataramBoundary = L.latLngBounds([-8.6085, 116.0264], [-8.5147, 116.1881]);
    if (mataramBoundary.contains(e.latlng)) {
      totalBayar = 5000; // Mataram
    } else {
      totalBayar = 12000; // Luar Mataram
    }
    document.getElementById("bayar").textContent = "Total Bayar: Rp " + totalBayar.toLocaleString();
    document.getElementById("totalBayar").value = totalBayar; // Update nilai totalBayar pada elemen input tersembunyi
  }

  function onLocationError(e) {
    alert(e.message);
  }

  document.getElementById("getLocationBtn").addEventListener("click", function () {
    navigator.geolocation.getCurrentPosition(
      function (position) {
        var latlng = L.latLng(position.coords.latitude, position.coords.longitude);
        map.setView(latlng, 16);
        if (marker) {
          map.removeLayer(marker);
        }
        marker = L.marker(latlng).addTo(map);
        document.getElementById("titikkoordinat").textContent = "Latitude: " + position.coords.latitude.toFixed(7) + ", Longitude: " + position.coords.longitude.toFixed(7);

        // Tentukan biaya berdasarkan lokasi
        var mataramBoundary = L.latLngBounds([-8.6085, 116.0264], [-8.5147, 116.1881]);
        if (mataramBoundary.contains(latlng)) {
          totalBayar = 5000; // Mataram
        } else {
          totalBayar = 12000; // Luar Mataram
        }
        document.getElementById("bayar").textContent = "Total Bayar: Rp " + totalBayar.toLocaleString();
        document.getElementById("totalBayar").value = totalBayar; // Update nilai totalBayar pada elemen input tersembunyi
      },
      function (error) {
        alert("Tidak dapat menemukan lokasi: " + error.message);
      },
      { enableHighAccuracy: true }
    );
  });
});
