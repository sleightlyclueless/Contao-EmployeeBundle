<?php

/**
 * @package   EmployeeBundle
 * @author    (c) IXTENSA GmbH & Co. KG Internet und Webagentur -- Sebastian Zill
 * @license   GNU LGPL 3+
 * @copyright (c) 2020
 */

namespace ixtensa\EmployeeBundle\Classes;

use ixtensa\EmployeeBundle\Helper\HelperClass;

class Employee extends \ContentElement
{
    protected $strTemplate = 'ce_employee';

    public function generate()
	{
        if (TL_MODE == 'BE')
		{
            $this->strTemplate          = 'be_wildcard';
            $this->Template             = new \BackendTemplate($this->strTemplate);
            $this->Template->wildcard   = $GLOBALS['IX_EB']['MSC']['wildcard_header_employee'];

            switch ($this->employeeType)
    		{
    			case 'Einzeln':
                case 'Single':
                    $employeeId = HelperClass::getIdsByDelimiter($this->employeepicker, '[', ']');
                    $res = HelperClass::getEmployeeDataByIds($employeeId);
                    $publishedStatus = '';
                    if ($res[0]['published'] != 1) {
                        $publishedStatus =  $GLOBALS['IX_EB']['MSC']['disabled'];
                    }
                    $this->Template->title = $res[0]['name'] . ' ' . $res[0]['firstname'] .$publishedStatus;
                    break;
                case 'Individuell':
                case 'Individual':
                    $this->Template->title = $GLOBALS['IX_EB']['MSC']['template_title_individual'];
                    break;
                case 'Abteilungen':
                case 'Departements':
                    $departementsIDs = HelperClass::getIdsByDelimiter($this->departementcheckboxes, '"', '"');
                    $departementsString = HelperClass::getStringFromIds($departementsIDs, 'departements');
                    $this->Template->title = $GLOBALS['IX_EB']['MSC']['template_title_departements'].$departementsString;
    				break;
                case 'Standorte':
                case 'Locations':
                    $locationIDs = HelperClass::getIdsByDelimiter($this->locationcheckboxes, '"', '"');
                    $locationsString = HelperClass::getStringFromIds($locationIDs, 'locations');
                    $this->Template->title = $GLOBALS['IX_EB']['MSC']['template_title_locations'].$locationsString;
    				break;
                case 'Alle':
                case 'All':
                    $this->Template->title = $GLOBALS['IX_EB']['MSC']['template_title_all'];
    				break;
    			default:
                    $this->Template->title = $GLOBALS['IX_EB']['MSC']['template_title_err'];
    				break;
    		}
            return $this->Template->parse();
        }
        return parent::generate();
    }


    protected function compile()
    {
        switch ($this->employeeType)
        {
            case 'Einzeln':
            case 'Single':
                $employeeId = HelperClass::getIdsByDelimiter($this->employeepicker, '[', ']');
                $res = HelperClass::getEmployeeDataByIds($employeeId);
                $arrData = HelperClass::prepareArrayDataForEmployeeTemplate($this->employeeType, $this->dontShowDepartements, $this->dontShowLocations, $res, $departementsIDs, $locationIDs, $this->Template);
                break;
            case 'Individuell':
            case 'Individual':
                $employeeIds = HelperClass::getIdsByDelimiter($this->employeecheckboxes, '[', ']');
                $res = HelperClass::getEmployeeDataByIds($employeeIds);
                $arrData = HelperClass::prepareArrayDataForEmployeeTemplate($this->employeeType, $this->dontShowDepartements, $this->dontShowLocations, $res, $departementsIDs, $locationIDs, $this->Template);
                break;
            case 'Abteilungen':
            case 'Departements':
                $departementsIDs = HelperClass::getIdsByDelimiter($this->departementcheckboxes, '"', '"');
                $res = HelperClass::getAllEmployeeData();
                $arrData = HelperClass::prepareArrayDataForEmployeeTemplate($this->employeeType, $this->dontShowDepartements, $this->dontShowLocations, $res, $departementsIDs, $locationIDs, $this->Template);
                break;
            case 'Standorte':
            case 'Locations':
                $locationIDs = HelperClass::getIdsByDelimiter($this->locationcheckboxes, '"', '"');
                $res = HelperClass::getAllEmployeeData();
                $arrData = HelperClass::prepareArrayDataForEmployeeTemplate($this->employeeType, $this->dontShowDepartements, $this->dontShowLocations, $res, $departementsIDs, $locationIDs, $this->Template);
                break;
            case 'Alle':
            case 'All':
                $employeeIds = false;
                $res = HelperClass::getAllEmployeeData();
                $arrData = HelperClass::prepareArrayDataForEmployeeTemplate($this->employeeType, $this->dontShowDepartements, $this->dontShowLocations, $res, $departementsIDs, $locationIDs, $this->Template);
                break;
            default:
                $arrData = [];
                break;
        }
        $this->Template->arrAnsprechData = $arrData;
    }
}
