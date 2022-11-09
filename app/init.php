<?php
require_once 'config/config.php';
require_once FUNCURL;
require_once 'core/app.php';
require_once 'core/controller.php';
// URL Kosong
if(!isset($_GET['url'])) {
  $_GET['url'] = "";
}