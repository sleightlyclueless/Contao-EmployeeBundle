<?php

/**
 * @package   EmployeeBundle
 * @author    (c) IXTENSA GmbH & Co. KG Internet und Webagentur -- Sebastian Zill
 * @license   GNU LGPL 3+
 * @copyright (c) 2020
 */

namespace ixtensa\EmployeeBundle\dca\tl_ixe_departement;

use Symfony\Component\Intl\Intl;
use MenAtWork\MultiColumnWizardBundle\Contao\Widgets\MultiColumnWizard;

$strName = 'tl_ixe_departement';

$GLOBALS['TL_DCA'][$strName] = array(
	'config' => array(
        'dataContainer'               => 'Table',
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
            'panelLayout'             => 'search,filter;departement_overview',
			'fields'                  => array('departement_overview')
		),
		'label' => array(
            'fields'                  => array('departement_overview'),
			'format'                  => '<b>%s</b>'
		),
		'global_operations' => array(
            'backToEmployee' => array
            (
				'label'               => &$GLOBALS['TL_LANG'][$strName]['backToEmployee'],
                'href'                => 'do=employee',
				'class'               => 'header_back',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			),
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
				'href'                => 'act=edit',
				'icon'                => 'edit.svg',
			),
            'copy' => array(
				'label'               => &$GLOBALS['TL_LANG'][$strName]['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.svg'
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
		'default' => 'departement_overview;{departement_legend},departement;'
	),

	'fields' => array(
		'id' => array(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
        'departement_overview' => array(
            'label'         => &$GLOBALS['TL_LANG'][$strName]['departement_overview'],
            'exclude'       => true,
            'search'        => false,
            'sorting'       => false,
            'filter'        => false,
            'inputType'     => 'text',
            'eval'          => array(
                'maxlength'      =>255,
                'preserveTags'   =>true,
                'doNotCopy'      =>true,
                'mandatory'      =>true,
                'tl_class'       =>'clr'
            ),
            'sql'           => "varchar(255) NOT NULL default ''"
        ),
        'departement' => array(
            'label'                   => &$GLOBALS['TL_LANG'][$strName]['departement'],
        	'exclude'                 => true,
            'search'                  => false,
			'filter'                  => false,
        	'sorting'                 => false,
		    'inputType'               => 'multiColumnWizard',
            'eval'      => array(
		        'columnFields' => array(
                    'departement_lang' => array(
                        'label'                   => &$GLOBALS['TL_LANG'][$strName]['departement_lang'],
                        'exclude'                 => true,
                        'search'                  => false,
            			'filter'                  => false,
                    	'sorting'                 => false,
                    	'inputType'               => 'select',
                        'eval'                    => array(
                            'style'=>'width:100%;',
                            'chosen'=>true,
                            'tl_class'=>'w45'
                        ),
                        'options_callback'        => array('ixtensa\EmployeeBundle\dca\tl_ixe_departement\tl_ixe_departement', 'getLanguageOptions'),
                        'load_callback'			  => array(array('ixtensa\EmployeeBundle\dca\tl_ixe_departement\tl_ixe_departement', 'setLangDefault'))
                    ),
                    'departement_name' => array(
                        'label'         => &$GLOBALS['TL_LANG'][$strName]['departement_name'],
                    	'exclude'       => true,
                        'search'        => true,
            			'sorting'       => true,
            			'filter'        => true,
                    	'inputType'     => 'text',
                    	'eval'          => array(
                            'maxlength'      =>255,
                            'preserveTags'   =>true,
                            'doNotCopy'      =>true,
                            'mandatory'      =>true,
                            'tl_class'       =>'w45'
                        ),
                    	'sql'           => "varchar(255) NOT NULL default ''"
                    ),
		        ),
		    ),
		    'sql'       => 'blob NULL',
        )
	)
);

class tl_ixe_departement extends \Backend
{
    /**
     * Den Backend User importieren
     */
    public function __construct()
	{
		parent::__construct();
		$this->import('\BackendUser', 'User');
	}

    // get language options
    public function getLanguageOptions()
	{
		return Intl::getLanguageBundle()->getLanguageNames();
	}

    // set default language
    public function setLangDefault($varValue, MultiColumnWizard $mcw)
    {
        return (empty($varValue) ? 'de' : $varValue);
    }
}
