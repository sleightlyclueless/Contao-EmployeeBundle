<?php

/**
 * @package   EmployeeBundle
 * @author    (c) IXTENSA GmbH & Co. KG Internet und Webagentur -- Sebastian Zill
 * @license   GNU LGPL 3+
 * @copyright (c) 2021
 */

// Employee
$GLOBALS['TL_LANG']['CTE']['employee'] = ['Mitarbeiter'];
$GLOBALS['TL_LANG']['tl_content']['contactPerson_legend'] = 'Mitarbeiter Auswahl';
$GLOBALS['TL_LANG']['tl_content']['contactPerson_settings'] = 'Ausgabe Einstellungen';

$GLOBALS['TL_LANG']['tl_content']['employeeType'] = ['Mitarbeiter Einfügemodus', 'Wählen Sie aus der gegebenen Liste den Einfügemodus für die Mitarbeiter. Einzeln: Einen einzigen Mitarbeiter zum einfügen auswählen. Individuell: Wählen Sie per Checkboxes die Mitarbeiter, die eingefügt werden sollen aus. Abteilungen: Wählen Sie die Abteilungen aus, zu denen die Mitarbeiter eingefügt werden sollen. Alle: Alle Mitarbeiter ausgeben'];
$GLOBALS['TL_LANG']['tl_content']['employeeType']['options'] = ['Einzeln', 'Individuell', 'Abteilungen', 'Standorte', 'Standortgruppe', 'Alle'];
$GLOBALS['TL_LANG']['tl_content']['employeepicker'] = ['Einzelnen Mitarbeiter', 'Wählen Sie aus dem gegebenen Select - Menü den Mitarbeiter, den Sie in das Frontend übernehmen wollen'];
$GLOBALS['TL_LANG']['tl_content']['employeecheckboxes'] = ['Individuelle Mitarbeiter', 'Wählen Sie aus der gegebenen Checkliste die Mitarbeiter, die Sie in das Frontend übernehmen wollen. Die Sortierung erfolgt nach dem vergebenen Sortierindex und sekundär alphabetisch nach dem Nachnamen. Beachten Sie bitte auch, dass ein Mitarbeiter, der in der zentralen Verwaltung ausgeblendet ist oder später ausgeblendet wird, nicht im Frontend angezeigt wird!'];
$GLOBALS['TL_LANG']['tl_content']['departementcheckboxes'] = ['Nach Abteilungen', 'Wählen Sie aus der gegebenen Liste die Abteilung, dessen Mitarbeiter Sie in das Frontend übernehmen wollen. Die Sortierung erfolgt nach dem vergebenen Sortierindex und sekundär alphabetisch nach dem Nachnamen. Beachten Sie bitte auch, dass ein Mitarbeiter, der in der zentralen Verwaltung ausgeblendet ist oder später ausgeblendet wird, nicht im Frontend angezeigt wird!'];
$GLOBALS['TL_LANG']['tl_content']['locationcheckboxes'] = ['Nach Standorten', 'Wählen Sie aus der gegebenen Liste die Standorte, dessen Mitarbeiter Sie in das Frontend übernehmen wollen. Die Sortierung erfolgt nach dem vergebenen Sortierindex und sekundär alphabetisch nach dem Nachnamen. Beachten Sie bitte auch, dass ein Mitarbeiter, der in der zentralen Verwaltung ausgeblendet ist oder später ausgeblendet wird, nicht im Frontend angezeigt wird!'];
$GLOBALS['TL_LANG']['tl_content']['dontShowDepartements'] = ['Abteilungen NICHT ausgeben', 'Mit dieser Checkbox können Sie auswählen, ob im Frontend Template die Abteilungen des Ansprechpartner NICHT ausgegeben werden sollen.'];
$GLOBALS['TL_LANG']['tl_content']['dontShowLocations'] = ['Standorte NICHT ausgeben', 'Mit dieser Checkbox können Sie auswählen, ob im Frontend Template die Standorte des Ansprechpartner NICHT ausgegeben werden sollen.'];

$GLOBALS['IX_EB']['MSC']['template_employeetitle_single'] = 'Einzelner Mitarbeiter';
$GLOBALS['IX_EB']['MSC']['template_employeetitle_individual'] = 'Individuelle Mitarbeiter';
$GLOBALS['IX_EB']['MSC']['template_employeewildcard_individual'] = '### Individuelle Mitarbeiter ###';
$GLOBALS['IX_EB']['MSC']['template_employeetitle_departements'] = 'Mitarbeiter aus den Abteilung(en):';
$GLOBALS['IX_EB']['MSC']['template_employeetitle_locations'] = 'Mitarbeiter aus den Standort(en):';
$GLOBALS['IX_EB']['MSC']['template_employeetitle_locationgroup'] = 'Mitarbeiter aus der Standortgruppe:';
$GLOBALS['IX_EB']['MSC']['template_employeetitle_all'] = 'Alle Mitarbeiter';
$GLOBALS['IX_EB']['MSC']['template_employeewildcard_all'] = '### Alle Mitarbeiter ###';
$GLOBALS['IX_EB']['MSC']['template_employeewildcard_default'] = '### Mitarbeiter ###';

// Location
$GLOBALS['TL_LANG']['CTE']['location'] = ['Standort'];
$GLOBALS['TL_LANG']['tl_content']['location_legend'] = 'Standorte Auswahl';
$GLOBALS['TL_LANG']['tl_content']['locationType'] = ['Standorte Einfügemodus', 'Wählen Sie aus der gegebenen Liste den Einfügemodus für die Standorte. Einzeln: Einen einzigen Standort zum einfügen auswählen. Individuell: Wählen Sie per Checkboxes die Standorte, die eingefügt werden sollen aus. Gruppe: Wählen Sie die Standortgruppe aus, deren Standorte eingefügt werden sollen.'];
$GLOBALS['TL_LANG']['tl_content']['locationType']['options'] = ['Einzeln', 'Individuell', 'Gruppe'];
$GLOBALS['TL_LANG']['tl_content']['locationPicker'] = ['Standort Wählen', 'Wählen Sie aus dem Select Feld den Standort aus, den Sie als Inhaltselement ausgeben möchten.'];
$GLOBALS['TL_LANG']['tl_content']['locationgrouppicker'] = ['Standortgruppe Wählen', 'Wählen Sie aus dem Select Feld die Standortgruppe aus, den Sie als Inhaltselement ausgeben möchten.'];

$GLOBALS['IX_EB']['MSC']['template_locationtitle_single'] = 'Einzelner Standort';
$GLOBALS['IX_EB']['MSC']['template_locationtitle_individual'] = 'Individuelle Standorte';
$GLOBALS['IX_EB']['MSC']['template_locationwildcard_individual'] = '### Individuelle Standorte ###';
$GLOBALS['IX_EB']['MSC']['template_locationtitle_group'] = 'Standortgruppe';
$GLOBALS['IX_EB']['MSC']['template_locationwildcard_default'] = '### Standort ###';

// Globals
$GLOBALS['IX_EB']['MSC']['disabled'] = ' (Wurde ausgeblendet!)';
$GLOBALS['IX_EB']['MSC']['template_title_err'] = 'Es wurde kein Einfügemodus ausgewählt! Bitte versuchen Sie es erneut!';