if (typeof mymap == "undefined") {
    let city_or_mun_select = $('#city_or_mun_select');
    let citymun_select = $('#citymun_select');

    city_or_mun_select.select2();
    citymun_select.select2();

    let current_option = 'all';

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

            let cmlocs = [];

            function setCityMunOptions(ajaj_url) {
                fetch(ajaj_url)
                    .then(res => {
                        if (res.ok) {
                            return res.json();
                        }
                    })
                    .then(json => {
                        citymun_select.empty().trigger('change');
                        removeMarkersFromMap(cm_markers, mymap);
                        cm_markers.length = 0;

                        citymun_select.append(new Option('<- ->', '-1'));

                        json.forEach(row => {
                            let option = new Option(row['cmdesc'], `[${row['latitude']}, ${row['longitude']}]`);
                            citymun_select.append(option);

                            let marker = L.marker([row["latitude"], row["longitude"]])
                                .bindPopup(`${row["cmclass"]}: ${row["cmdesc"]}`)
                                .setOpacity(0.7);
                            cm_markers.push(marker);
                        })
                        addMarkersToMap(cm_markers, mymap);
                    });
            }

            // getCMLocs().then((res) => {
            //     res.forEach((row) => {                    
            //         cmlocs.push(row);

            //         let marker = L.marker([row["latitude"], row["longitude"]])
            //             .bindPopup(`${row["cmclass"]}: ${row["cmdesc"]}`)
            //             .setOpacity(0.7);
            //         cm_markers.push(marker);
            //     });
            //     addMarkersToMap(cm_markers, mymap);
            // });

            setCityMunOptions('/ajaj/getCMLocs.php');
            current_option = 'all';

            city_or_mun_select.on('select2:select', (ev) => {
                let target = ev.target;
                let selected = target[target.selectedIndex];
                let value = selected.value

                if (value == 'city' && current_option != 'city') {
                    setCityMunOptions('/ajaj/getCLocs.php');
                    current_option = 'city';
                } else if (value == 'mun' && current_option != 'mun') {
                    setCityMunOptions('/ajaj/getMLocs.php');
                    current_option = 'mun';
                } else if (value == 'all' && current_option != 'all') {
                    setCityMunOptions('/ajaj/getCMLocs.php');
                    current_option = 'all';
                }
            });

            citymun_select.on('select2:select', (ev) => {
                let data = ev.params.data;
                if (data['id'] != '-1') {
                    [lat_pan, long_pan] = JSON.parse(data['id']);
                    mymap.panTo([lat_pan, long_pan]);
                }
            });
        });
}