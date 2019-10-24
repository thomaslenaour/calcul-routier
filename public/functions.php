<?php
function convertTime($timeInHour) {
    return sprintf('%02dh%02d', (int) $timeInHour, fmod($timeInHour, 1) * 60);
}

function secureString($city) {
    return htmlspecialchars(trim(ucfirst(strtolower(str_replace(' ', '-', $city)))));
}