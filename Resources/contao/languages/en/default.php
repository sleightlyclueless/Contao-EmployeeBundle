<?php

/**
 * @package   EmployeeBundle
 * @author    (c) IXTENSA GmbH & Co. KG Internet und Webagentur -- Sebastian Zill
 * @license   GNU LGPL 3+
 * @copyright (c) 2020
 */

$GLOBALS['TL_LANG']['CTE']['employee'] = ['Employee'];
$GLOBALS['TL_LANG']['CTE']['location'] = ['Loctation'];

$GLOBALS['TL_LANG']['tl_content']['contactPerson_legend'] = 'Employee Choice';
$GLOBALS['TL_LANG']['tl_content']['contactPerson_settings'] = 'Output settings';

// Employee
$GLOBALS['TL_LANG']['tl_content']['employeeType'] = ['Employee insert mode', 'Choose the Employee you want to display from the given select menue below. Einzeln: Choose a single Employee to display. Individuell: Choose individual Employees to display with the checkbox menue. Abteilungen: Chose the departement(s) whose Employees are supposed to be shown. Alle: Simply display all Employees.'];
$GLOBALS['TL_LANG']['tl_content']['employeeType']['options'] = ['Single', 'Individual', 'Departements', 'Locations', 'All'];
$GLOBALS['TL_LANG']['tl_content']['employeepicker'] = ['Single Employee', 'Choose a single Employee to display from the select - menue below'];
$GLOBALS['TL_LANG']['tl_content']['employeecheckboxes'] = ['Individual Employees', 'Choose individual Employees to display with the checkbox menue below. On output they will be sorted with their given sorting index and alphabeticall order of their last names. Also pay in mind that employees which are not published in the backend will not be shown in the list below'];
$GLOBALS['TL_LANG']['tl_content']['departementcheckboxes'] = ['Departements', 'Choose the Departements whoose Employees are going to be shown with the checkbox menue below. On output they will be sorted with their given sorting index and alphabeticall order of their last names. Also pay in mind that employees which are not published in the backend will not be shown in the list below'];
$GLOBALS['TL_LANG']['tl_content']['locationcheckboxes'] = ['Locations', 'Choose the Locations whoose Employees are going to be shown with the checkbox menue below. On output they will be sorted with their given sorting index and alphabeticall order of their last names. Also pay in mind that employees which are not published in the backend will not be shown in the list below'];
$GLOBALS['TL_LANG']['tl_content']['dontShowDepartements'] = ['HIDE Departements', 'With this checkbox you can choose if the departements are NOT to be shown in the frontend together with the employee or if they should be hidden.'];
$GLOBALS['TL_LANG']['tl_content']['dontShowLocations'] = ['HIDE Locations', 'With this checkbox you can choose if the locations are NOT to be shown in the frontend together with the employee or if they should be hidden.'];
// Location
$GLOBALS['TL_LANG']['tl_content']['location_legend'] = 'Location Choice';
$GLOBALS['TL_LANG']['tl_content']['locationPicker'] = ['Location Selection', 'Choose the location you wish to show in the frontend as a content element.'];

// Globals
$GLOBALS['IX_EB']['MSC']['wildcard_header_employee'] = '### Employee ###';
$GLOBALS['IX_EB']['MSC']['wildcard_header_location'] = '### Location ###';
$GLOBALS['IX_EB']['MSC']['disabled'] = ' (Is not published!)';
$GLOBALS['IX_EB']['MSC']['template_title_individual'] = 'Individual Employees';
$GLOBALS['IX_EB']['MSC']['template_title_departements'] = 'Employees from departement(s): ';
$GLOBALS['IX_EB']['MSC']['template_title_locations'] = 'Employees from location(s): ';
$GLOBALS['IX_EB']['MSC']['template_title_all'] = 'All Employees';
$GLOBALS['IX_EB']['MSC']['template_title_err'] = 'No insert mode was chosen! Please try again!';

// /EmployeeBundle/Helper/HelperClass.php
$GLOBALS['IX_EB']['MSC']['no_departement_consent'] = 'According to the content element settings, departements should not be shown in the frontend';
$GLOBALS['IX_EB']['MSC']['no_departement_defined'] = 'No departement for this Employee defined!';
$GLOBALS['IX_EB']['MSC']['no_departement_for_language'] = 'There are no departement translations for the language %s defined!';
$GLOBALS['IX_EB']['MSC']['no_location_consent'] = 'According to the content element settings, locations should not be shown in the frontend';
$GLOBALS['IX_EB']['MSC']['no_location_defined'] = 'No location for this Employee defined!';
$GLOBALS['IX_EB']['MSC']['no_location_found'] = 'No location was found!';
$GLOBALS['IX_EB']['MSC']['no_language'] = '%s is not defined for the language %s!';
$GLOBALS['IX_EB']['MSC']['checkEmptyArrayEmployee'] = 'No employees where found that can be shown in the frontend for the configured criteria!';
$GLOBALS['IX_EB']['MSC']['checkEmptyArrayLocation'] = 'No locations where found that can be shown in the frontend for the configured criteria!';
