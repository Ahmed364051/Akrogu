<?php
	session_start();

	if (!$_SESSION['user']) {
		header('Location: signin.php');


	}
	require_once 'vendor/connect.php';
?> 


<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Akrogu</title>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="build/css/styles.css">
</head>
<body>
	<header class="header">
		<div class="container">
			<div class="header__inner">
				<div class="nav">
					<img src="img/logo.svg" alt="logo" class="logo-min">
					<div class="player">
						<span class="player__name"></span>
						<div class="player__btns">
							<div class="player__box">
								<img src="img/play.svg" class="player__btn-play">
							</div>
							<a href="#" class="player__btn">Случайный опенинг</a>
						</div>
					</div>
					<div class="user btn-popup" data-popup="#popup-options" data-call-popup="popup">
						<div class="user__box">
							<img class="user__pic" src="<?= ($_SESSION['userpic']) ? $_SESSION['userpic'] : $_SESSION['user']['userpic']?>" alt="user_pic">
						</div>
						<span class="user__nick">
							<?= $_SESSION['user']['nickname']?>
						</span>
					</div>
				</div>
			</div>
		</div>
	</header>
	<main class="main">
		<div class="container">
			<div class="main__inner">
				<form class="about" action="/vendor/newpost.php" method="post" accept="image/jpeg, image/jpg" autocomplete="off" enctype="multipart/form-data">
					<label class="about__box about__box_title">
						<input type="text" name="list_name" value="Название аниме" class="about__name" required>
						<img src="img/pen.svg" alt="pen" class="about__pen">
						<span class="about__warning"></span>
					</label>
					<div class="about__holder">
						<label class="about__box">
							<textarea name="comment" class="about__comment" placeholder="Комментарий к аниме..."></textarea>
							<span class="about__warning"></span>
						</label>
						<label class="about__box about__box_poster">
							<span class="about__text-poster">Постер</span>
							<!-- <img src="#" class="about__picture"> -->
							<input type="file" name="poster" required class="about__poster">
						</label>
					</div>
					<input type="text" name="user_id" value="<?=$_SESSION['user']['id_user']?>" hidden>
					<ul class="rating" data-total-value="0">
						<li class="rating__item" data-item-value="10">★</li>
						<li class="rating__item" data-item-value="9">★</li>
						<li class="rating__item" data-item-value="8">★</li>
						<li class="rating__item" data-item-value="7">★</li>
						<li class="rating__item" data-item-value="6">★</li>
						<li class="rating__item" data-item-value="5">★</li>
						<li class="rating__item" data-item-value="4">★</li>
						<li class="rating__item" data-item-value="3">★</li>
						<li class="rating__item" data-item-value="2">★</li>
						<li class="rating__item" data-item-value="1">★</li>
					</ul>
					<input type="text" name="rating" class="rating-input" hidden>
					<button type="submit" class="about__btn btn">Добавить</button>
					<div class="about__advice">
						Будь <span class="about__word about__word_adjective verb">целеустремленным</span>
						как <span class="about__word about__word_name verb">Наруто</span>
					</div>
				</form>
				<div class="list">
					<div class="list__details">
						<h2 class="list__title">
							Список:
						</h2>
						<div class="list__helpers">
							<div class="list__search" >
								<input type="text" class="list__input" id="search" placeholder="Поиск">
								<img src="img/loop.svg" alt="loop" class="list__loop">
							</div>
							<div class="list__sort">
								<button class="list__btn list__btn_asc">A-Z</button>
								<button class="list__btn list__btn_desk">Z-A</button>
							</div>
						</div>
					</div>
					
					<ul class="list__holder">
						<?php foreach(getAll("SELECT * FROM list WHERE user_id ={$_SESSION['user']['id_user']} ") as $list) {?>
						<li class="list__item btn-popup" data-list-name="<?=$list['list_name']?>" data-popup="#popup-about" data-call-popup="popup">
							<span class="list__name">
								<?=$list['list_name']?>		
							</span>
							<button class="list__del">
								<img src="img/delete.svg" alt="delete">
							</button>
						</li>
						<?php }?>
					</ul>
				</div>
			</div>
		</div>
		<div class="popup js-popup-hide" id="popup-options">
			<div class="popup__body">
				<div class="popup__wrap"></div>
				<img src="img/horn-left-big.svg" class="popup__horn popup__horn_left">
				<img src="img/horn-center-big.svg" class="popup__horn popup__horn_center">
				<img src="img/horn-right-big.svg" class="popup__horn popup__horn_right">
				<div class="popup__options">
					<div class="popup__eye">
						<div class="popup__eyeball">
	
						</div>
					</div>
					<ul class="popup__nav">
						<li class="popup__item">
							<form action="vendor/edituserpic.php" class="popup__userpic" method="post" enctype="multipart/form-data">
								<label class="popup__label">
									<input type="file" name="userpic" class="popup__file">
									<span class="popup__link">Обновить фотографию</span>
								</label>
							</form>
						</li>
						<li class="popup__item">
							<a href="/vendor/logout.php" class="popup__link">Выйти</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="popup js-popup-hide" id="popup-about">
			<div class="popup__body">
				<div class="popup__wrap"></div>
				<div class="popup__content">
					<h1 class="popup__title">
						Моя геройская академия
					</h1>
					<div class="popup__row">
						<div class="popup__left">
							<p class="popup__text">
								"Моя геройская академия" - неплохой тайтл. Смотреть интересно и легко,
								хотя иногда бывают скучные моменты. Довольно интересные второстепенные персонажи.
								В аниме много экшена и проработанных боев. В мире, в котором много опасности, очень мало смертей.
								По моему мнению это несерьезно и похоже на детский мультсериал. Поскольку это аниме - обычный сёнен,
								то и негативные стороны у него вполне типичные. Слишком много пафоса и шаблонности
								(например, слабый становится достойным великой силы). Главный герой - тряпка, который ныл почти в каждой серии.
								"Моя геройская академия" - неплохой тайтл. Смотреть интересно и легко,
								хотя иногда бывают скучные моменты. Довольно интересные второстепенные персонажи.
								В аниме много экшена и проработанных боев. В мире, в котором много опасности, очень мало смертей.
								По моему мнению это несерьезно и похоже на детский мультсериал. Поскольку это аниме - обычный сёнен,
								то и негативные стороны у него вполне типичные. Слишком много пафоса и шаблонности
								(например, слабый становится достойным великой силы). Главный герой - тряпка, который ныл почти в каждой серии.
							</p>
							<span class="popup__grade">
								5
							</span>
						</div>
						<div class="popup__right">
							<img src="posters/12345.jpg" alt="poster" class="popup__poster">
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<ul class="animation-bg">
		<li class="animation-bg__item"></li>
		<li class="animation-bg__item"></li>
		<li class="animation-bg__item"></li>
		<li class="animation-bg__item"></li>
		<li class="animation-bg__item"></li>
		<li class="animation-bg__item"></li>
		<li class="animation-bg__item"></li>
		<li class="animation-bg__item"></li>
		<li class="animation-bg__item"></li>
		<li class="animation-bg__item"></li>
	</ul>
	<script src="build/js/script.js"></script>
</body>
</html>