const markerN = 50.451373695537086
const markerE = 30.468277280288355
const mapOffset = 0.002398 // смещение для UA версии
const mapViewN = markerN + mapOffset
const mapViewE = markerE
const mapViewZoom = 14
const locationDescription = '<b>Neoweb</b><br>Україна, Київ<br>просп. Берестейський 26<br>(район КПІ, ст. метро Політехнічний інститут)<br><a href="https://neoweb.kyiv.ua" title="Створення сайтів, створення Інтернет магазинів">neoweb.kyiv.ua</a>'

const map = L.map('map').setView([mapViewN, mapViewE], mapViewZoom);

const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

const marker = L.marker([markerN, markerE]).addTo(map)
    .bindPopup(locationDescription).openPopup();

// function onMapClick(e) {
// 	popup
// 		.setLatLng(e.latlng)
// 		.setContent(`Вы нажали на карту в таких координатах: ${e.latlng.toString()}`)
// 		.openOn(map);
// }
// function onMapClick(e) {
//     popup
//         .setLatLng(e.latlng)
//         .setContent("You clicked the map at " + e.latlng.toString())
//         .openOn(map);
// }

// map.on('click', onMapClick);