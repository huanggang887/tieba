<?php
/*
Plugin Name: Material Design
Version: 1.1
Plugin URL: http://www.weirdo.ga/
Description: 提供 Google Material Design 风格云签到
Author: weirdo4253
Author Email: weirdo4253@foxmail.com
Author URL: http://www.weirdo.ga/
For: V3.0+
*/

if (!defined('SYSTEM_ROOT')) { die('Insufficient Permissions'); } 

function weirdoga_material() {
	echo '<link rel="stylesheet" href="'.SYSTEM_URL.'plugins/weirdoga_material/css/material.min.css">';
}

addAction('header','weirdoga_material');