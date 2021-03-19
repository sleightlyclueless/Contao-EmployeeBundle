<?php

/**
 * @package   EmployeeBundle
 * @author    (c) IXTENSA GmbH & Co. KG Internet und Webagentur -- Sebastian Zill
 * @license   GNU LGPL 3+
 * @copyright (c) 2021
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
            $this->strTemplate = 'be_wildcard';
            $this->Template = new \BackendTemplate($this->strTemplate);

            switch ($this->employeeType)
    		{
    			case 'Einzeln':
                case 'Single':
                    $this->Template->title = $GLOBALS['IX_EB']['MSC']['template_employeetitle_single'];
                    // Backward compatibility for old picker versions with arrays attached to them START
                    // Replaced "[ID] Name" with just "Name" in Backend and ID automatically being extracted to picker by contao. See dca Foreign key and CONCAT
                    if (!is_numeric($this->employeepicker)) {
                        $employeeId = HelperClass::getIdsByDelimiter($this->employeepicker, '[', ']');
                        $res = HelperClass::getEmployeeDataByIds($employeeId);
                    } 
                    // Backward compatibility for old picker versions with arrays attached to them END
                    else {
                        $res = HelperClass::getEmployeeDataByIds($this->employeepicker);
                    }
                    if ($res[0]['published'] != 1) {
                        $this->Template->wildcard = $GLOBALS['IX_EB']['MSC']['disabled'];
                    } else {
                        $this->Template->wildcard = $res[0]['name'] . ' ' . $res[0]['firstname'];
                    }
                    break;
                case 'Individuell':
                case 'Individual':
                    $this->Template->title = $GLOBALS['IX_EB']['MSC']['template_employeetitle_individual'];
                    $this->Template->wildcard = $GLOBALS['IX_EB']['MSC']['template_employeewildcard_individual'];
                    break;
                case 'Abteilungen':
                case 'Departements':
                    $this->Template->title = $GLOBALS['IX_EB']['MSC']['template_employeetitle_departements'];
                    $departementsIDs = HelperClass::getIdsByDelimiter($this->departementcheckboxes, '"', '"');
                    $departementsString = HelperClass::getStringFromIds($departementsIDs, 'departements');
                    $this->Template->wildcard = $departementsString;
    				break;
                case 'Standorte':
                case 'Locations':
                    $this->Template->title = $GLOBALS['IX_EB']['MSC']['template_employeetitle_locations'];
                    $locationIDs = HelperClass::getIdsByDelimiter($this->locationcheckboxes, '"', '"');
                    $locationsString = HelperClass::getStringFromIds($locationIDs, 'locations');
                    $this->Template->wildcard = $locationsString;
    				break;
                case 'Standortgruppe':
                case 'Location Group':
                    $this->Template->title = $GLOBALS['IX_EB']['MSC']['template_employeetitle_locationgroup'];
                    $res = HelperClass::getLocationGroupById($this->locationgrouppicker);
                    $this->Template->wildcard = $res[0]['name'];
                    break;
                case 'Alle':
                case 'All':
                    $this->Template->title = $GLOBALS['IX_EB']['MSC']['template_employeetitle_all'];
                    $this->Template->wildcard = $GLOBALS['IX_EB']['MSC']['template_employeewildcard_all'];
    				break;
    			default:
                    $this->Template->title = $GLOBALS['IX_EB']['MSC']['template_employeetitle_err'];
                    $this->Template->wildcard = $GLOBALS['IX_EB']['MSC']['template_employeewildcard_default'];
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
                // Backward compatibility for old picker versions with arrays attached to them START
                if (!is_numeric($this->employeepicker)) {
                    $employeeId = HelperClass::getIdsByDelimiter($this->employeepicker, '[', ']');
                    $res = HelperClass::getEmployeeDataByIds($employeeId);
                } 
                // Backward compatibility for old picker versions with arrays attached to them END
                else {
                    $res = HelperClass::getEmployeeDataByIds($this->employeepicker);
                }
                $arrData = HelperClass::prepareArrayDataForEmployeeTemplate($this->employeeType, $this->dontShowDepartements, $this->dontShowLocations, $res, $departementsIDs, $locationIDs, $locationgroupID, $this->Template);
                break;
            case 'Individuell':
            case 'Individual':
                $employeeIDs = HelperClass::getIdsByDelimiter($this->employeecheckboxes, '"', '"');
                // Backward compatibility for old picker versions with arrays attached to them START
                if (!is_numeric($employeeIDs[0])) {
                    $employeeIDs = HelperClass::getIdsByDelimiter($this->employeecheckboxes, '[', ']');
                }
                // Backward compatibility for old picker versions with arrays attached to them END
                $res = HelperClass::getEmployeeDataByIds($employeeIDs);
                $arrData = HelperClass::prepareArrayDataForEmployeeTemplate($this->employeeType, $this->dontShowDepartements, $this->dontShowLocations, $res, $departementsIDs, $locationIDs, $locationgroupID, $this->Template);
                break;
            case 'Abteilungen':
            case 'Departements':
                $departementsIDs = HelperClass::getIdsByDelimiter($this->departementcheckboxes, '"', '"');
                // Backward compatibility for old picker versions with arrays attached to them START
                if (!is_numeric($departementsIDs[0])) {
                    $departementsIDs = HelperClass::getIdsByDelimiter($this->departementcheckboxes, '[', ']');
                }
                // Backward compatibility for old picker versions with arrays attached to them END
                $res = HelperClass::getAllEmployeeData();
                $arrData = HelperClass::prepareArrayDataForEmployeeTemplate($this->employeeType, $this->dontShowDepartements, $this->dontShowLocations, $res, $departementsIDs, $locationIDs, $locationgroupID, $this->Template);
                break;
            case 'Standorte':
            case 'Locations':
                $locationIDs = HelperClass::getIdsByDelimiter($this->locationcheckboxes, '"', '"');
                // Backward compatibility for old picker versions with arrays attached to them START
                if (!is_numeric($locationIDs[0])) {
                    $locationIDs = HelperClass::getIdsByDelimiter($this->locationcheckboxes, '[', ']');
                }
                // Backward compatibility for old picker versions with arrays attached to them END
                $res = HelperClass::getAllEmployeeData();
                $arrData = HelperClass::prepareArrayDataForEmployeeTemplate($this->employeeType, $this->dontShowDepartements, $this->dontShowLocations, $res, $departementsIDs, $locationIDs, $locationgroupID, $this->Template);
                break;
            case 'Standortgruppe':
            case 'Location Group':
                $res = HelperClass::getAllEmployeeData();
                $locationgroupID = $this->locationgrouppicker;
                $arrData = HelperClass::prepareArrayDataForEmployeeTemplate($this->employeeType, $this->dontShowDepartements, $this->dontShowLocations, $res, $departementsIDs, $locationIDs, $locationgroupID, $this->Template);
                break;
            case 'Alle':
            case 'All':
                $employeeIds = false;
                $res = HelperClass::getAllEmployeeData();
                $arrData = HelperClass::prepareArrayDataForEmployeeTemplate($this->employeeType, $this->dontShowDepartements, $this->dontShowLocations, $res, $departementsIDs, $locationIDs, $locationgroupID, $this->Template);
                break;
            default:
                $arrData = [];
                break;
        }
        $this->Template->arrAnsprechData = $arrData;
    }
}
