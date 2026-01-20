<?php
// Test base_url function
function base_url($path = '') {
    if (empty($path)) {
        return '/Event-system/';
    }
    return '/Event-system/' . ltrim($path, '/');
}

// Test
echo "base_url('') = " . base_url('') . "<br>";
echo "base_url('events') = " . base_url('events') . "<br>";
echo "base_url('event/1') = " . base_url('event/1') . "<br>";
echo "base_url('/event/1') = " . base_url('/event/1') . "<br>";
