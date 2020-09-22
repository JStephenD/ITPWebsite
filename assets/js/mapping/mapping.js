if (typeof mymap == "undefined") {
  $('#city_or_mun_select').select2();
  $('#brgy_select').select2();

  let city_or_mun_select = document.querySelector('#city_or_mun_select');
  let brgy_select = document.querySelector('#brgy_select');

  let formdata = new FormData();
  formdata.append('getLocation', 'getLocation');

  fetch('/ajaj/getIpLocation.php')
    .then(res => {
      if (res.ok) {
        return res.json();
      }
    })
    .then(json => {
      [urhere_latitude, urhere_longitude] = json;

      let mymap = L.map("covidTraceMap").setView(
        [urhere_latitude, urhere_longitude],
        10
      );

      let tileUrl = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png";
      let attribution =
        '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap Contributors</a>';
      let tiles = L.tileLayer(tileUrl, {
        attribution,
      });
      tiles.addTo(mymap);
      let urhere_icon = L.icon({
        iconUrl: "/assets/images/map-pin.png",
        iconSize: [25, 35],
        iconAnhor: [12.5, 35],
      });
      let urhere_marker = L.marker([urhere_latitude, urhere_longitude], {
        icon: urhere_icon,
      })
        .bindPopup("Your IP Address Tells Me You're From Here")
        .setOpacity(0.7)
        .addTo(mymap);

      let cm_markers = [];
      let brg_markers = [];

      let show_brg_markers = true;
      let show_cm_markers = true;
      let show_urhere_marker = true;

      let cmlocs = [];
      let blocs = [];

      getCMLocs().then((res) => {
        res.forEach((row) => {
          cmlocs.push(row);

          let marker = L.marker([row["latitude"], row["longitude"]])
            .bindPopup(`${row["cmclass"]}: ${row["cmdesc"]}`)
            .setOpacity(0.7);
          cm_markers.push(marker);
        });
        addMarkersToMap(cm_markers, mymap);
      });

      getBLocs().then((res) => {
        res.forEach((row) => {
          cmlocs.forEach((cm) => {
            if (cm["id"] == row["idcm"]) {
              row["cmdesc"] = cm["cmdesc"];
            }
          });

          blocs.push(row);

          let marker = L.marker([row["latitude"], row["longitude"]])
            .bindPopup(`${row["cmdesc"]}: ${row["bname"]}`)
            .setOpacity(0.7);
          brg_markers.push(marker);
        });
        addMarkersToMap(brg_markers, mymap);
      });

      mymap.on("zoomend", (ev) => {
        let zoomlevel = mymap.getZoom();
        // console.log(zoomlevel)
        if (zoomlevel < 10) {
          removeMarkersFromMap(brg_markers, mymap);
          show_brg_markers = false;
          brgs_checkbox.checked = show_brg_markers;
        } else {
          addMarkersToMap(brg_markers, mymap);
          show_brg_markers = true;
          brgs_checkbox.checked = show_brg_markers;
        }
      });

      let cms_checkbox = document.querySelector("#cms");
      let brgs_checkbox = document.querySelector("#brgs");
      let urhere_checkbox = document.querySelector("#urhere");
      cms_checkbox.addEventListener("click", (ev) => {
        if (show_cm_markers) {
          removeMarkersFromMap(cm_markers, mymap);
        } else {
          addMarkersToMap(cm_markers, mymap);
        }
        show_cm_markers = !show_cm_markers;
      });
      brgs_checkbox.addEventListener("click", (ev) => {
        if (show_brg_markers) {
          removeMarkersFromMap(brg_markers, mymap);
        } else {
          addMarkersToMap(brg_markers, mymap);
        }
        show_brg_markers = !show_brg_markers;
      });
      urhere_checkbox.addEventListener("click", (ev) => {
        if (show_urhere_marker) {
          mymap.removeLayer(urhere_marker);
        } else {
          urhere_marker.addTo(mymap);
        }
        show_urhere_marker = !show_urhere_marker;
      });
    })
}
