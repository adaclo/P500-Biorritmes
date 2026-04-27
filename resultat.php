<?php
include 'biorritme.php';

//Recollim les dades del formulari index.html
//Instanciem un objecte Biorritme
//Li demanem a l'objecte que calculi el biorritme
//Li demanem a l'objecte que enregistri les noves dades a l'arxiu json
//Li demanem a l'objecte que generi i ens retorni una taula HTML

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
        <h1 >Hola Usuari (Aquí el nom)</h1>
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
            
        </div>
    
       
    </section>

        </div>
    </div>
</body>
</html>
