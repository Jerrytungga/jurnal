<?php

function notice($type)
{
    if ($type == 1) {
        return "<audio autoplay><source src='" . 'music/success.wav' . "'></audio>";
    } elseif ($type == 0) {
        return "<audio autoplay><source src='" . 'music/error.wav' . "'></audio>";
    } elseif ($type == 2) {
        return "<audio autoplay><source src='" . 'music/beep.mp3' . "'></audio>";
    } elseif ($type == 3) {
        return "<audio autoplay><source src='" . 'music/late_2.mp3' . "'></audio>";
    }
}
