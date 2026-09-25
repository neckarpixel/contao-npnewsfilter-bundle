<?php

/*
 * This file is part of neckarpixel/contao-npnewsfilter-bundle.
 *
 * (c) Neckarpixel
 *
 * @license LGPL-3.0-or-later
 */

/*
 * Feld
 */
$GLOBALS['TL_LANG']['tl_module']['npnf_timeFilter'] = [
    'Zeitfilter',
    'Grenzt die Nachrichten anhand ihres Datums ein. Maßgeblich ist das Nachrichtendatum, Stichtag ist jeweils heute 00:00 Uhr. Leer lassen = keine Einschränkung (Standardverhalten).',
];

/*
 * Optionen
 */
$GLOBALS['TL_LANG']['tl_module']['npnf_timeFilter_options'] = [
    // Gruppe: aktuelle Nachrichten
    'npnf_group_new' => 'Aktuelle Nachrichten (höchstens … alt)',
    'new_1w' => 'max. 1 Woche alt',
    'new_2w' => 'max. 2 Wochen alt',
    'new_1m' => 'max. 1 Monat alt',
    'new_3m' => 'max. 3 Monate alt',
    'new_6m' => 'max. 6 Monate alt',
    'new_1y' => 'max. 1 Jahr alt',
    'new_2y' => 'max. 2 Jahre alt',
    'new_curmonth' => 'des laufenden Monats',
    'new_curyear' => 'des laufenden Jahres',

    // Gruppe: ältere Nachrichten
    'npnf_group_old' => 'Ältere Nachrichten (älter als …)',
    'old_1w' => 'älter als 1 Woche',
    'old_2w' => 'älter als 2 Wochen',
    'old_1m' => 'älter als 1 Monat',
    'old_3m' => 'älter als 3 Monate',
    'old_6m' => 'älter als 6 Monate',
    'old_1y' => 'älter als 1 Jahr',
    'old_2y' => 'älter als 2 Jahre',
    'old_curmonth' => 'vor dem laufenden Monat',
    'old_curyear' => 'vor dem laufenden Jahr',

    // Gruppe: fester Zeitraum
    'npnf_group_period' => 'Abgeschlossener Zeitraum',
    'prev_month' => 'des vorherigen Monats',
    'prev_year' => 'des vorherigen Jahres',
];
