<?php
session_start();
require_once __DIR__ . '/db.php';

function isLoggedIn() {
    return !empty($_SESSION['user_id']);
}

function isAdmin() {
    return !empty($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function redirectIfNotLoggedIn() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

function redirectIfNotAdmin() {
    if (!isAdmin()) {
        header('Location: ../index.php');
        exit;
    }
}

function sanitize($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
