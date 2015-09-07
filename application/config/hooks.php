<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/


// $hook['post_controller_constructor'][] = array(
//                                 'class'    => 'My_Track',
//                                 'function' => 'index',
//                                 'filename' => 'My_Track.php',
//                                 'filepath' => 'hooks',
//                                 'params'   => array()
//                                 );
$hook['post_controller_constructor'][] = array(
                                'class'    => 'My_XTcl',
                                'function' => 'xtcl',
                                'filename' => 'My_XTcl.php',
                                'filepath' => 'hooks',
                                'params'   => array()
                                );

// $hook['pre_system'] = array(
//                                 'class'    => 'My_Domain',
//                                 'function' => 'index',
//                                 'filename' => 'My_Domain.php',
//                                 'filepath' => 'hooks',
//                                 'params'   => array()
//                                 );
