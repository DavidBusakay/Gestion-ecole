<?php
	function verification ($info) {
		$info = strip_tags($info);
		$info = trim($info);
		$info = stripslashes($info);
		return $info;
	}

    $server = "localhost";
    $username = "root";
    $password = "";

    try {
        $database = new PDO("mysql:host=$server; dbname=gestion-ecole", $username, $password);
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Echec de la connexion : " .$e->getMessage();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = verification($_POST["name"]);
        $firstname = verification($_POST["firstname"]);
        $email = verification($_POST["email"]);
        $sex = $_POST["sex"];
        $country = $_POST["country"];
        $city = verification($_POST["city"]);
        $address = verification($_POST["address"]);
        $mdp = $_POST["password"];
        $mdp_confirm = $_POST["confirm_password"];

        $request = $database->prepare("SELECT * FROM users WHERE email = :email");
        $request->execute(
            array(
                "email" => $email
            )
        );
        $response = $request->fetchColumn();

        if ($response > 0) {
            $error_message = "Adresse e-mail déjà utilisée !";
        } else {
            if ($mdp !== $mdp_confirm) {
				$error_message = "Vérifiez votre mot de passe !";
			} else {
				$req = $database->prepare("INSERT INTO users VALUES (0, :nom, :prenom, :email, :sexe, :pays, :ville, :adresse, :MDP)");
            	$req->execute(
					array(
						"nom" => $name,
						"prenom" => $firstname,
						"email" => $email,
						"sexe" => $sex,
						"pays" => $country,
						"ville" => $city,
						"adresse" => $address,
						"MDP" => $mdp
					)
				);
				$req->fetch();
				header("location: ./connexion.php");
			}
        }
    }
?>


