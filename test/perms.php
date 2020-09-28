<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/Utils.php';

$utils = new Utils();

$perms = [
    'admin',
    'citymun_listing',
    // 'citymun_add',
    // 'citymun_edit',
    'citymun_delete',
    'brgy_listing',
    'brgy_add',
    // 'brgy_edit',
    // 'brgy_delete',
    // 'mapping_citymun',
    // 'user_account'
];
$perms_value = $utils->getPermsValue($perms);
$utils->pre_r($perms_value);


$check = $utils->checkPermission($perms_value, 'user_account');
$utils->pre_r($check ? 'true' : 'false');


$perms_list = $utils->getPermsAsList($perms_value);
$utils->pre_r($perms_list);
