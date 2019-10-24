<?php
function convertTime($timeInHour) {
    return sprintf('%02d:%02d', (int) $timeInHour, fmod($timeInHour, 1) * 60);
}