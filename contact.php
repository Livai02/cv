<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Contact</title>
</head>
<body>
        <!-- navbar  -->
<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
    <div class="container-fluid">
      <a class="navbar-brand">Alicia Ligot</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#"></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="index.html" id="navbarDropdown" role="button" aria-expanded="false">
             Accueil
            </a>
        </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
             lien
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="https://www.linkedin.com/in/alicia-ligot-93b8971b7/">linkedin</a></li>
              <li><a class="dropdown-item" href="https://github.com/Livai02">github</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
</nav>

<?php
$serveur = 'localhost';
$dbname = 'CV';
$user = 'root';
$pass= '';
if(!empty($_POST['Nom']) && !empty($_POST['Prenom']) &&!empty($_POST['Email']) &&!empty($_POST['message']) &&!empty($_POST['telephone']) )
{
  $Nom=$_POST['Nom'];
  $Prenom=$_POST['Prenom'];
  $Email=$_POST['Email'];
  $message=$_POST['message'];
  $telephone=$_POST['telephone'];
    try{
        //On se connecte à la BDD
        $dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //On insère les données reçues
        $sth = $dbco->prepare("INSERT INTO `contact` (Nom, Prenom, Email, message, telephone) VALUES (:Nom, :Prenom, :Email, :message, :telephone)");     
        $sth->bindParam(':Nom',$Nom);
        $sth->bindParam(':Prenom',$Prenom);
        $sth->bindParam(':Email',$Email);
        $sth->bindParam(':message',$message);
        $sth->bindParam(':telephone',$telephone);
        $sth->execute();
    }
    //code erreur
    catch(PDOException $e){
        echo 'Impossible de traiter les données. Erreur : '.$e->getMessage();
    }
  
  } else {
    echo "pas de connexion a la base !";
  }
 
  use PHPMailer\PHPMailer\PHPMailer;
  require 'vendor/autoload.php';
  $mail = new PHPMailer;
  $mail->isSMTP();
  $mail->SMTPDebug = 2;
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 645;
  $mail->SMTPAuth = true;
  $mail->Username = 'Livai.ackerman02@gmail.com';
  $mail->Password = 'Caline-1009';
  $mail->setFrom('Livai.ackerman02@gmail.com', 'Alicia');
  $mail->addReplyTo('Livai.ackerman02@gmail.com', 'Alicia');
			if (!empty($_POST)) {
				$point = strpos($_POST['Email'], ".");
				$aroba = strpos($_POST['Email'], "@");
				if ($point === false)
					echo 'Votre Email doit comporter un point.<br>';
				else if ($aroba === false)
					echo 'Votre Email doit comporter un arobase.<br>';
				else
					echo 'Votre Email est : ' . $_POST['Email']. '<br>';
					echo 'Votre telephone et le: ' .$_POST['telephone']. '<br>';
					echo 'Votre message est : ' . $_POST['message']. '<br>';
			}
 			if(isset($_POST['message'])){
			$entete = 'MIME-Version: 1.0' . "\r\n";
			$entete .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			$entete .= 'From: ' .$_POST['Email']. "\r\n";
			$message = '<h1>Message envoyé depuis la page Contact de monsite.fr</h1>;
			<p><b>Nom : </b>' . $_POST['Nom'] . '<br>
			<b>Email : </b>' . $_POST['Email'] . '<br>
			<b>Message : </b>' . $_POST['message'] . '</p>';
			$retour = mail('Livai.ackerman02@gmail.com', 'Envoi depuis formulaire', $message, $entete);
			if($retour) {
			echo '<p>Votre message a bien été envoyé.</p>';
			};
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Insérer des données dans la table Contact</title>
  </head>
  <body>
    <!-- declaration methode post sinon get par default -->
  <form id="regForm" method="post" action="">
  <h1>Contacter moi:</h1>
  <!-- tableau et mise en form -->
  <div class="tab">Présentation:
   <p><input placeholder="Prenom..." oninput="this.className = ''" name="Prenom"></p>
    <p><input placeholder="Nom..." oninput="this.className = ''" name="Nom"></p>
   
  </div>
  <div class="tab">Contact Info:
    <p><input placeholder="E-mail..." oninput="this.className = ''" name="Email"></p>
    <p><input placeholder="telephone..." oninput="this.className = ''" name="telephone"></p>
  </div>
  <div class="tab">Message:
    <p><input placeholder="message..." oninput="this.className = ''" name="message"></p>
  </div>
  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
  </div>
  <!-- carousel de point: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
</form>
<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>
</body>
</html>