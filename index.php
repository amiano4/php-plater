<?php 

include "bootstrap/core/EnvParser.php";

$env = new EnvParser();

var_dump($env->dns_name);