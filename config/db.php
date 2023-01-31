<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'FarmerMarket');

$conn->set_charset('UTF-8');
