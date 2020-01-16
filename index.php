<?php

$curl = curl_init();

// isset($_POST['search']) ? $id = $_POST['search'] : $id = 1;

isset($_GET['page']) ? $id = $_GET['page'] : $id = 1;

curl_setopt_array($curl, array(
	CURLOPT_URL => "https://api.rawg.io/api/games?page=".$id,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_SSL_VERIFYPEER => false,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => array(
		"x-rapidapi-host: rawg-video-games-database.p.rapidapi.com",
		"x-rapidapi-key: 9800e42f43msh99338b74e02a4dbp1dd95ejsn8065d0fcf00a"
	),
));

$response = json_decode(curl_exec($curl),true);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>API Games</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Rubik&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/home.css">
</head>
<body>
    <header class="header-menu">
        <div class="author">
            <p>Made by: Lucas Celestino</p>
        </div>
        <form method="POST" class="form-search">
            <input type="text" name="search" placeholder="Pesquisar por um jogo..." disabled>
            <div class="search-btn">
            <button type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </header>
    <section class="section-games">
        <div class="margin-container padding-container flex-games-itens">
            <?php foreach ($response['results'] as $game):?>
            <div class="game-item">
                <div class="game-img"><img src="<?php echo $game['background_image']; ?>" width="250"></div>
                <div class="game-infos">
                    <p><?php echo $game['name']; ?></p>
                    <p>Released: <?php echo $game['released']; ?></p>
                </div>
                <div class="game-genero"><p><?php echo $game['genres'][0]['name']; ?></p></div>
            </div>
            <?php endforeach;?>
        </div>
    </section>
    <footer class="footer-site">
        <div class="paginacao-div">
            <?php for ($i=1; $i <=20 ; $i++)
            { 
                echo "<a href='?page=$i'>$i</a>";
                $id = $i;
            }
            ?>
        </div>
    </footer>
</body>
</html>