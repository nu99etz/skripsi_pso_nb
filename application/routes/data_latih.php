<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// Route Khusus Data Latih

// Master Data Latih
// $route['data_latih/ajax_select2'] = 'MS_DataLatihController/ajax_select2';
$route['data_latih/ajax'] = 'DataLatihController/ajax';
$route['data_latih'] = 'DataLatihController/index';
// $route['data_latih/c45/ajax'] = 'C45Controller/hitungC45';
$route['data_latih/import_form'] = 'DataLatihController/formImport';
$route['data_latih/import_excel'] = 'DataLatihController/importExcel';

$route['data_latih_optimasi/ajax'] = 'DataLatihOptimasiController/ajax';
$route['data_latih_optimasi'] = 'DataLatihOptimasiController/index';
$route['data_latih_optimasi/form_optimization'] = 'DataLatihOptimasiController/formOptimization';
$route['data_latih_optimasi/optimizeProcess'] = 'DataLatihOptimasiController/optimizeProcess';

$route['data_latih_optimasi/attribute_optimasi/ajax'] = 'DataLatihOptimasiController/attribute_optimize_ajax';
