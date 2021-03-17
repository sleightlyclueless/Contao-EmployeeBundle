<?php

/**
 * @package   EmployeeBundle
 * @author    (c) IXTENSA GmbH & Co. KG Internet und Webagentur -- Steffen Hamann
 * @license   GNU LGPL 3+
 * @copyright (c) 2020
 */

if (\class_exists('\ixtensa\JobsBundle\IxtensaJobsBundle')) {

    // Palette
    $defaultpalette = &$GLOBALS['TL_DCA']['tl_jobs']['palettes']['default'];

    $insertat = ';{date_legend';
    if (mb_strpos($defaultpalette, $insertat) !== false) {
        $defaultpalette = str_replace($insertat, ',ixe_id'.$insertat, $defaultpalette);
    }
    else {
        $defaultpalette .= ',ixe_id';
    }

    // Fields
    $GLOBALS['TL_DCA']['tl_jobs']['fields']['ixe_id'] = [
        'label'                   => &$GLOBALS['TL_LANG']['tl_jobs']['ixe_id'],
        'exclude'                 => true,
        'search'                  => true,
    	'inputType'               => 'select',
        'foreignKey'              => 'tl_ixe_employeedata.CONCAT(firstname," ",name)',
    	'eval'                    => array('includeBlankOption'=>true, 'tl_class'=>'w50'),
    	'sql'                     => "int(10) unsigned NOT NULL default '0'"
    ];
}
