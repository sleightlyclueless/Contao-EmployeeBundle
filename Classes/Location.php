<?php

/**
 * @package   EmployeeBundle
 * @author    (c) IXTENSA GmbH & Co. KG Internet und Webagentur -- Sebastian Zill
 * @license   GNU LGPL 3+
 * @copyright (c) 2021
 */

namespace ixtensa\EmployeeBundle\Classes;

use ixtensa\EmployeeBundle\Helper\HelperClass;

class Location extends \ContentElement
{
    protected $strTemplate = 'ce_location';

    public function generate()
	{
        if (TL_MODE == 'BE')
		{
            $this->strTemplate = 'be_wildcard';
            $this->Template = new \BackendTemplate($this->strTemplate);

            switch ($this->locationType)
    		{
                case 'Einzeln':
                case 'Single':
                    $this->Template->title = $GLOBALS['IX_EB']['MSC']['template_locationtitle_single'];
                    // Backward compatibility for old picker versions with arrays attached to them START
                    if (!is_numeric($this->locationPicker)) {
                        $locationId = HelperClass::getIdsByDelimiter($this->locationPicker, '[', ']');
                        $res = HelperClass::getLocationDataById($locationId);
                    } 
                    // Backward compatibility for old picker versions with arrays attached to them END
                    else {
                        $res = HelperClass::getLocationDataById($this->locationPicker);
                    }

                    if ($res[0]['published'] != 1) {
                        $this->Template->wildcard = $GLOBALS['IX_EB']['MSC']['disabled'];
                    } else {
                        $this->Template->wildcard = $res[0]['name'] . ' ' . $res[0]['type'];
                    }
                    break;
                case 'Individuell':
                case 'Individual':
                    $this->Template->title = $GLOBALS['IX_EB']['MSC']['template_locationtitle_individual'];
                    $this->Template->wildcard = $GLOBALS['IX_EB']['MSC']['template_locationwildcard_individual'];
                    break;
                case 'Gruppe':
                case 'Group':
                    $this->Template->title = $GLOBALS['IX_EB']['MSC']['template_locationtitle_group'];
                    $res = HelperClass::getLocationGroupById($this->locationgrouppicker);
                    $this->Template->wildcard = $res[0]['name'];
                    break;
                default:
                    $this->Template->title = $GLOBALS['IX_EB']['MSC']['template_title_err'];
                    $this->Template->wildcard = $GLOBALS['IX_EB']['MSC']['template_locationwildcard_default'];
                    break;
            }
            return $this->Template->parse();
        }
        return parent::generate();
    }


    protected function compile()
    {
        switch ($this->locationType)
        {
            case 'Einzeln':
            case 'Single':
                // Backward compatibility for old picker versions with arrays attached to them START
                if (!is_numeric($this->locationPicker)) {
                    $locationId = HelperClass::getIdsByDelimiter($this->locationPicker, '[', ']');
                    $res = HelperClass::getLocationDataById($locationId);
                } 
                // Backward compatibility for old picker versions with arrays attached to them END
                else {
                    $res = HelperClass::getLocationDataById($this->locationPicker);
                }
                $arrData = HelperClass::prepareArrayDataForLocationTemplate($res, $this->Template);
                break;
            case 'Individuell':
            case 'Individual':
                $locationIds = HelperClass::getIdsByDelimiter($this->locationcheckboxes, '"', '"');
                $res = HelperClass::getLocationDataById($locationIds);
                $arrData = HelperClass::prepareArrayDataForLocationTemplate($res, $this->Template);
                break;
            case 'Gruppe':
            case 'Group':
                $res = HelperClass::getLocationGroupDataById($this->locationgrouppicker);
                $arrData = HelperClass::prepareArrayDataForLocationTemplate($res, $this->Template);
                break;
            default:
                $arrData = [];
                break;
        }
        $this->Template->arrLocationData = $arrData;
    }
}
