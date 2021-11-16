<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// Route Khusus Standar Antropometri

// Master Standar Antropometri
$route['ms_standar/ajax_standar_bb/(:any)'] = 'MS_StandarAntropemetriController/ajax_standar_bb/$1';
$route['ms_standar/ajax_standar_tb'] = 'MS_StandarAntropemetriController/ajax_standar_tb';
$route['ms_standar/standar_bb1'] = 'MS_StandarAntropemetriController/index_standar_bb1';
$route['ms_standar/standar_bb2'] = 'MS_StandarAntropemetriController/index_standar_bb2';
$route['ms_standar/standar_tb'] = 'MS_StandarAntropemetriController/index_standar_tb';
$route['ms_standar/import_excel_bb/(:any)'] = 'MS_StandarAntropemetriController/import_standar_bb/$1';
$route['ms_standar/import_excel_tb'] = 'MS_StandarAntropemetriController/import_standar_tb';