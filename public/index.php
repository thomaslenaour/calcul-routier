<?php require('process.php'); ?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="https://kit.fontawesome.com/4f156a08ed.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="./css/app.css">
        <title>Calcul Routier</title>
    </head>
    
    <body>
        <div class="container mx-auto">
            <div class="text-center">
                <?php
                if (isset($errorMessage)) {
                ?>
                    <p class="bg-red-500 px-3 py-2 text-white rounded-sm mt-5 shadow-sm">
                        <i class="fas fa-times-circle mr-1"></i>
                        <?= $errorMessage ?>
                    </p>
                <?php
                }
                if (isset($successMessage)) {
                ?>
                    <p class="bg-green-500 px-3 py-2 text-white rounded-sm mt-5 shadow-sm">
                        <i class="fas fa-check mr-1"></i>
                        <?= $successMessage ?>
                    </p>
                <?php
                }
                ?>

                <h1 class="mt-10 text-3xl text-teal-500 font-semibold">🚙 Calcul Routier 🚙</h1>
                <p class="mb-10">Entrez une ville de départ et une ville d'arrivée, on se charge du reste... ;)</p>
            </div>

            <form action="./" method="post" class="flex flex-col items-center">
                <div class="flex justify-between">
                    <input type="text" name="departure-city" placeholder="Ville de départ" class="border border-gray-400 p-3 mr-5 rounded-lg" required>
                    <input type="text" name="arrival-city" placeholder="Ville d'arrivée" class="border border-gray-400 p-3 ml-5 rounded-lg" required>
                </div>

                <a href="#" class="mt-5 text-teal-500">
                    <i class="fas fa-plus-circle mr-1"></i>
                    Ajouter une étape
                </a>

                <button type="submit" class="mt-5 px-3 py-2 bg-teal-500 text-white rounded-lg shadow-lg">
                    <i class="fas fa-magic mr-1"></i>
                    Calculer mon trajet
                </button>
            </form>

            <?php
            if ($requestIsSuccess) {
            ?>
                <hr class="my-5">

                <div class="text-center">
                    <p><strong>Ville de départ :</strong> <?= $departureCity ?></p>
                    <p><strong>Ville d'arrivée :</strong> <?= $arrivalCity ?></p>
                    <p><strong>Distance :</strong> <?= $totalDistance ?> km</p>
                    <p><strong>Temps de trajet :</strong> <?= $totalTime ?> min</p>
                </div>
            <?php
            }
            ?>

            <footer class="mt-10">
                <p class="text-xs text-center">&copy; Thomas Le Naour &bull; Bordeaux Ynov Campus</p>
            </footer>
        </div>
    </body>
</html>