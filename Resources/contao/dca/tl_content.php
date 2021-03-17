<?php

/**
 * @package   EmployeeBundle
 * @author    (c) IXTENSA GmbH & Co. KG Internet und Webagentur -- Sebastian Zill
 * @license   GNU LGPL 3+
 * @copyright (c) 2020
 */

namespace ixtensa\EmployeeBundle\dca\tl_content;

use \ixtensa\EmployeeBundle\Widget\EmployeeBundlePicker;
use \ixtensa\EmployeeBundle\Widget\EmployeeBundleCheckboxes;

$strName = 'tl_content';


// ========================================EMPLOYEE=================================================
// Palettes
$GLOBALS['TL_DCA'][$strName]['palettes']['__selector__'][] = 'employeeType';
$GLOBALS['TL_DCA'][$strName]['palettes']['employee'] = '{type_legend},type;{contactPerson_legend},employeeType;{contactPerson_settings},dontShowDepartements,dontShowLocations;{expert_legend:hide},guests,cssID;{template_legend:hide},customTpl;{invisible_legend:hide},invisible,start,stop;';

// Subpalletes
$GLOBALS['TL_DCA'][$strName]['subpalettes']['employeeType_Einzeln'] = 'employeepicker';
$GLOBALS['TL_DCA'][$strName]['subpalettes']['employeeType_Individuell'] = 'employeecheckboxes';
$GLOBALS['TL_DCA'][$strName]['subpalettes']['employeeType_Abteilungen'] = 'departementcheckboxes';
$GLOBALS['TL_DCA'][$strName]['subpalettes']['employeeType_Standorte'] = 'locationcheckboxes';
$GLOBALS['TL_DCA'][$strName]['subpalettes']['employeeType_Alle'] = '';

// Fields
$GLOBALS['TL_DCA'][$strName]['fields']['employeeType'] = array(
    'label'                   => &$GLOBALS['TL_LANG'][$strName]['employeeType'],
    'exclude'                 => true,
    'filter'                  => true,
    'search'                  => false,
    'sorting'                 => false,
    'inputType'               => 'select',
    'options'                 => $GLOBALS['TL_LANG'][$strName]['employeeType']['options'],
    'reference'               => &$GLOBALS['TL_LANG']['CTE'],
    'eval'                    => array(
        'mandatory'=>true,
        'includeBlankOption'=>true,
        'submitOnChange'=>true,
        'tl_class'=>'clr'
    ),
    'sql'                     => "blob NULL"
);

$GLOBALS['TL_DCA'][$strName]['fields']['employeepicker'] = array(
    'label'                   => &$GLOBALS['TL_LANG'][$strName]['employeepicker'],
    'exclude'                 => true,
    'search'                  => true,
    'filter'                  => true,
    'sorting'                 => true,
    'flag'                    => 1,
    'inputType'               => 'EmployeeBundlePicker',
    'foreignKey'              => 'tl_ixe_employeedata',
    'eval'                    => array(
        'multiple'=>false,
        'includeBlankOption'=>true,
        'mandatory'=>true,
        'tl_class'=>'clr'
    ),
    'options_callback'			  => array('ixtensa\EmployeeBundle\dca\tl_content\tl_content_employee', 'getEmployee'),
    'sql'                     => "blob NULL"
);

$GLOBALS['TL_DCA'][$strName]['fields']['employeecheckboxes'] = array(
    'label'                   => &$GLOBALS['TL_LANG'][$strName]['employeecheckboxes'],
    'exclude'                 => true,
    'search'                  => true,
    'sorting'                 => true,
    'filter'                  => true,
    'flag'                    => 1,
    'inputType'               => 'EmployeeBundleCheckboxes',
    'foreignKey'              => 'tl_ixe_employeedata',
    'eval'                    => array(
        'feEditable'=>true,
        'feViewable'=>true,
        'feGroup'=>'qualifications',
        'multiple'=>true,
        'mandatory'=>true,
        'tl_class'=>'clr'
    ),
    'options_callback'			  => array('ixtensa\EmployeeBundle\dca\tl_content\tl_content_employee', 'getEmployee'),
    'sql'                     => "blob NULL"
);

