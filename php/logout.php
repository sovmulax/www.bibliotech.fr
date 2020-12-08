<?php
session_start();
unset($_SESSION['name']);
unset($_SESSION['auteur']);
header('Location: ../index.html');