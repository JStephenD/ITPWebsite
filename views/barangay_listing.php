<div class="container-fluid">
    <table id="blist" class="hover row-borders">
        <thead>
            <tr>
                <th scope="col">Barangay Name</th>
                <th scope="col">Latitude</th>
                <th scope="col">Longitude</th>
                <th scope="col">Remarks</th>                
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($brngys as $row) { ?>
            <tr>
                <td scope="row"><?= $row['bname'] ;?></td>
                <td><?= $row['latitude'] ;?></td>
                <td><?= $row['longitude'] ;?></td>
                <td><?= $row['remarks'] ;?></td>
                <td class='action'>
                    <a href="/barangay/edit/<?= $row['id'] ;?>"><i class="fas fa-edit table-edit"></i></a>
                    <a href="/barangay/delete/<?= $row['id'] ;?>"><i class="fas fa-backspace table-delete"></i></a>
                </td>
            </tr>
            <?php } ?>
        </tbody>    
    </table>
</div>