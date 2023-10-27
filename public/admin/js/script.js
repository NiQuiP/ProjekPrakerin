// Tanggal
let dateToday = document.getElementById("date-today");

let today = new Date();
let day = `${today.getDate() < 10 ? "0" : ""}${today.getDate()}`;

let month = `${today.getMonth() + 1 < 10 ? "0" : ""}${today.getMonth() + 1}`;
let year = today.getFullYear();

dateToday.textContent = `${day} / ${month} / ${year}`;

// Waktu
let time = document.getElementById("current-time");

setInterval(() => {
  let d = new Date();
  time.innerHTML = d.toLocaleTimeString();
}, 1000);

// open cam
let but = document.getElementById("but");
let video = document.getElementById("vid");
let canvas = document.querySelector("canvas");
let screenshot = document.querySelector("img.screenshot");
let mediaDevices = navigator.mediaDevices;

navigator.mediaDevices.getUserMedia({video: true}).then((stream) => {
  video.srcObject = stream;
  video.play();
});

but.addEventListener("click", function () {
  canvas.getContext("2d").drawImage(video, 0, 0, canvas.width, canvas.height);
  screenshot.src = canvas.toDataURL("img");
  // video.remove();
});

// maps

const getLocationButton = document.getElementById("getLocation");
const latitudeInput = document.getElementById("latitude");
const longitudeInput = document.getElementById("longitude");

if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(function (position) {
    const latitude = position.coords.latitude;
    const longitude = position.coords.longitude;
    const accuracy = position.coords.accuracy;

    // Memasukkan nilai latitude dan longitude ke dalam input
    latitudeInput.value = latitude;
    longitudeInput.value = longitude;
    var map = L.map("map").setView([latitude, longitude], 130);
    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
      maxZoom: 18,
    }).addTo(map);
    var marker = L.marker([latitude, longitude]).addTo(map);
    var circle = L.circle([latitude, longitude], {radius: accuracy}).addTo(map);
  });
}

// select
// document.getElementById("select").selectedIndex = 0;

const menu = document.querySelector(".wrapper-icon i");
const nav = document.querySelector("nav");

menu.addEventListener("click", () => {
  nav.classList.toggle("close");
});

// dropdown
const img = document.querySelector(".user-profile img");
const dropdown = document.querySelector("header.first .dropdownMenu");

img.addEventListener("click", () => {
  dropdown.classList.toggle("active");
});
