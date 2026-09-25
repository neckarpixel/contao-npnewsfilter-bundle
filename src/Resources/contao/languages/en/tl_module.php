<?php

/*
 * This file is part of neckarpixel/contao-npnewsfilter-bundle.
 *
 * (c) Neckarpixel
 *
 * @license LGPL-3.0-or-later
 */

/*
 * Field
 */
$GLOBALS['TL_LANG']['tl_module']['npnf_timeFilter'] = [
    'Time filter',
    'Limits the news items by their date. The news date is used, the reference point is today 00:00. Leave empty = no restriction (default behaviour).',
];

/*
 * Options
 */
$GLOBALS['TL_LANG']['tl_module']['npnf_timeFilter_options'] = [
    // Group: recent news
    'npnf_group_new' => 'Recent news (at most … old)',
    'new_1w' => 'max. 1 week old',
    'new_2w' => 'max. 2 weeks old',
    'new_1m' => 'max. 1 month old',
    'new_3m' => 'max. 3 months old',
    'new_6m' => 'max. 6 months old',
    'new_1y' => 'max. 1 year old',
    'new_2y' => 'max. 2 years old',
    'new_curmonth' => 'of the current month',
    'new_curyear' => 'of the current year',

    // Group: older news
    'npnf_group_old' => 'Older news (older than …)',
    'old_1w' => 'older than 1 week',
    'old_2w' => 'older than 2 weeks',
    'old_1m' => 'older than 1 month',
    'old_3m' => 'older than 3 months',
    'old_6m' => 'older than 6 months',
    'old_1y' => 'older than 1 year',
    'old_2y' => 'older than 2 years',
    'old_curmonth' => 'before the current month',
    'old_curyear' => 'before the current year',

    // Group: closed period
    'npnf_group_period' => 'Closed period',
    'prev_month' => 'of the previous month',
    'prev_year' => 'of the previous year',
];
