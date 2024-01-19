<!-- error404.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404 - Not Found</title>
    <style>
        body {
            background-color: #D9D9D9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            background-color: #4B4A4A;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }
        h1, p {
            margin: 25px;
        }
        a {
            color: #D9D9D9;
        }
        footer {
            background-color: #333;
            color: #fff;
            display: flex;
            justify-content: center;
            text-align: center;
            align-items: center;
            padding: 20px 0;
            margin-top: auto;
        }
        #contacte, #enllacos {
            margin: 10px;
            margin-right: 80px;
            margin-left: 80px;
            margin-bottom: auto
        }
        #contacte, #enllacos {
            display: flex;
            flex-direction: column;
        }
        #contacte h2, #enllacos h2 {
            border-bottom: 1px solid #fff;
            padding-bottom: 5px;
            margin: 0;
        }
        #contactes {
            display: flex;
        }
    </style>
</head>
<body>
    <header>
        <h1>ERROR 404 - Not Found</h1>
    </header>
    <h1>Error 404</h1>
    <p>La página que buscas no existe.</p>
    <footer>
        <div id="contacte">
            <h2>Contactos</h2>
            <div id="contactes">
                <div id="contacte1">
                    <h4>Marcelo González</h4>
                    <p>
                        Teléfon: <a href="tel:+661794022">661-794-022</a><br>
                        Gmail: <a href="mailto:marcelogr2004@gmail.com">marcelogr2004@gmail.com</a><br>
                        Instagram: <a href="https://www.instagram.com/mgonnzalezz" target="_blank">@mgonnzalezz</a>
                    </p>
                </div>
                <div id="contacte2">
                    <h4>Martí Miranda</h4>
                    <p>
                        Teléfon: <a href="tel:+123456789">123-456-789</a><br>
                        Gmail: <a href="mailto:info@example.com">info@example.com</a><br>
                        Instagram: <a href="https://www.instagram.com/tuinstagram" target="_blank">@tuinstagram</a>
                    </p>
                </div>
            </div>
        </div>
        
        <div id="enllacos">
            <h2>Enlaces</h2>
            <p>
                Instituto: <a href="https://www.iesesteveterradas.cat/" target="_blank">Institut Esteve Terrades</a><br>
                GitHub: <a href="https://github.com/Marcelogr04/P2_Vota.git" target="_blank">GitHub</a>
            </p>
        </div>
    </footer>
</body>
</html>