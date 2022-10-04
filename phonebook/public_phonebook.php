<?php
include('../db/config.php');


$stmt = $conn->query("SELECT * FROM user join countries on countries.id = user.country
                        where published = true");

// $stmt1 = $conn->query("SELECT * from phone_number where username=?");


?>


<div class="row">
    <div class="public_data float-start">
        <?php
        while ($row = $stmt->fetch()) {
            $username = $row['username'];
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
        
                            <div class="d-flex justify-content-start"><?= "" ?></div>
                    </div>
                    <div class="col-md-4">
                        <h6>Emails</h6>
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