<?php

/**
 * @package   EmployeeBundle
 * @author    (c) IXTENSA GmbH & Co. KG Internet und Webagentur -- Sebastian Zill
 * @license   GNU LGPL 3+
 * @copyright (c) 2021
 */

// Back end Formfields
$GLOBALS['BE_FFL']['EmployeeBundleCheckboxes']  = 'ixtensa\\EmployeeBundle\\Widget\\EmployeeBundleCheckboxes';
$GLOBALS['BE_FFL']['EmployeeBundlePicker']  = 'ixtensa\\EmployeeBundle\\Widget\\EmployeeBundlePicker';

// Back end modules
$GLOBALS['BE_MOD']['ixtensa_xtheme']['departement'] = array
(
    'tables'            => array('tl_ixe_departement'),
    'hideInNavigation'  => true,
);

$GLOBALS['BE_MOD']['ixtensa_xtheme']['employee'] = array
(
    'tables'      => array('tl_ixe_employeedata'),
);

$GLOBALS['BE_MOD']['ixtensa_xtheme']['location'] = array
(
    'tables'      => array('tl_ixe_locationgroup', 'tl_ixe_locationdata'),
);

// Content elements
$GLOBALS['TL_CTE']['Ixtensa']['employee'] = 'ixtensa\\EmployeeBundle\\Classes\\Employee';
$GLOBALS['TL_CTE']['Ixtensa']['location'] = 'ixtensa\\EmployeeBundle\\Classes\\Location';

 // Backend CSS
if (TL_MODE == 'BE') {
    $GLOBALS['TL_CSS'][] = 'bundles/ixtensaemployee/css/be.css';
    $GLOBALS['TL_JAVASCRIPT'][] = 'bundles/ixtensaemployee/js/be.js';
}

// Hooks replaceInsertTags
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = ['ixtensa\EmployeeBundle\EventListener\ReplaceInsertTagsListener', 'insertEmployee'];
