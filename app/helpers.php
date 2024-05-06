<?php

function getInitials($fullName) {
    $parts = explode(' ', $fullName);
    $initials = '';
    foreach ($parts as $part) {
        $initials .= substr($part, 0, 1);
    }
    return $initials;
}
