<?php

session_start();

function isLoggedIn(): bool
{
    return isset($_SESSION['user']);
}

function requireLogin(): void
{
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

function currentUser(): string
{
    return $_SESSION['user'] ?? '';
}

