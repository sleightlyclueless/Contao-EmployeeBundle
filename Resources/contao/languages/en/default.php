<?php

/**
 * @package   EmployeeBundle
 * @author    (c) IXTENSA GmbH & Co. KG Internet und Webagentur -- Sebastian Zill
 * @license   GNU LGPL 3+
 * @copyright (c) 2021
 */

// Employee
$GLOBALS['TL_LANG']['CTE']['employee'] = ['Employee'];
$GLOBALS['TL_LANG']['tl_content']['contactPerson_legend'] = 'Employee Choice';
$GLOBALS['TL_LANG']['tl_content']['contactPerson_settings'] = 'Output settings';

$GLOBALS['TL_LANG']['tl_content']['employeeType'] = ['Employee insert mode', 'Choose the Employee you want to display from the given select menue below. Einzeln: Choose a single Employee to display. Individuell: Choose individual Employees to display with the checkbox menue. Abteilungen: Chose the departement(s) whose Employees are supposed to be shown. Alle: Simply display all Employees.'];
$GLOBALS['TL_LANG']['tl_content']['employeeType']['options'] = ['Single', 'Individual', 'Departements', 'Locations', 'Location Group', 'All'];
$GLOBALS['TL_LANG']['tl_content']['employeepicker'] = ['Single Employee', 'Choose a single Employee to display from the select - menue below'];
$GLOBALS['TL_LANG']['tl_content']['employeecheckboxes'] = ['Individual Employees', 'Choose individual Employees to display with the checkbox menue below. On output they will be sorted with their given sorting index and alphabeticall order of their last names. Also pay in mind that employees which are not published in the backend will not be shown in the list below'];
$GLOBALS['TL_LANG']['tl_content']['departementcheckboxes'] = ['Departements', 'Choose the Departements whoose Employees are going to be shown with the checkbox menue below. On output they will be sorted with their given sorting index and alphabeticall order of their last names. Also pay in mind that employees which are not published in the backend will not be shown in the list below'];
$GLOBALS['TL_LANG']['tl_content']['locationcheckboxes'] = ['Locations', 'Choose the Locations whoose Employees are going to be shown with the checkbox menue below. On output they will be sorted with their given sorting index and alphabeticall order of their last names. Also pay in mind that employees which are not published in the backend will not be shown in the list below'];
$GLOBALS['TL_LANG']['tl_content']['dontShowDepartements'] = ['HIDE Departements', 'With this checkbox you can choose if the departements are NOT to be shown in the frontend together with the employee or if they should be hidden.'];
$GLOBALS['TL_LANG']['tl_content']['dontShowLocations'] = ['HIDE Locations', 'With this checkbox you can choose if the locations are NOT to be shown in the frontend together with the employee or if they should be hidden.'];

$GLOBALS['IX_EB']['MSC']['template_employeetitle_single'] = 'Single Employees';
$GLOBALS['IX_EB']['MSC']['template_employeetitle_individual'] = 'Individual Employees';
$GLOBALS['IX_EB']['MSC']['template_employeewildcard_individual'] = '### Individual Employees ###';
$GLOBALS['IX_EB']['MSC']['template_employeetitle_departements'] = 'Employees from departement(s):';
$GLOBALS['IX_EB']['MSC']['template_employeetitle_locations'] = 'Employees from location(s):';
$GLOBALS['IX_EB']['MSC']['template_employeetitle_locationgroup'] = 'Employees from locationgroup:';
$GLOBALS['IX_EB']['MSC']['template_employeetitle_all'] = 'All Employees';
$GLOBALS['IX_EB']['MSC']['template_employeewildcard_all'] = '### All Employees ###';
$GLOBALS['IX_EB']['MSC']['template_employeewildcard_default'] = '### Employee ###';

// Location
$GLOBALS['TL_LANG']['CTE']['location'] = ['Loctation'];
$GLOBALS['TL_LANG']['tl_content']['location_legend'] = 'Location Choice';
$GLOBALS['TL_LANG']['tl_content']['locationType'] = ['Location insert mode', 'Choose an insertmode for the locations. Single: Select a single location to output on frontend. Individual: Select a multiple locations from checkboxes to output. Group: Select a locationgroup of which the locations will be output.'];
$GLOBALS['TL_LANG']['tl_content']['locationType']['options'] = ['Single', 'Individual', 'Group'];
$GLOBALS['TL_LANG']['tl_content']['locationPicker'] = ['Location selection', 'Choose the location you wish to show in the frontend as a content element.'];
$GLOBALS['TL_LANG']['tl_content']['locationgrouppicker'] = ['Locationgroup selection', 'Choose the locationgroup of which you wish to show the locations in the frontend as a content element.'];

$GLOBALS['IX_EB']['MSC']['template_locationtitle_single'] = 'Single Location';
$GLOBALS['IX_EB']['MSC']['template_locationtitle_individual'] = 'Individual Locations';
$GLOBALS['IX_EB']['MSC']['template_locationwildcard_individual'] = '### Individual Locations ###';
$GLOBALS['IX_EB']['MSC']['template_locationtitle_group'] = 'Location Group';
$GLOBALS['IX_EB']['MSC']['template_locationwildcard_default'] = '### Location ###';

// Globals
$GLOBALS['IX_EB']['MSC']['disabled'] = ' (Is not published!)';
$GLOBALS['IX_EB']['MSC']['template_title_err'] = 'No insert mode was chosen! Please try again!';