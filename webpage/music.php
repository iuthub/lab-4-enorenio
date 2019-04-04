<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Music Viewer</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="viewer.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div id="header">

			<h1>190M Music Playlist Viewer</h1>
			<h2>Search Through Your Playlists and Music</h2>
			<?php
				if (isset($_REQUEST["playlist"])){
			?>	
			<h3><a href="<?= basename(__FILE__) ?>">Go back</a></h3><br>
			<?php } ?>
		</div>


		<div id="listarea">
			<ul id="musiclist">
			<?php
			function getFileSize($file) {
				$songSize = filesize($file);
				if($songSize > 1024 * 1024){
					echo round($songSize/(1024 * 1024), 2)." mb";
				}else if($songSize > 1024){
					echo round($songSize/1024, 2)." kb";
				}else {
					echo $songSize." b";
				}
			}

			if (isset($_REQUEST["playlist"])){
				$playlist = $_REQUEST["playlist"];
				$songs = file("songs/".$playlist);
				foreach($songs as $song) {
					$song = glob($song);
				}
				// var_dump($songs);
				foreach ($songs as $song) {
					?>
						<li class="mp3item">
							<a href="<?= $song ?>"><?= basename($song)?></a>
						</li>
					<?php
				}
			}else{
				foreach (glob("songs/*.mp3") as $filename) {
			?>
				<li class="mp3item">
					<a href="<?= $filename ?>"><?= basename($filename)?></a>
					(
						<?= getFileSize($filename) ?>
					)
				</li>
			<?php }?>
			<?php
				foreach (glob("songs/*.txt") as $filename) {
			?>
				<li class="playlistitem">
					<a href="<?= $filename ?>"><?= basename($filename)?></a>
				</li>
			<?php } }?>

				<!-- <li class="mp3item">
					<a href="songs/Be More.mp3">Be More.mp3</a>
					(5438375 b)
				</li>

				<li class="mp3item">
					<a href="songs/Drift Away.mp3">Drift Away.mp3</a>
					(5724612 b)
				</li>

				<li class="mp3item">
					<a href="songs/Hello.mp3">Hello.mp3</a>

					(1871110 b)
				</li>

				<li class="mp3item">
					<a href="songs/Panda Sneeze.mp3">Panda Sneeze.mp3</a>
					(58 b)
				</li>

				<li class="playlistitem">
					<a href="music.php?playlist=mypicks.txt">mypicks.txt</a>
				</li>

				<li class="playlistitem">
					<a href="music.php?playlist=playlist.txt">playlist.txt</a>
				</li> -->
			</ul>
		</div>
	</body>
</html>