<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>


</body>
<?php
try {
    $dsn = "mysql:host=localhost;dbname=p2_votos";
    $pdo = new PDO($dsn, 'marti', 'M*12_EGbb56');
    $query = $pdo->prepare("select name from countries;");
    $query->execute();
    $row = $query->fetch();
    $correct = false;
    $arrayCountries = [];
    while ( $row ) {
        array_push($arrayCountries,$row['name']);
        $row = $query->fetch();
        $correct=true;
    }
    if(!$correct){
        echo "incorrecto";
    }
    } catch (PDOException $e){
        echo $e->getMessage();
    }
    echo '<script>var countries_php = ' . json_encode($arrayCountries) . ';</script>';
    if(isset($_POST['user'])){
        $user = $_POST['user'];
        $pwd = $_POST['pwd'];
        $mail = $_POST['email'];
        $phone = $_POST['tel'];
        $country = $_POST['country'];
        $city = $_POST['city'];
        $code = $_POST['postal'];

        try {

            $query = $pdo->prepare("SELECT name FROM users WHERE email LIKE :mail OR phone = :phone");
            
            $query->bindParam(':mail', $mail, PDO::PARAM_STR);
            $query->bindParam(':phone', $phone, PDO::PARAM_STR);
            
            $query->execute();
            
            $row = $query->fetch();
            
            if ($row) {
                echo "Ya existe un usuario con ese email o número de teléfono";
            } else {
                //echo "Cuenta creada con exito";
                try {
                    $query = $pdo->prepare("INSERT INTO users (name, email, password, phone, country_name, city, postal_code)
                            VALUES (:user, :mail, SHA2(:pwd, 512), :phone, :country, :city, :code)");
    
                            $query->bindParam(':user', $user, PDO::PARAM_STR);
                            $query->bindParam(':mail', $mail, PDO::PARAM_STR);
                            $query->bindParam(':pwd', $pwd, PDO::PARAM_STR);
                            $query->bindParam(':phone', $phone, PDO::PARAM_STR);
                            $query->bindParam(':country', $country, PDO::PARAM_STR);
                            $query->bindParam(':city', $city, PDO::PARAM_STR);
                            $query->bindParam(':code', $code, PDO::PARAM_INT);
                            
                            $query->execute();

                            $correct = ($query->rowCount() > 0);

                            if (!$correct) {
                                //echo "incorrecto";
                            } else {
                                //echo "correcto";
                            }
                    } catch (PDOException $e){
                        echo $e->getMessage();
                    }
            }
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        
            
    }
?>
</html>