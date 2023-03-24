<?php

require_once 'libraries/Session.php';

?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<title>Projet CatChat</title>
	<link rel="stylesheet" href="css/styles.css" />
	<link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body>
	<header>
		<div>
			<a href="index.php">
				<img src="logo.png" alt="Logo PintView" class="logo">
			</a>
			<nav class="nav">
				<a href="index.php">Accueil</a>

				<?php if (Session::isConnected() == false) : ?>
<!-- 					<a href="index.php?controller=status&task=santeindex.php">Santé</a>
					<a href="index.php?controller=status&task=sportindex.php">Sport</a>
					<a href="index.php?controller=status&task=activiteindex.php">Activités</a> -->
					<a href="index.php?controller=users&task=formLogin">Connexion</a>
					<a href="index.php?controller=users&task=register">Inscription</a>
				<?php else : ?>
					<a href="index.php?controller=users&task=myCount">Mon compte</a>
					<a href="index.php?controller=users&task=logout">Déconnexion</a>
				<?php endif ?>

			</nav>
		</div>
	</header>
	<main>
		<?php if (Session::hasFlashes('error')) : ?>
			<div class="alerts errors">
				<?php foreach (Session::getFlashes('error') as $message) : ?>
					<p><?= $message ?></p>
				<?php endforeach ?>
			</div>
		<?php endif ?>

		<?php if (Session::hasFlashes('success')) : ?>
			<div class="alerts success">
				<?php foreach (Session::getFlashes('success') as $message) : ?>
					<p><?= $message ?></p>
				<?php endforeach ?>
			</div>
		<?php endif ?>