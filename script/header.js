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
  const hours = String(d.getHours()).padStart(2, "0");
  const minutes = String(d.getMinutes()).padStart(2, "0");
  const seconds = String(d.getSeconds()).padStart(2, "0");

  return `${weekday}, ${day} ${month} ${hours}:${minutes}`;
}

const datetime = document.getElementById("datetime");
const datetimeText = datetime.textContent;
const date = datetimeText;
const formatedDate = formatDate(date);

datetime.textContent = `Дата и время: ${formatedDate}`;