$GLOBALS['TL_DCA'][$strName]['fields']['departementcheckboxes'] = array(
    'label'                   => &$GLOBALS['TL_LANG'][$strName]['departementcheckboxes'],
    'exclude'                 => true,
    'search'                  => true,
    'sorting'                 => true,
    'filter'                  => true,
    'flag'                    => 1,
    'inputType'               => 'EmployeeBundleCheckboxes',
    'foreignKey'              => 'tl_ixe_departement.departement_overview',
    'eval'                    => array(
        'feEditable'=>true,
        'feViewable'=>true,
        'feGroup'=>'qualifications',
        'multiple'=>true,
        'mandatory'=>true,
        'tl_class'=>'clr'
    ),
    'sql'                     => "blob NULL"
);

$GLOBALS['TL_DCA'][$strName]['fields']['locationcheckboxes'] = array(
    'label'                   => &$GLOBALS['TL_LANG'][$strName]['locationcheckboxes'],
    'exclude'                 => true,
    'search'                  => true,
    'sorting'                 => true,
    'filter'                  => true,
    'flag'                    => 1,
    'inputType'               => 'EmployeeBundleCheckboxes',
    'foreignKey'              => 'tl_ixe_locationdata.name',
    'eval'                    => array(
        'feEditable'=>true,
        'feViewable'=>true,
        'feGroup'=>'qualifications',
        'multiple'=>true,
        'mandatory'=>true,
        'tl_class'=>'clr'
    ),
    'sql'                     => "blob NULL"
);

$GLOBALS['TL_DCA'][$strName]['fields']['dontShowDepartements'] = array(
    'label'                   => &$GLOBALS['TL_LANG'][$strName]['dontShowDepartements'],
    'exclude'                 => true,
    'search'                  => false,
    'sorting'                 => false,
    'filter'                  => false,
    'inputType'               => 'checkbox',
    'eval'                    => array(
        'tl_class'=>'w50'
    ),
    'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA'][$strName]['fields']['dontShowLocations'] = array(
    'label'                   => &$GLOBALS['TL_LANG'][$strName]['dontShowLocations'],
    'exclude'                 => true,
    'search'                  => false,
    'sorting'                 => false,
    'filter'                  => false,
    'inputType'               => 'checkbox',
    'eval'                    => array(
        'tl_class'=>'w50'
    ),
    'sql'                     => "char(1) NOT NULL default ''"
);

// ========================================LOCATION=================================================
// Palettes
$GLOBALS['TL_DCA'][$strName]['palettes']['location'] = '{type_legend},type;{location_legend},locationPicker;{expert_legend:hide},guests,cssID;{template_legend:hide},customTpl;{invisible_legend:hide},invisible,start,stop;';

// Fields
$GLOBALS['TL_DCA'][$strName]['fields']['locationPicker'] = array(
    'label'                   => &$GLOBALS['TL_LANG'][$strName]['locationPicker'],
    'exclude'                 => true,
    'search'                  => true,
    'sorting'                 => true,
    'filter'                  => true,
    'flag'                    => 1,
    'inputType'               => 'EmployeeBundlePicker',
    'foreignKey'              => 'tl_ixe_locationdata',
    'eval'                    => array(
        'multiple'=>false,
        'includeBlankOption'=>false,
        'mandatory'=>true,
        'tl_class'=>'clr'
    ),
    'options_callback'			  => array('ixtensa\EmployeeBundle\dca\tl_content\tl_content_location', 'getLocation'),
    'sql'                     => "blob NULL"
);

// =======================================EMPLOYEE CLASS============================================

class tl_content_employee extends \Backend
{
	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

    public function getEmployee()
    {
		$tmp = array();
		$query = $this->Database->prepare("SELECT * FROM tl_ixe_employeedata WHERE published = 1 ORDER BY `sortingIndex` DESC, `name` ASC")->execute();

		$res = $query->fetchAllAssoc();

		foreach ($res as $key => $value)
        {
            $id = $value['id'];
            $name = $value['name'];
            $fname = $value['firstname'];
            $text = '['.$id.'] ' . $name . ' ' . $fname;
			$tmp[] = $text;
		}
		return $tmp;
    }
}

class tl_content_location extends \Backend
{
    /**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

    public function getLocation()
    {
		$tmp = array();
		$res = $this->Database->prepare("SELECT * FROM tl_ixe_locationdata WHERE published = 1 ORDER BY `name` ASC")->execute()->fetchAllAssoc();

		foreach ($res as $key => $value)
        {
            $id = $value['id'];
            $name = $value['name'];
            $type = $value['type'];
            $text = '['.$id.'] ' . $name . ', ' . $type;
			$tmp[] = $text;
		}
		return $tmp;
    }
}
