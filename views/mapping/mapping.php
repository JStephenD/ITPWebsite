<div class="mapping-main">
    <div id="covidTraceMap"></div>
    <div class="mapping-options">
        <div class="option">
            <input type="checkbox" name="cms" id="cms" checked>
            <label for="cms">Toggle City/Municipalities Label</label>
        </div>
        <div class="option">
            <input type="checkbox" name="brgs" id="brgs" checked>
            <label for="brgs">Toggle Barangay Labels</label>
        </div>
        <div class="option">
            <input type="checkbox" name="urhere" id="urhere" checked>
            <label for="urhere">Toggle Ip Location Label</label>
        </div>
    </div>
</div>

<script>
    window.addEventListener('load', () => {
        let urhere_latitude = <?= $loc[0]; ?>;
        let urhere_longitude = <?= $loc[1]; ?>;
        let mymap = L.map('covidTraceMap').setView([urhere_latitude, urhere_longitude], 10);
        // let mymap = L.map('covidTraceMap', {
        //     center = [urhere_latitude, urhere_longitude],
        //     zoom: 13
        // });

        let tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
        let attribution = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap Contributors</a>';
        let tiles = L.tileLayer(tileUrl, {
            attribution
        });
        tiles.addTo(mymap);
        let urhere_icon = L.icon({
            iconUrl: '/assets/images/map-pin.png',
            iconSize: [25, 35],
            iconAnhor: [12.5, 35],
        });
        let urhere_marker = L.marker([urhere_latitude, urhere_longitude], {
                icon: urhere_icon
            })
            .bindPopup('Your IP Address Tells Me You\'re From Here')
            .setOpacity(0.7)
            .addTo(mymap);

        let cm_markers = [];
        let brg_markers = [];

        let show_brg_markers = true;
        let show_cm_markers = true;
        let show_urhere_marker = true;

        let cmlocs = [];
        let blocs = [];

        getCMLocs().then(res => {
            res.forEach(row => {
                cmlocs.push(row);

                let marker = L.marker([row['latitude'], row['longitude']])
                    .bindPopup(`${row['cmclass']}: ${row['cmdesc']}`)
                    .setOpacity(0.7)
                cm_markers.push(marker);
            });
            addMarkersToMap(mymap, cm_markers);
        });

        getBLocs().then((res) => {
            res.forEach((row) => {
                cmlocs.forEach(cm => {
                    if (cm['id'] == row['idcm']) {
                        row['cmdesc'] = cm['cmdesc'];
                    }
                });

                blocs.push(row);

                let marker = L.marker([row['latitude'], row['longitude']])
                    .bindPopup(`${row['cmdesc']}: ${row['bname']}`)
                    .setOpacity(0.7)
                brg_markers.push(marker);
            });
            addMarkersToMap(mymap, brg_markers);
        });

        mymap.on('zoomend', (ev) => {
            let zoomlevel = mymap.getZoom();
            // console.log(zoomlevel)
            if (zoomlevel < 10) {
                removeMarkersFromMap(mymap, brg_markers);
                show_brg_markers = false;
                brgs_checkbox.checked = show_brg_markers;
            } else {
                addMarkersToMap(mymap, brg_markers);
                show_brg_markers = true
                brgs_checkbox.checked = show_brg_markers;
            }
        });

        let cms_checkbox = document.querySelector('#cms');
        let brgs_checkbox = document.querySelector('#brgs');
        let urhere_checkbox = document.querySelector('#urhere');
        cms_checkbox.addEventListener('click', (ev) => {
            if (show_cm_markers) {
                removeMarkersFromMap(mymap, cm_markers);
            } else {
                addMarkersToMap(mymap, cm_markers);
            }
            show_cm_markers = !show_cm_markers;
        });
        brgs_checkbox.addEventListener('click', (ev) => {
            if (show_brg_markers) {
                removeMarkersFromMap(mymap, brg_markers);
            } else {
                addMarkersToMap(mymap, brg_markers);
            }
            show_brg_markers = !show_brg_markers;
        });
        urhere_checkbox.addEventListener('click', (ev) => {
            if (show_urhere_marker) {
                mymap.removeLayer(urhere_marker);
            } else {
                urhere_marker.addTo(mymap); 
            }
            show_urhere_marker = !show_urhere_marker;
        });
    });
</script>