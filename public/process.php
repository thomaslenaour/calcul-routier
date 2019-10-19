<?php
if (isset($_POST['departure-city']) && isset($_POST['arrival-city']) && !empty($_POST['departure-city']) && !empty($_POST['arrival-city'])) {
    $departureCity = htmlspecialchars(trim(ucfirst(strtolower($_POST['departure-city']))));
    $arrivalCity = htmlspecialchars(trim(ucfirst(strtolower($_POST['arrival-city']))));
    
    $url = 'https://fr.distance24.org/route.json?stops=' . $departureCity . '|' . $arrivalCity;
    $result = file_get_contents($url);
    $data = json_decode($result, true);

    if ((is_null($data)) || $data['stops'][0]['type'] === 'Invalid' || $data['stops'][1]['type'] === 'Invalid') {
        $errorMessage = 'Merci de saisir un nom de ville valide';
    }
    else {
        $requestIsSuccess = true;
        $successMessage = 'La requête a bien été exécutée';

        $totalDistance = $data['distance'];

        $distanceTraveled = [];
        for ($i = 1 ; $i < 10 ; $i++) {
            array_push($distanceTraveled, ($i * 10) * (1 / 60));
        }

        $distanceTraveledInNineMinutes = array_sum($distanceTraveled);
        $distanceTraveledInEighteenMinutes = $distanceTraveledInNineMinutes * 2;
        $remainingDistance = $totalDistance - $distanceTraveledInEighteenMinutes;

        $totalTimeInMinutes = (18 + (($remainingDistance / 90) * 60)) / 60;
        $whole = floor($totalTimeInMinutes);
        $fraction = round($totalTimeInMinutes - $whole, 2);

        $totalTime = $whole . 'h' . $fraction;
    }
}