<!doctype html>
<html class="no-js" lang="zxx">
	<head>
		<!-- Meta Tags -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="keywords" content="Site keywords here">
		<meta name="description" content="">
		<meta name='copyright' content=''>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- Title -->
		<title>Mediplus - Free Medical and Doctor Directory HTML Template.</title>
		
		<!-- Favicon -->
		<link rel="icon" href="../img/favicon.png">
		
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<!-- Nice Select CSS -->
		<link rel="stylesheet" href="../css/nice-select.css">
		<!-- Font Awesome CSS -->
		<link rel="stylesheet" href="../css/font-awesome.min.css">
		<!-- icofont CSS -->
		<link rel="stylesheet" href="../css/icofont.css">
		<!-- Slicknav -->
		<link rel="stylesheet" href="../css/slicknav.min.css">
		<!-- Owl Carousel CSS -->
		<link rel="stylesheet" href="../css/owl-carousel.css">
		<!-- Datepicker CSS -->
		<link rel="stylesheet" href="../css/datepicker.css">
		<!-- Animate CSS -->
		<link rel="stylesheet" href="../css/animate.min.css">
		<!-- Magnific Popup CSS -->
		<link rel="stylesheet" href="../css/magnific-popup.css">
		
		<!-- Medipro CSS -->
		<link rel="stylesheet" href="../css/normalize.css">
		<link rel="stylesheet" href="../style.css">
		<link rel="stylesheet" href="../css/responsive.css">
		
	</head>
    <body class="d-flex justify-content-center align-items-center">
		<!-- Start Contact Us -->
		<section class="contact-us">
			<div class="container d-flex justify-content-center">
				<div class="inner col-lg-6">
						<div class="col-lg-12">
							<div class="contact-us-form">
								<h1 class="mb-5" style="text-align: center;">Inscription</h1>
								<form class="form" method="post" action="">
									<div class="row">
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<input type="text" name="name" placeholder="Nom" required>
											</div>
										</div>
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<input type="text" name="firstname" placeholder="Prénom" required>
											</div>
										</div>
										<div class="col-lg-9 col-md-9">
											<div class="form-group">
												<input type="email" name="email" placeholder="E-mail" required>
											</div>
										</div>

										<div class="col-lg-3 col-md-3">
											<div class="form-group">
												<select class="nice-select form-control wide" name="sex" tabindex="0">
													<!-- <span class="current">Sexe</span> -->
													<option value="F">F</option>
													<option value="M">M</option>
												</select>
											</div>
										</div>

										<!-- <div class="col-lg-3 col-md-3">
											<div class="form-group">
												<div class="nice-select form-control wide" tabindex="0">
													<span class="current">Sexe</span>
													<ul class="list">
														<li data-value="1" class="option">F</li>
														<li data-value="2" class="option">M</li>
													</ul>
												</div>
											</div>
										</div> -->

										<div class="col-lg-12">
											<div class="form-group">
												<select class="nice-select form-control wide" name="country" tabindex="0">
													<!-- <span class="current">Pays</span> -->
													<option value="Algérie">Algérie</option>
													<option value="Bénin">Bénin</option>
													<option value="Cameroun">Cameroun</option>
													<option value="RD Congo">RD Congo</option>
													<option value="Togo">Togo</option>
													<option value="Zimbabwe">Zimbabwe</option>
												</select>
											</div>
										</div>

										<!-- <div class="col-lg-12">
											<div class="form-group">
												<div class="nice-select form-control wide" tabindex="0">
													<span class="current">Pays</span>
													<ul class="list">
														<li data-value="1" class="option">Algérie</li>
														<li data-value="2" class="option">Bénin</li>
														<li data-value="3" class="option">Cameroun</li>
														<li data-value="4" class="option">RD Congo</li>
														<li data-value="4" class="option">Togo</li>
														<li data-value="5" class="option">Zimbabwe</li>
													</ul>
												</div>
											</div>
										</div> -->
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<input type="text" name="city" placeholder="Ville" required>
											</div>
										</div>
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<input type="text" name="address" placeholder="Adresse" required>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<input type="password" name="password" placeholder="Créer mot de passe" required>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<input type="password" name="confirm_password" placeholder="Confirmer votre mot de passe" required>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group login-btn">
												<button class="btn mb-3" type="submit">S'inscrire</button>
											</div>
											<?php
												if (isset($error_message)) {
													echo "<p style='text-align: center; color: red; margin-bottom: 0px;'>" .$error_message. "</p>";
												}
											?>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Contact Us -->
		
		
		<!-- jquery Min JS -->
        <script src="../js/jquery.min.js"></script>
		<!-- jquery Migrate JS -->
		<script src="../js/jquery-migrate-3.0.0.js"></script>
		<!-- jquery Ui JS -->
		<script src="../js/jquery-ui.min.js"></script>
		<!-- Easing JS -->
        <script src="../js/easing.js"></script>
		<!-- Color JS -->
		<script src="../js/colors.js"></script>
		<!-- Popper JS -->
		<script src="../js/popper.min.js"></script>
		<!-- Bootstrap Datepicker JS -->
		<script src="../js/bootstrap-datepicker.js"></script>
		<!-- Jquery Nav JS -->
        <script src="../js/jquery.nav.js"></script>
		<!-- Slicknav JS -->
		<script src="../js/slicknav.min.js"></script>
		<!-- ScrollUp JS -->
        <script src="../js/jquery.scrollUp.min.js"></script>
		<!-- Niceselect JS -->
		<script src="../js/niceselect.js"></script>
		<!-- Tilt Jquery JS -->
		<script src="../js/tilt.jquery.min.js"></script>
		<!-- Owl Carousel JS -->
        <script src="../js/owl-carousel.js"></script>
		<!-- counterup JS -->
		<script src="../js/jquery.counterup.min.js"></script>
		<!-- Steller JS -->
		<script src="../js/steller.js"></script>
		<!-- Wow JS -->
		<script src="../js/wow.min.js"></script>
		<!-- Magnific Popup JS -->
		<script src="../js/jquery.magnific-popup.min.js"></script>
		<!-- Counter Up CDN JS -->
		<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
		<!-- Google Map API Key JS -->
		<script src="https://maps.google.com/maps/api/js?key=AIzaSyDGqTyqoPIvYxhn_Sa7ZrK5bENUWhpCo0w"></script>
		<!-- Gmaps JS -->
		<script src="../js/gmaps.min.js"></script>
		<!-- Map Active JS -->
		<script src="../js/map-active.js"></script>
		<!-- Bootstrap JS -->
		<script src="../js/bootstrap.min.js"></script>
		<!-- Main JS -->
		<script src="../js/main.js"></script>
    </body>
</html>