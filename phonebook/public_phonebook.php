<?php
include('../db/config.php');


$stmt = $conn->query("SELECT * FROM user join countries on countries.id = user.country
                        where published = true")->fetchAll();

$stmt1 = $conn->query("SELECT * from phone_number")->fetchAll();
$data = [];

// TODO: Get emails and append to data array

foreach($stmt as $row) {
    foreach($stmt1 as $phone_number) {
        if($row['username'] == $phone_number['username']){
            $row['phone_number'][] = $phone_number;
            
        }
        
    }
    $data[] = $row;
}

?>


<div class="row">
    <div class="public_data float-start">
        <?php
        foreach($data as $row) { 
            $counter = 1;
        ?>

            <div class="">
                
                <div class="row">
                    <div class="col-md-4"><?= $counter  ?> . <?= $row['first_name']  . " " . $row['last_name']  ?></div><a class="col-md-4" href="#" onclick="showDetails(<?= $row['id'] ?>)">Show details</a>
                </div>
                <div class="py-3 px-3" id="<?= $row['id'] ?>" style="display:none;">
                <div class="row">
                    <div class="col-md-4">
                        <h6> Address: </h6>
                        <div class="d-flex justify-content-start"><?= $row['address'] ?></div>
                        <div class="d-flex justify-content-start"><?= isset($row['zip_city']) ? $row['zip_city'] : "" ?></div>
                        <div class="d-flex justify-content-start"><?= $row['name'] ?></div>
                    </div>
                    <div class="col-md-4">
                        <h6>Phone numbers</h6>
                         <?php foreach ($row['phone_number'] as $phone ){ ?>
                            <div class="d-flex justify-content-start"><?= $phone['phone_number'] ?></div>
                            <?php } ?>
                    </div>
                    <div class="col-md-4">
                        <h6>Emails</h6>
                        <!-- TODO: Loop through emails -->
                    </div>
                    </div>
                </div>
            </div>

    </div>
        <?php 
            $counter++;
        } 
        ?>
</div>
</div>
<script>
    function showDetails(id) {
        $("#" + id).toggle();
    }
</script>