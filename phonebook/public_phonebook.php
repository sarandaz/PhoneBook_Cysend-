<?php
include('../db/config.php');

$stmt = $conn->query("SELECT * FROM user where published = true");
?>
<div class="row">
<div class="public_data float-start">
    <?php
    while ($row = $stmt->fetch()) {
        echo $row['first_name'] . " " . $row['last_name'];

    ?>
        
        <div id="<?= $row['id'] ?>" class="col-md-12">

            <!-- <div class="row mb-3">
                <label class="col-sm-3 col-form-label">First name</label>
                <p></p>
            </div>
            <div class="row mb-3">
                <label for="inputLastName" class="col-sm-3 col-form-label">Last Name</label>
                <div class="col-sm-9">
                    <input type="text" name="last_name" value="<?php echo isset($user['last_name']) ? $user['last_name'] : ''  ?>" class="form-control" id="inputLastName">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputAddress" class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-9">
                    <input type="text" name="address" value="<?php echo isset($user['address']) ? $user['address'] : ''  ?>" class="form-control" id="inputAddress">
                </div>
            </div> -->

            <?php
             echo '<div class="row mb-3"><label class=" col-form-label">First name</label><span>'. $row['first_name'] .'</span></div>';
             echo '<div class="row mb-3"><label class="col-form-label">Last name</label><span>'. $row['last_name'] .'</span></div>';
             echo '<div class="row mb-3"><label class=" col-form-label">Address</label><span>'. $row['address'] .'</span></div>';
             echo '<div class="row mb-3"><label class=" col-form-label">Zip City</label><span>'. '' .'</span></div>';
             echo '<div class="row mb-3"><label class=" col-form-label">Country</label><span>'. $row['country'] .'</span></div>';

            ?>
       
        </div>
    <?php } ?>
</div>
</div>