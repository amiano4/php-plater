<?php 

// base 
define('PHP_BASE_URL', (
  (
    (
      !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || 
      $_SERVER['SERVER_PORT'] == 443 || 
      $_SERVER['HTTP_HOST'] === 'www.tollfastapp.com'
    ) ? 'https://' : 'http://'
  ) . $_SERVER['HTTP_HOST']
);