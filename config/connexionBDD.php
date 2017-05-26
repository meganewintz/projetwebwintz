<?php
/*
 Connection à notre base de données POSTGRESQL
*/

// Les paramètres de notre base de données.
$dbname = "d3u2huihu9rf9e";
$host = "ec2-46-137-97-169.eu-west-1.compute.amazonaws.com";
$user = "rlkwiopwojajbj";
$password = "3d0fdba9871e93c4d29f627d3b73a00703b490cc5d07941e3e6c3cb656b6071f";

// Tentative de connexion
try
{
  $bdd = new PDO("pgsql:dbname=$dbname;host=$host", $user, $password);
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // PDO::ERRMODE_WARNING
}
catch (Exception $e)
{
  echo "Erreur lors de la connexion à la BDD";
  die('Erreur : ' . $e->getMessage());
}
