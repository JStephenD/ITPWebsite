<div class="mapping-main">
    <div id="covidTraceMap"></div>
    <div class="mapping-options">
        <div class="option">
            <input type="checkbox" name="cms" id="cms">
            <label for="cms">Toggle City/Municipalities Label</label>
        </div>
        <div class="option">
            <input type="checkbox" name="brgs" id="brgs">
            <label for="brgs">Toggle Barangay Labels</label>
        </div>
    </div>
</div>

<script>
    window.addEventListener('load', () => {
        let mymap = L.map('covidTraceMap').setView([<?= $loc[0]; ?>, <?= $loc[1]; ?>], 10);

        let tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
        let attribution = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap Contributors</a>';
        let tiles = L.tileLayer(tileUrl, {
            attribution
        });
        tiles.addTo(mymap);

        async function getCMLocs() {
            return await fetch('/ajaj/getCMLocs.php', {
                    method: 'GET',
                    headers: {
                        'Accepts': 'application/json'
                    }
                })
                .then((res) => {
                    if (res.ok) {
                        return res.json()
                    }
                })
                .then((json) => {
                    return json
                })
        }

        let cms = [];

        getCMLocs().then((res) => {
            res.forEach((row) => {
                let marker = L.marker([row['latitude'], row['longitude']]).addTo(mymap);
                marker.bindPopup(`${row['cmclass']}: ${row['cmdesc']}`);
                marker.setOpacity(0.7)
                cms.push(marker);
            });
        });



        let cms_radio = document.querySelector('#cms');
        let brgs_radio = document.querySelector('#brgs');
        cms_radio.addEventListener('click', (ev) => {
            let target = ev.target;
            cms.forEach((cm) => {
                cm.setOpacity(target.checked ? 0 : 0.7);
            });
        });

        
    });
</script>