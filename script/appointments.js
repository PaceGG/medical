const specialistSelect = document.getElementById("specialist");
const dateSelect = document.getElementById("date");
const timeSelect = document.getElementById("time");

const weekdays = ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"];
const months = [
  "января",
  "февраля",
  "марта",
  "апреля",
  "мая",
  "июня",
  "июля",
  "августа",
  "сентября",
  "октября",
  "ноября",
  "декабря",
];

function formatDate(dateStr) {
  const d = new Date(dateStr);
  const weekday = weekdays[d.getDay()];
  const day = d.getDate();
  const month = months[d.getMonth()];
  return `${weekday}, ${day} ${month}`;
}

function loadAvailableDates() {
  const specialistId = specialistSelect.value;
  if (!specialistId) {
    dateSelect.innerHTML =
      '<option value="">-- сначала выберите специалиста --</option>';
    dateSelect.disabled = true;
    timeSelect.innerHTML =
      '<option value="">-- сначала выберите дату --</option>';
    timeSelect.disabled = true;
    return;
  }

  fetch(`include/get_available_dates.php?specialist_id=${specialistId}`)
    .then((res) => res.json())
    .then((data) => {
      dateSelect.innerHTML = '<option value="">-- выберите дату --</option>';
      if (!data || data.length === 0) {
        dateSelect.innerHTML = '<option value="">Нет доступных дат</option>';
        dateSelect.disabled = true;
        timeSelect.innerHTML =
          '<option value="">-- сначала выберите дату --</option>';
        timeSelect.disabled = true;
        return;
      }

      data.forEach((date) => {
        const option = document.createElement("option");
        option.value = date;
        option.textContent = formatDate(date);
        dateSelect.appendChild(option);
      });

      dateSelect.disabled = false;
      timeSelect.innerHTML =
        '<option value="">-- сначала выберите дату --</option>';
      timeSelect.disabled = true;
    })
    .catch((err) => console.error("Fetch error:", err));
}

function loadAvailableTimes() {
  const specialistId = specialistSelect.value;
  const date = dateSelect.value;
  if (!specialistId || !date) {
    timeSelect.innerHTML =
      '<option value="">-- сначала выберите дату --</option>';
    timeSelect.disabled = true;
    return;
  }

  fetch(`include/get_slots.php?specialist_id=${specialistId}&date=${date}`)
    .then((res) => res.json())
    .then((data) => {
      timeSelect.innerHTML = '<option value="">-- выберите время --</option>';
      if (!data || data.length === 0) {
        timeSelect.innerHTML = '<option value="">Нет доступных слотов</option>';
        timeSelect.disabled = true;
        return;
      }
      data.forEach((time) => {
        const option = document.createElement("option");
        option.value = time;
        option.textContent = time;
        timeSelect.appendChild(option);
      });
      timeSelect.disabled = false;
    })
    .catch((err) => console.error("Fetch error:", err));
}

specialistSelect.addEventListener("change", loadAvailableDates);
dateSelect.addEventListener("change", loadAvailableTimes);
