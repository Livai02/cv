<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if (session_id() == '' || !isset($_SESSION)) {
    session_start();
}

?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact || BOLT Sports Shop</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
</head>

<body>

    <nav class="top-bar" data-topbar role="navigation">
        <ul class="title-area">
            <li class="name">
                <h1><a href="index.php">BOLT Sports Shop</a></h1>
            </li>
            <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
        </ul>

        <section class="top-bar-section">
            <!-- Right Nav Section -->
            <ul class="right">
                <li><a href="about.php">About</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="cart.php">View Cart</a></li>
                <li><a href="orders.php">My Orders</a></li>
                <li class="active"><a href="contact.php">Contact</a></li>
                <?php

                if (isset($_SESSION['username'])) {
                    echo '<li><a href="account.php">My Account</a></li>';
                    echo '<li><a href="logout.php">Log Out</a></li>';
                } else {
                    echo '<li><a href="login.php">Log In</a></li>';
                    echo '<li><a href="register.php">Register</a></li>';
                }
                ?>
            </ul>
        </section>
    </nav>




    <div class="row" style="margin-top:30px;">
        <div class="small-12">



            <?php
            // $pass = 'Poil250Poil250!!';

            use PHPMailer\PHPMailer\PHPMailer;

            require 'vendor/autoload.php';
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->Username = 'livai.ackerman02@gmail.com';
            $mail->Password = 'Caline-1009';
            $mail->setFrom('livai.ackerman02@gmail.com', 'Alicia');
            $mail->addAddress('livai.ackerman02@gmail.com', 'Alicia Coca');





            if ($mail->addReplyTo(!empty($_POST['email'])) || (!empty($_POST['Nom']))) {
                $mail->Subject = 'Formulaire de contact PHPMailer';
                $mail->isHTML(false);
                $mail->Body = <<<EOT
E-mail: {$_POST['email']}
Nom: {$_POST['Nom']}
Message: {$_POST['message']}
EOT;
                if (!$mail->send()) {
                    $msg = 'Désolé, quelque chose a mal tourné. Veuillez réessayer plus tard.';
                } else {
                    $msg = 'Message envoyé ! Merci de nous avoir contactés.';
                }
            } else {
                $msg = 'Contactez-nous !';
            }
            ?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <title>Formulaire de contact</title>
            </head>

            <body>
                <h1>Pour toute information</h1>
                <?php if (!empty($msg)) {
                    echo "<h2>$msg</h2>";
                } ?>
                <form method="POST">
                    <label for="name">Nom: <input type="text" name="Nom" id="name"></label><br><br>
                    <label for="email">E-mail: <input type="email" name="email" id="email"></label><br><br>
                    <label for="message">Message: <textarea name="message" id="message" rows="8" cols="20"></textarea></label><br><br>
                    <input type="submit" value="Envoyer">
                </form>
            </body>

            </html>


            <footer>
                <p style="text-align:center; font-size:0.8em;">&copy; BOLT Sports Shop. All Rights Reserved.</p>
            </footer>

        </div>
    </div>







    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
        $(document).foundation();
    </script>
</body>

</html>