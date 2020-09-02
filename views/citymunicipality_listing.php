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
            <?php foreach($cms as $row) { ?>
            <tr>
                <td scope="row"><?= $row['cmdesc'] ;?></td>
                <td><?= $row['cmclass'] ;?></td>
                <td><?= $row['latitude'] ;?></td>
                <td><?= $row['longitude'] ;?></td>
                <td><?= $row['remarks'] ;?></td>
                <td class='action'>
                    <a href="/citymunicipality/edit/<?= $row['id'] ;?>">
                        <i class="fas fa-edit table-edit"></i></a>
                    <a href="/citymunicipality/delete/<?= $row['id'] ;?>">
                        <i class="fas fa-backspace table-delete"></i></a>
                </td>
            </tr>
            <?php } ?>
        </tbody>    
    </table>
</div>