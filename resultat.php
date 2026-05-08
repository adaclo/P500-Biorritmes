<?php
include 'biorritme.php';

$usuari = new Biorritme($_POST["datanaixement"], $_POST["nomusuari"]);

$data = $usuari->calculBiorritme();

$usuari->saveCalculBiorritmeToJson($data);

$taula = $usuari->tableCalculBiorritmeJsonFile();

$today = new DateTime();

$nom = htmlspecialchars($_POST["nomusuari"]);

function nivellText($percentatge) {
    if ($percentatge >= 70) return "Alt";
    if ($percentatge >= 40) return "Mitjà";
    return "Baix";
}

function cardBiorritme($titol, $descripcio, $percentatge, $color) {

    $nivell = nivellText($percentatge);

    return "
    <div class='result-card rounded-3xl p-6'>

        <div class='mb-5 flex items-center justify-between'>

            <div>
                <h2 class='text-xl font-bold text-slate-950'>$titol</h2>

                <p class='mt-1 text-sm text-slate-500'>
                    $descripcio
                </p>
            </div>

            <span class='rounded-full bg-{$color}-100 px-3 py-1 text-sm font-semibold text-{$color}-700'>
                $nivell
            </span>

        </div>

        <div class='mb-3 flex items-end justify-between'>

            <span class='text-4xl font-extrabold text-slate-950'>
                $percentatge%
            </span>

            <span class='text-sm text-slate-500'>
                energia actual
            </span>

        </div>

        <div class='h-3 w-full rounded-full bg-slate-100'>

            <div
                class='h-3 rounded-full bg-{$color}-500'
                style='width: {$percentatge}%'
            ></div>

        </div>

    </div>";
}
?>

<!DOCTYPE html>
<html lang="ca">

<head>

    <meta charset="UTF-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>El teu resultat de biorritme</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="../styles.css">

</head>

<body class="min-h-screen bg-slate-100 text-slate-900">

<main>

    <section class="hero-section relative bg-slate-950 px-6 py-12 text-white lg:px-8">

        <div class="absolute inset-0"></div>

        <div class="hero-overlay absolute inset-0"></div>

        <div class="relative mx-auto max-w-7xl">

            <a
                href="index.html"
                class="glass-card mb-8 inline-flex items-center rounded-full px-4 py-2 text-sm font-medium text-white transition hover:bg-white/20"
            >
                ← Torna enrere
            </a>

            <div class="grid gap-8 lg:grid-cols-[1.4fr_0.6fr] lg:items-end">

                <div>

                    <p class="mb-3 text-sm font-semibold uppercase tracking-[0.3em] text-blue-200">
                        Resultat del biorritme
                    </p>

                    <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl">
                        Hola <?php echo $nom; ?>
                    </h1>

                    <p class="mt-4 max-w-2xl text-lg text-slate-300">
                        Aquest és el teu estat energètic calculat per avui segons els tres cicles principals.
                    </p>

                </div>

                <div class="glass-card rounded-3xl p-6">

                    <p class="text-sm text-slate-300">
                        Data actual
                    </p>

                    <p class="mt-2 text-3xl font-bold">
                        <?php echo $today->format('d/m/Y'); ?>
                    </p>

                </div>

            </div>

        </div>

    </section>

    <section class="cards-wrapper mx-auto max-w-7xl px-6 pb-12 lg:px-8">

        <div class="grid gap-6 md:grid-cols-3">

            <?php echo cardBiorritme('Biorritme físic', 'El teu nivell energètic corporal avui.', $data['físic']['percentatge'], 'blue'); ?>

            <?php echo cardBiorritme('Biorritme emotiu', 'Com està la teva energia emocional avui.', $data['emotiu']['percentatge'], 'pink'); ?>

            <?php echo cardBiorritme('Biorritme intel·lectual', 'La teva capacitat mental actual.', $data['intelectual']['percentatge'], 'purple'); ?>

        </div>

    </section>

    <section class="mx-auto max-w-7xl px-6 pb-16 lg:px-8">

        <div class="history-card rounded-3xl p-6 lg:p-8">

            <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">

                <div>

                    <p class="text-sm font-semibold uppercase tracking-widest text-blue-600">
                        Històric
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-slate-950">
                        Històric de càlculs
                    </h2>

                    <p class="mt-2 text-slate-600">
                        Últims registres guardats al fitxer JSON.
                    </p>

                </div>

                <span class="inline-flex w-fit items-center rounded-full bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700">
                    📊 Dades registrades
                </span>

            </div>

            <div class="table-modern overflow-x-auto">
                <?php echo $taula; ?>
            </div>

        </div>

    </section>

</main>

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

</body>
</html>