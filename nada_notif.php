<?php

function notice($type)
{
    if ($type == 1) {
        return "<audio autoplay><source src='" . 'music/success.wav' . "'></audio>";
    } elseif ($type == 0) {
        return "<audio autoplay><source src='" . 'music/kidung.mp3' . "'></audio>";
    }
}
