<?php
require('functions.php');

if (isset($_POST['departure-city']) && isset($_POST['arrival-city']) && !empty($_POST['departure-city']) && !empty($_POST['arrival-city'])) {
    if ($_POST['departure-city'] !== $_POST['arrival-city']) {
        $departureCity = secureString($_POST['departure-city']);
        $arrivalCity = secureString($_POST['arrival-city']);
        
        $url = 'https://fr.distance24.org/route.json?stops=' . $departureCity . '|' . $arrivalCity;
        $result = file_get_contents($url);
        $data = json_decode($result, true);

        if ((is_null($data)) || $data['stops'][0]['type'] === 'Invalid' || $data['stops'][1]['type'] === 'Invalid') {
            $errorMessage = 'Merci de saisir un nom de ville valide';
        }
        else {
            $requestIsSuccess = true;
            $successMessage = 'La requête a bien été exécutée';

            $totalKmDistance = $data['distance'];

            $distanceTraveledInNineMinutes = [];
            $timeTraveledInNineMinutes = [];
            for ($i = 1 ; $i < 10 ; $i++) {
                $speed = $i * 10;
                $time = 1 / 60;
                $distance = $speed * $time;
                $timeToTravel = $distance / $speed;

                array_push($distanceTraveledInNineMinutes, $distance);
                array_push($timeTraveledInNineMinutes, $timeToTravel);
            }

            // Distance traveled in 9 minutes and 18 minutes
            $totalDistanceTraveledInNineMinutes = array_sum($distanceTraveledInNineMinutes);
            $distanceTraveledInEighteenMinutes = $totalDistanceTraveledInNineMinutes * 2;

            // Time to travel distance in 9 minutes and 17 minutes
            $totalTimeTraveledInNineMinutes = array_sum($timeTraveledInNineMinutes);
            $timeTraveledInEighteenMinutes = $totalTimeTraveledInNineMinutes * 2;

            // Remaining distance & time to travel it
            $remainingKmDistance = $totalKmDistance - $distanceTraveledInEighteenMinutes;
            $timeToTravelRemainingDistance = $remainingKmDistance / 90;

            // Total time in hours
            $totalTimeInHours = $timeTraveledInEighteenMinutes + $timeToTravelRemainingDistance;

            // Breaks
            $breakTimeLimit = 2;
            $nbBreaks = intval($totalTimeInHours / $breakTimeLimit);

            if ($nbBreaks !== 0) {
                $minutesBreak = $nbBreaks * 15;
                $hoursBreak = $minutesBreak / 60;
                $totalTimeInHours += $hoursBreak;
            }

            // Total time formatted
            $totalTime = convertTime($totalTimeInHours);
        }
    }
    else {
        $errorMessage = 'Merci de saisir deux villes différentes';
    }
}