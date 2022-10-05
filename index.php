<?php
session_start();
include('db/config.php');
?>

<body class="bg-light">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.6.1.min.js"></script>


    <div class="container">
        <main>
            <div class="py-5 text-center">
                <h2>Phonebook</h2>
            </div>
            <div class="row">
                <div class="d-grid gap-2 d-md-block">
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo '<button onclick="logOut()" type="button" class="btn btn-secondary">Logout</button>';
                    } else {
                        echo '<button onclick="showLoginPage(this)" type="button" class="btn btn-secondary">Login</button>';
                    }
                    ?>

                    <button onclick="showPublicPhonePage(this)" type="button" class="btn btn-secondary">Public Phonebook</button>
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo '<button onclick="showMyContactPage(this)" type="button" class="btn btn-secondary">My Contact</button>';
                    }
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="content px-5 py-5 container"></div>
            </div>

        </main>
    </div>


    <script>
        function showLoginPage() {
            $.get("authentication/login.php", function(data) {
                // Display the returned data in browser
                $(".content").html('');
                $(".content").html(data);
            });
        }

        function showPublicPhonePage() {
            $.get("phonebook/public_phonebook.php", function(data) {
                // Display the returned data in browser
                $(".content").html('');
                $(".content").html(data);
            });
        }

        function showMyContactPage() {
            $.get("contact/my_contact.php", function(data) {
                // Display the returned data in browser
                $(".content").html('');
                $(".content").html(data);
            });
        }

        function logOut() {
            $.post("authentication/logout.php", {
                "can_logout": true
            }, function(data) {
                if (data.can_logout) {
                    location.reload()
                }
            }, "json");
        }
    </script>
</body>