<div class="content py-5 mt-5">
    <div class="container">
        <div class="card card-outline card-purple shadow rounded-0">
            <div class="card-header">
                <h4 class="card-title">My Booking List</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered table-hover">
                    <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="15%">
                        <col width="30%">
                        <col width="10%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                    <tr class="bg-gradient-dark text-light">
                        <th class="text-center">#</th>
                        <th class="text-center">Cab Plate</th>
                        <th class="text-center">Driver Name</th>
                        <th class="text-center">Details</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    $qry = $conn->query("SELECT * FROM `booking_list` where client_id = '{$_settings->userdata('id')}' order by id desc");
                    while($row = $qry->fetch_assoc()):
                        $id=$row['cab_id'];
                        $qry = $conn->query("SELECT * FROM `cabs` where id = '{$id}' ");
                        $result= $qry->fetch_assoc();
                        ?>
                        <tr>
                            <td class="text-center"><?= $i++; ?></td>
                            <td><?=
                                $result['DMV_License_Plate_Number'];
                                ?></td>
                            <td><?= $result['Name'] ?></td>
                            <td>
                                <p class="m-0 truncate-1"><b>Pickup:</b> <?= $row['pickup_zone'] ?></p>
                                <p class="m-0 truncate-1"><b>Dropoff:</b> <?= $row['drop_zone'] ?></p>
                            </td>
                            <td class="text-center">
                                <?php
                                switch($row['status']){
                                    case 0:
                                        echo "<span class='badge badge-secondary bg-gradient-secondary px-3 rounded-pill'>Assigned</span>";
                                        break;
                                    case 1:
                                        echo "<span class='badge badge-success bg-gradient-success px-3 rounded-pill'>Arrived</span>";
                                        break;
                                    case 2:
                                        echo "<span class='badge badge-danger bg-gradient-danger px-3 rounded-pill'>Cancelled</span>";
                                        break;
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-flat btn-info border btn-sm view_data" data-id="<?= $row['id'] ?>">View Details</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('table th, table td').addClass('px-2 py-1 align-middle')
        $('table').dataTable();

        $('.view_data').click(function(){
            uni_modal("Booking Details","view_booking.php?id="+$(this).attr('data-id'))
        })
    })
</script>