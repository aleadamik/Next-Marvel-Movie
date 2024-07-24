<?php 
// Llamada a la API usando cURL
const API_URL = "https://www.whenisthenextmcufilm.com/api";
$ch = curl_init(API_URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Deshabilitar verificación SSL solo para pruebas
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Deshabilitar verificación SSL solo para pruebas
$result = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Error al llamar a la API: ' . curl_error($ch);
    $data = null;
} else {
    $data = json_decode($result, true);
}

curl_close($ch);
?>

<!DOCTYPE html>
<html lang="es">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="¿Cuál es la próxima película de Marvel?">
    <title>Next Marvel Movie</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css"/>
    <link rel="icon" href="./favicon.ico" type="image/png">
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
        }
        
        body {
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }

        h2 {
            text-align: center;
            color: #f39c12;
        }

        section {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        img {
            border-radius: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 400px;
        }

        hgroup {
            text-align: center;
        }

        h3 {
            font-size: 1.5em;
            color: #e74c3c;
        }

        p {
            font-size: 1.2em;
            color: #bdc3c7;
        }

        footer {
            background-color: #333;
            color: #ccc;
            text-align: center;
            width: 100%;            
        }
    </style>
</head>
<body>
<main>
    <h2>¿Cuál es la próxima película de Marvel?</h2>

    <?php if ($data && isset($data["poster_url"], $data["title"], $data["days_until"], $data["release_date"], $data["following_production"]["title"])): ?>
        <section>
            <img src="<?= htmlspecialchars($data["poster_url"]); ?>" alt="Poster de <?= htmlspecialchars($data["title"]); ?>" />
        </section>

        <hgroup>
            <h3><?= htmlspecialchars($data["title"]); ?> se estrena en <?= htmlspecialchars($data["days_until"]); ?> días.</h3>
            <p>Fecha de estreno: <?= htmlspecialchars($data["release_date"]); ?></p>
            <p>La siguiente es: <?= htmlspecialchars($data["following_production"]["title"]); ?></p>
        </hgroup>
    <?php else: ?>
        <p>No se pudieron obtener los datos de la API.</p>
    <?php endif; ?>
</main>
<footer>
    2024 - Desarrollado por Alejandro Adamik
</footer>
</body>
</html>