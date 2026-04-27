<?php
include 'biorritme.php';

$usuari = new Biorritme($_POST["datanaixement"], $_POST["nomusuari"]);
$data = $usuari->calculBiorritme();
$usuari->saveCalculBiorritmeToJson($data);
$taula = $usuari->tableCalculBiorritmeJsonFile();

$today = new DateTime();

?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--<script src="https://cdn.tailwindcss.com"></script>-->
    <title>El teu resultat de biorritme</title>
</head>
<body >
    <div>    
        <h2>Resultat del biorritme</h2>
        <h1 >Hola <?php echo $_POST["nomusuari"]; ?></h1>
        <p >Data actual: <?php echo $today->format('d/m/Y'); ?></p>
        <a href="index.html" >Torna enrere</a>
    </div>

           
    <div>
        <h2 >Biorritme físic</h2>
        <p >El teu nivell energètic corporal avui.</p>
    </div>
    <div>
        <h2 >Biorritme emotiu</h2>
        <p >Com està la teva energia emocional avui.</p>
    </div>
    <div >
        <h2>Biorritme intel·lectual</h2>
        <p >La teva capacitat mental actual.</p>
    </div>
   

    <section>
      
        <div>
            <h2 >Històric de càlculs</h2>
            
        </div>
         <div>
            <p> TAULA DE DADES. Li demanem a l'objecte que ens mostri la taula de dades</p>
            <?php echo $taula; ?>
        </div>
    
       
    </section>

        </div>
    </div>
</body>
</html>
