<?php
session_start();
// Define ROOT, APPLICATION_ENV, APPLICATION_ROOT ?

require_once __DIR__ . '/../library/Jeyroik.php';

Jeyroik::compile(true);
Jeyroik::run(__DIR__ . '/../');
