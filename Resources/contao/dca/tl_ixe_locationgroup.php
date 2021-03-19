<?php

/**
 * @package   EmployeeBundle
 * @author    (c) IXTENSA GmbH & Co. KG Internet und Webagentur -- Sebastian Zill
 * @license   GNU LGPL 3+
 * @copyright (c) 2021
 */

namespace ixtensa\EmployeeBundle\dca\tl_ixe_locationgroup;

$strName = 'tl_ixe_locationgroup';

$GLOBALS['TL_DCA'][$strName] = array(
	'config' => array(
        'ctable'                      => array('tl_ixe_locationdata'),
        'dataContainer'               => 'Table',
		'switchToEdit'                => true,
		'enableVersioning'            => true,
		'sql' => array(
			'keys' => array(
				'id' => 'primary'
			)
		)
	),

	'list' => array(
		'sorting' => array(
			'mode'                    => 2,
            'flag'                    => 1,
            'panelLayout'             => 'filter;name',
			'fields'                  => array('name')
		),
		'label' => array(
			'fields'                  => array('name'),
			'format'                  => '<b>%s</b>'
		),
		'global_operations' => array(
			'all' => array(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			),
		),
		'operations' => array(
			'edit' => array(
				'label'               => &$GLOBALS['TL_LANG'][$strName]['edit'],
				'href'                => 'table=tl_ixe_locationdata',
				'icon'                => 'edit.svg'
			),
			'editheader' => array(
				'label'               => &$GLOBALS['TL_LANG'][$strName]['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.svg'
			),
			'delete' => array(
				'label'               => &$GLOBALS['TL_LANG'][$strName]['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.svg',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
			),
			'show' => array(
				'label'               => &$GLOBALS['TL_LANG'][$strName]['show'],
				'href'                => 'act=show',
				'icon'                => 'show.svg'
			)
		)
	),

	'palettes' => array(
		'default' => 'name'
	),

	'fields' => array(
		'id' => array(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
        'name' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['name'],
        	'exclude'                 => true,
            'search'                  => true,
			'sorting'                 => true,
			'filter'                  => true,
        	'inputType'               => 'text',
        	'eval'                    => array(
                'maxlength'=>255,
                'preserveTags'=>true,
                'doNotCopy'=>true,
                'mandatory'=>true
            ),
        	'sql'                     => "varchar(255) NOT NULL default ''"
        ),
	)
);