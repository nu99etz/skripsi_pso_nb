<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// Route Khusus Data Latih

// Master Data Latih
// $route['data_uji/ajax_select2'] = 'MS_DataUjiController/ajax_select2';

$route['data_uji/ajax'] = 'DataUjiController/ajax';
$route['data_uji'] = 'DataUjiController/index';

$route['data_uji/import_form'] = 'DataUjiController/formImport';
$route['data_uji/import_excel'] = 'DataUjiController/importExcel';

$route['data_uji/form'] = 'DataUjiController/form';

$route['data_uji_nb'] = 'NaiveBayesProcessController/index';
$route['data_uji_nb/test_data'] = 'NaiveBayesProcessController/TestData';
$route['data_uji_nb/ajax/(:any)'] = 'NaiveBayesProcessController/ajax/$1';

$route['data_uji_nb/form_optimasi'] = 'NaiveBayesProcessController/form_optimasi';

$route['data_uji/storeDataUji'] = 'NaiveBayesProcessController/storeDataUji';



// $route['data_uji/store'] = 'MS_DataUjiController/store';
// $route['data_uji/edit/(:any)'] = 'MS_DataUjiController/edit/$1';
// $route['data_uji/update/(:any)'] = 'MS_DataUjiController/update/$1';
// $route['data_uji/destroy/(:any)'] = 'MS_DataUjiController/destroy/$1';
// $route['data_uji/destroyAll'] = 'MS_DataUjiController/destroyAll';
// $route['data_uji/import_excel'] = 'MS_DataUjiController/import_data_uji';
// $route['data_uji/c45/ajax/perbandingan'] = 'C45Controller/getDiffC45';
