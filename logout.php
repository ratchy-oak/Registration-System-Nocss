<?php
require_once 'config/db.php';

session_destroy();

header('location: login.php');
exit();