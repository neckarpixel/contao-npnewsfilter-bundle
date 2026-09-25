<?php

/*
 * This file is part of neckarpixel/contao-npnewsfilter-bundle.
 *
 * (c) Neckarpixel
 *
 * @license LGPL-3.0-or-later
 */

use Contao\CoreBundle\DataContainer\PaletteManipulator;

/*
 * Feld: Zeitfilter für die Nachrichtenliste
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['npnf_timeFilter'] = [
    'exclude' => true,
    'inputType' => 'select',
    'options' => [
        'npnf_group_new' => [
            'new_1w',
            'new_2w',
            'new_1m',
            'new_3m',
            'new_6m',
            'new_1y',
            'new_2y',
            'new_curmonth',
            'new_curyear',
        ],
        'npnf_group_old' => [
            'old_1w',
            'old_2w',
            'old_1m',
            'old_3m',
            'old_6m',
            'old_1y',
            'old_2y',
            'old_curmonth',
            'old_curyear',
        ],
        'npnf_group_period' => [
            'prev_month',
            'prev_year',
        ],
    ],
    'reference' => &$GLOBALS['TL_LANG']['tl_module']['npnf_timeFilter_options'],
    'explanation' => 'npnf_timeFilter',
    'eval' => [
        'includeBlankOption' => true,
        'chosen' => true,
        'helpwizard' => true,
        'tl_class' => 'w50',
    ],
    'sql' => "varchar(32) NOT NULL default ''",
];

/*
 * Palette: Feld direkt hinter "Hervorgehobene Nachrichten" einfügen.
 * Fallback: ans Ende der config_legend anhängen.
 */
PaletteManipulator::create()
    ->addField('npnf_timeFilter', 'news_featured', PaletteManipulator::POSITION_AFTER, 'config_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('newslist', 'tl_module')
;
