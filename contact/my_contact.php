<?php
session_start();
include('../db/config.php');
?>
<div class="row">
<div class="col-md-12">
<div class="flash_data"></div>
</div>
<div class="col-md-12">
<form id="contact">
    <?php 
   $stmt = $conn->prepare("SELECT * FROM user WHERE username=?");
   $stmt->execute([$_SESSION['username']]); 
   $user = $stmt->fetch();

   $stmt1 = $conn->prepare("SELECT * FROM phone_number WHERE username=?");
   $stmt1->execute([$_SESSION['username']]); 
   
   $stmt2 = $conn->prepare("SELECT * FROM email WHERE username=?");
   $stmt2->execute([$_SESSION['username']]); 
//    var_dump($user);
    ?>
    <div class="row">
        <div class="col-md-4">
            <div class="title">
                <h4>Contact</h4>
            </div>
            <div class="row mb-3">
                <label for="inputFirstName" class="col-sm-3 col-form-label">First name</label>
                <div class="col-sm-9">
                    <input type="text" name="first_name" 
                    value="<?php echo isset($user['first_name']) ? $user['first_name'] : ''  ?>" 
                    class="form-control" id="inputFirstName">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputLastName" class="col-sm-3 col-form-label">Last Name</label>
                <div class="col-sm-9">
                    <input type="text" name="last_name" 
                    value="<?php echo isset($user['last_name']) ? $user['last_name'] : ''  ?>" 
                    class="form-control" id="inputLastName">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputAddress" class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-9">
                    <input type="text" name="address" 
                    value="<?php echo isset($user['address']) ? $user['address'] : ''  ?>" 
                    class="form-control" id="inputAddress">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputZipCity" class="col-sm-3 col-form-label">Zip/City</label>
                <div class="col-sm-9">
                    <input type="text" name="zip_city" 
                    value="<?php echo isset($user['zip_city']) ? $user['zip_city'] : ''  ?>" 
                    class="form-control" id="inputZipCity">
                </div>
            </div>
            <div class="row mb-3">
                <label for="country" class="col-sm-3 col-form-label">Country</label>
                <div class="col-sm-9">
                    <select class="form-select" name="country" aria-label="Select country">
                        <option value="">Open this select menu</option>
                        <?php
                        $stmt = $conn->query("SELECT * FROM countries");
                        while ($row = $stmt->fetch()) {
                            echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                        }
                        ?>

                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="title">
                <h4>Phones</h4>
            </div>
            

          
            <div id="phone">
            <?php 
            while($user_phones = $stmt1->fetch()) {
                ?>
                <div class="row mb-3">
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?php echo $user_phones['phone_number'] ?>" name="phone[0][]" id="inputPhone">
                    </div>
                    <div class="col-sm-2">
                        <input class="form-check-input" checked="<?= ($user_phones['published'] == true) ?  'checked' : ''; ?>"
                        type="checkbox" id="phone_published" name="phone[0][]" value="yes">
                    </div>
                </div>
                <?php  }; ?>
            </div>
            <div class="float-end me-4">
                <button id="addRowPhone" type="button" class="btn btn-info btn-sm ">Add</button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="title">
                <h4>Email</h4>
            </div>
            <div id="email">
            <?php 
            while($user_emails = $stmt2->fetch()) {
                ?>
                <div class="row mb-3">
                    <div class="col-sm-10">
                        <input type="email" class="form-control" value="<?= $user_emails['email_address'] ?>" name="email[0][]" id="inputEmail">
                    </div>
                    <div class="col-sm-2">
                        <input class="form-check-input" type="checkbox" checked="<?= ($user_emails['published'] == true) ?  'checked' : ''; ?>"
                        id="email_published" name="email[0][]" value="yes">
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="float-end me-4">
                <button id="addRowEmail" type="button" class="btn btn-info btn-sm ">Add</button>
            </div>
        </div>


    </div>
    </div>
    <div class="d-flex justify-content-end">
        <button type="button" onclick="submitContacts()" class="btn btn-secondary btn-lg px-5">Save</button>

    </div>
</form>
</div>
</div>

<script>
    let counterAddEmail = 0;
    $("#addRowEmail").click(function() {
        counterAddEmail++;
        var html = '';
        html += '<div class="row mb-3">';
        html += ' <div class="col-sm-10">';
        html += ' <input type="email" class="form-control" name="email[' + counterAddEmail + '][]" id="inputEmail">';
        html += '</div>';
        html += '<div class="col-sm-2">';
        html += '<input class="form-check-input" type="checkbox" id="email_published" name="email[' + counterAddEmail + '][]" value="yes">';
        html += '</div>';
        html += '</div>';

        $('#email').append(html);
    });
    let counterAddPhone = 0;
    $("#addRowPhone").click(function() {
        counterAddPhone++;
        var html = '';
        html += '<div class="row mb-3">';
        html += ' <div class="col-sm-10">';
        html += '<input type="text" class="form-control" name="phone[' + counterAddPhone + '][]" id="inputPhone">';
        html += '</div>';
        html += '<div class="col-sm-2">';
        html += '<input class="form-check-input" type="checkbox" id="phone_published" name="phone[' + counterAddPhone + '][]" value="yes">';
        html += '</div>';
        html += '</div>';
        $('#phone').append(html);
    });

    function submitContacts() {
        var data = $('form').serialize();
        $.post('contact/save_contacts.php', data).done(function(res) {
            $(".flash_data").html('<div class="alert alert-success" role="alert">' + res + '</div>')
        });
    }
</script>