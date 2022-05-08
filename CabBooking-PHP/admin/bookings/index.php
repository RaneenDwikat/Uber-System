<div class="card card-outline card-purple shadow rounded-0">
    <div class="card-header">
        <h3 class="card-title">Booking List</h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-striped table-bordered table-hover">
                <colgroup>
                    <col width="5%">
                    <col width="14%">
                    <col width="11%">
                    <col width="10%">
                    <col width="20%">
                    <col width="10%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr class="bg-gradient-dark text-light">
                        <th class="text-center">#</th>
                        <th class="text-center">Cab Plate</th>
                        <th class="text-center">Driver Name</th>
                        <th class="text-center">Client Name</th>
                        <th class="text-center">Pick up Zone</th>
                        <th class="text-center">Drop Zone</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    $bookings = $conn->query("SELECT * FROM `booking_list` where client_id = '{$_settings->userdata('id')}' order by id desc");

                    while($row = $bookings->fetch_assoc()){
                        $id=$row['cab_id'];
                        $qr = $conn->query("SELECT * FROM `cabs` where id = '{$id}' ");
                        while($result= $qr->fetch_assoc()){
                        $cid=$row['client_id'];
                        $qry = $conn->query("SELECT * FROM `client_list` where id = '{$cid}' ");
                        while($resultc= $qry->fetch_assoc()){
                    ?>
                        <tr>
                            <td class="text-center"><?= $i++ ?></td>
                            <td><?= $result['DMV_License_Plate_Number'] ?></td>
                            <td><?= $result['Name'] ?></td>
                            
                            <td><?= $resultc['firstname']." ".$resultc['lastname'] ?></td>
                            <td><?= $row['pickup_zone'] ?></td>
                            <td><?= $row['drop_zone'] ?></td>
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
                                        default:
                                            echo "<span class='badge badge-danger bg-gradient-danger px-3 rounded-pill'>Assigned</span>";
                                            break;
                                    }
                                ?>
                            </td>
                            </td>

                        </tr>
                    <?php } }}?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(function(){

        $('.table th, .table td').addClass("align-middle px-2 py-1")
		$('.table').dataTable();
		$('.table').dataTable();
        $('.view_data').click(function(){
            uni_modal("Booking Details","bookings/view_booking.php?id="+$(this).attr('data-id'))
        })
    })
</script>