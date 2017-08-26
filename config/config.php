<?php
/**
 * @author Glenn Inizan <glenninizan@gmail.com>
 * 
 * File for choose the config file
 */

// Name of the config file
$config_name = 'default_config';

include_with_check('../config/' . $config_name . '.php');