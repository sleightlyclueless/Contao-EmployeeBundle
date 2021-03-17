<?php

/**
 * @package   EmployeeBundle
 * @author    (c) IXTENSA GmbH & Co. KG Internet und Webagentur -- Sebastian Zill
 * @license   GNU LGPL 3+
 * @copyright (c) 2020
 */

$GLOBALS['TL_LANG']['CTE']['employee'] = ['Mitarbeiter'];
$GLOBALS['TL_LANG']['CTE']['location'] = ['Standort'];

// Employee
$GLOBALS['TL_LANG']['tl_content']['contactPerson_legend'] = 'Mitarbeiter Auswahl';
$GLOBALS['TL_LANG']['tl_content']['contactPerson_settings'] = 'Ausgabe Einstellungen';
$GLOBALS['TL_LANG']['tl_content']['employeeType'] = ['Mitarbeiter Einfügemodus', 'Wählen Sie aus der gegebenen Liste den Einfügemodus für die Mitarbeiter. Einzeln: Einen einzigen Mitarbeiter zum einfügen auswählen. Individuell: Wählen Sie per Checkboxes die Mitarbeiter, die eingefügt werden sollen aus. Abteilungen: Wählen Sie die Abteilungen aus, zu denen die Mitarbeiter eingefügt werden sollen. Alle: Alle Mitarbeiter ausgeben'];
$GLOBALS['TL_LANG']['tl_content']['employeeType']['options'] = ['Einzeln', 'Individuell', 'Abteilungen', 'Standorte', 'Alle'];
$GLOBALS['TL_LANG']['tl_content']['employeepicker'] = ['Einzelnen Mitarbeiter', 'Wählen Sie aus dem gegebenen Select - Menü den Mitarbeiter, den Sie in das Frontend übernehmen wollen'];
$GLOBALS['TL_LANG']['tl_content']['employeecheckboxes'] = ['Individuelle Mitarbeiter', 'Wählen Sie aus der gegebenen Checkliste die Mitarbeiter, die Sie in das Frontend übernehmen wollen. Die Sortierung erfolgt nach dem vergebenen Sortierindex und sekundär alphabetisch nach dem Nachnamen. Beachten Sie bitte auch, dass ein Mitarbeiter, der in der zentralen Verwaltung ausgeblendet ist oder später ausgeblendet wird, nicht im Frontend angezeigt wird!'];
$GLOBALS['TL_LANG']['tl_content']['departementcheckboxes'] = ['Nach Abteilungen', 'Wählen Sie aus der gegebenen Liste die Abteilung, dessen Mitarbeiter Sie in das Frontend übernehmen wollen. Die Sortierung erfolgt nach dem vergebenen Sortierindex und sekundär alphabetisch nach dem Nachnamen. Beachten Sie bitte auch, dass ein Mitarbeiter, der in der zentralen Verwaltung ausgeblendet ist oder später ausgeblendet wird, nicht im Frontend angezeigt wird!'];
$GLOBALS['TL_LANG']['tl_content']['locationcheckboxes'] = ['Nach Standorten', 'Wählen Sie aus der gegebenen Liste die Standorte, dessen Mitarbeiter Sie in das Frontend übernehmen wollen. Die Sortierung erfolgt nach dem vergebenen Sortierindex und sekundär alphabetisch nach dem Nachnamen. Beachten Sie bitte auch, dass ein Mitarbeiter, der in der zentralen Verwaltung ausgeblendet ist oder später ausgeblendet wird, nicht im Frontend angezeigt wird!'];
$GLOBALS['TL_LANG']['tl_content']['dontShowDepartements'] = ['Abteilungen NICHT ausgeben', 'Mit dieser Checkbox können Sie auswählen, ob im Frontend Template die Abteilungen des Ansprechpartner NICHT ausgegeben werden sollen.'];
$GLOBALS['TL_LANG']['tl_content']['dontShowLocations'] = ['Standorte NICHT ausgeben', 'Mit dieser Checkbox können Sie auswählen, ob im Frontend Template die Standorte des Ansprechpartner NICHT ausgegeben werden sollen.'];
// Location
$GLOBALS['TL_LANG']['tl_content']['location_legend'] = 'Standorte Auswahl';
$GLOBALS['TL_LANG']['tl_content']['locationPicker'] = ['Standort Wählen', 'Wählen Sie aus dem Select Feld den Standort aus, den Sie als Inhaltselement ausgeben möchten.'];

// Globals
$GLOBALS['IX_EB']['MSC']['wildcard_header_employee'] = '### Mitarbeiter ###';
$GLOBALS['IX_EB']['MSC']['wildcard_header_location'] = '### Standort ###';
$GLOBALS['IX_EB']['MSC']['disabled'] = ' (Wurde ausgeblendet!)';
$GLOBALS['IX_EB']['MSC']['template_title_individual'] = 'Individuelle Mitarbeiter';
$GLOBALS['IX_EB']['MSC']['template_title_departements'] = 'Mitarbeiter aus den Abteilung(en): ';
$GLOBALS['IX_EB']['MSC']['template_title_locations'] = 'Mitarbeiter aus den Standort(en): ';
$GLOBALS['IX_EB']['MSC']['template_title_all'] = 'Alle Mitarbeiter';
$GLOBALS['IX_EB']['MSC']['template_title_err'] = 'Es wurde kein Einfügemodus ausgewählt! Bitte versuchen Sie es erneut!';

// /EmployeeBundle/Helper/HelperClass.php
$GLOBALS['IX_EB']['MSC']['no_departement_consent'] = 'Abteilungen sollen laut Inhaltselement Einstellungen nicht ausgegeben werden!';
$GLOBALS['IX_EB']['MSC']['no_departement_defined'] = 'Es wurde keine Abteilung für diesen Mitarbeiter angegeben!';
$GLOBALS['IX_EB']['MSC']['no_departement_for_language'] = 'Es sind keine Übersetzungen für die verknüpften Abteilungen für die Sprache %s angegeben!';
$GLOBALS['IX_EB']['MSC']['no_location_consent'] = 'Standorte sollen laut Inhaltselement Einstellungen nicht ausgegeben werden!';
$GLOBALS['IX_EB']['MSC']['no_location_defined'] = 'Es wurde kein Standort für diesen Mitarbeiter angegeben!';
$GLOBALS['IX_EB']['MSC']['no_location_found'] = 'Es wurde kein Standort gefunden!';
$GLOBALS['IX_EB']['MSC']['no_language'] = '%s ist für die Sprache %s nicht angegeben oder leer – fügen Sie non break spaces ein, um das Feld leer anzuzeigen!';
$GLOBALS['IX_EB']['MSC']['empty'] = 'Das Feld %s ist leer, bzw. wurde nicht ausgefüllt!';
$GLOBALS['IX_EB']['MSC']['checkEmptyArrayEmployee'] = 'Es wurden keine auszugebenden Ansprechpartner für die konfigurierten Kriterien gefunden (z. B. keine Mitarbeiter in der auszugebenden Abteilung zugewiesen)!';
$GLOBALS['IX_EB']['MSC']['checkEmptyArrayLocation'] = 'Es wurden keine auszugebenden Abteilungen für die konfigurierten Kriterien gefunden!';
