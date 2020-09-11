<div class="container-fluid">
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
                    <td scope="row"><?= $cities[$row['idcm']] ;?></td>
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
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let table_delete = document.querySelectorAll('.table-delete');

        const custSwal = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-outline-warning btn-lg mr-2',
                cancelButton: 'btn btn-secondary btn-lg ml-2'
            },
            buttonsStyling: false
        })

        table_delete.forEach((el) => {
            el.addEventListener('click', (ev) => {
                let target = ev.target;
                let href = target.dataset.href;
                let name = target.dataset.name;

                custSwal.fire({
                    icon: 'warning',
                    title: `Delete ${name} Record?`,
                    text: 'You won\'t be able to revert this!',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: `<a href=${href}>Yes, delete it!</a>`
                })
            });
        });
    });
</script>