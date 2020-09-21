<main id="main">
    <table id="blist" class="hover row-borders">
        <thead>
            <tr>
                <th scope="col">Location</th>
                <th scope="col">Barangay Name</th>
                <th scope="col">Estimated Population</th>
                <th scope="col">Category</th>
                <th scope="col">Latitude</th>
                <th scope="col">Longitude</th>
                <th scope="col">Remarks</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($brngys as $row) { ?>
                <tr>
                    <td scope="row"><?= $cities[$row['idcm']]; ?></td>
                    <td scope="row"><?= $row['bname']; ?></td>
                    <td><?= $row['estpop']; ?></td>
                    <td><?= $row['blevel']; ?></td>
                    <td><?= $row['latitude']; ?></td>
                    <td><?= $row['longitude']; ?></td>
                    <td><?= $row['remarks']; ?></td>
                    <td class='action'>
                        <abbr title="Edit">
                            <a href="/barangay/edit/<?= $row['id']; ?>">
                                <i class="fas fa-edit table-edit abbr-edit"></i>
                            </a>
                        </abbr>
                        <abbr title="Delete">
                            <i data-href="/barangay/delete/<?= $row['id']; ?>" data-name="<?= $row['bname']; ?>" class="fas fa-backspace table-delete abbr-delete">
                            </i>
                        </abbr>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>

<?php if (!isset($_POST['ajax'])) { ?>
    <script defer="defer" src="/assets/js/barangay/brgy_listing.js"></script>
<?php } ?>