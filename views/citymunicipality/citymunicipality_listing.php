<main id="main">
    <div class="container-fluid">
        <table id="cmlist" class="hover row-borders">
            <thead>
                <tr>
                    <th scope="col">City/Municipality Name</th>
                    <th scope="col">Classification</th>
                    <th scope="col">Latitude</th>
                    <th scope="col">Longitude</th>
                    <th scope="col">Remarks</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cms as $row) { ?>
                    <tr>
                        <td scope="row"><?= $row['cmdesc']; ?></td>
                        <td><?= $row['cmclass']; ?></td>
                        <td><?= $row['latitude']; ?></td>
                        <td><?= $row['longitude']; ?></td>
                        <td><?= $row['remarks']; ?></td>
                        <td class='action'>
                            <abbr title="Edit">
                                <a href="/citymunicipality/edit/<?= $row['id']; ?>">
                                    <i class="fas fa-edit table-edit abbr-edit"></i>
                                </a>
                            </abbr>
                            <abbr title="Delete">
                                <i data-href="/citymunicipality/delete/<?= $row['id']; ?>" data-name="<?= $row['cmdesc']; ?>" class="fas fa-backspace table-delete abbr-delete">
                                </i>
                            </abbr>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</main>

<?php if (!isset($_POST['ajax'])) { ?>
    <script defer="defer" src="/assets/js/citymun/citymun_listing.js"></script>
<?php } ?>