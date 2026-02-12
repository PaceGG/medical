const button = document.getElementById("find-clinic");
const map = document.getElementById("map");

function distance(lat1, lon1, lat2, lon2) {
  const R = 6371;
  const dLat = ((lat2 - lat1) * Math.PI) / 180;
  const dLon = ((lon2 - lon1) * Math.PI) / 180;
  const a =
    Math.sin(dLat / 2) ** 2 +
    Math.cos((lat1 * Math.PI) / 180) *
      Math.cos((lat2 * Math.PI) / 180) *
      Math.sin(dLon / 2) ** 2;
  return 2 * R * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
}

button.addEventListener("click", async () => {
  if (!navigator.geolocation) {
    map.textContent = "Геолокация не поддерживается";
    return;
  }

  const response = await fetch("include/get_clinics.php");
  const clinics = await response.json();

  navigator.geolocation.getCurrentPosition((pos) => {
    const userLat = pos.coords.latitude;
    const userLng = pos.coords.longitude;

    // showMap(userLat, userLng);
    // return;

    let nearest = clinics[0];
    let minDist = distance(userLat, userLng, nearest.lat, nearest.lon);

    clinics.forEach((c) => {
      const d = distance(userLat, userLng, c.lat, c.lon);
      if (d < minDist) {
        minDist = d;
        nearest = c;
      }
    });

    showMap(nearest.lat, nearest.lon);
  });
});

function showMap(lat, lon) {
  map.innerHTML = `
    <iframe
      width="100%"
      height="500"
      style="border:0"
      src="https://www.google.com/maps?q=${lat},${lon}&z=15&output=embed">
    </iframe>
  `;
}

document.querySelectorAll(".clinic-card").forEach((card) => {
  card.addEventListener("click", () => {
    const lat = card.dataset.lat;
    const lon = card.dataset.lon;

    if (!lat || !lon) {
      alert("Координаты клиники не указаны");
      return;
    }

    showMap(lat, lon);
  });
});
