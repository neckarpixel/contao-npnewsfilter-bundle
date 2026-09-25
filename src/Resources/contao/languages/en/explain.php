<?php

/*
 * This file is part of neckarpixel/contao-npnewsfilter-bundle.
 *
 * (c) Neckarpixel
 *
 * @license LGPL-3.0-or-later
 */

/*
 * Help wizard for the "Time filter" field
 */
$GLOBALS['TL_LANG']['XPL']['npnf_timeFilter'] = [
    ['colspan', 'Basis: the date of the news item (field "Date") is used. All relative boundaries are calculated from <strong>today 00:00</strong>. "max. X old" and "older than X" with the same X therefore complement each other without gap or overlap – ideal for a "Latest" list and an "Archive" list from the same news archive.'],
    ['colspan', '<strong>(empty)</strong> – no time filter, the list behaves like the Contao default.'],

    ['colspan', '<strong>Recent news (at most … old)</strong>'],
    ['max. 1 week old', 'News from 7 days ago (00:00) onwards.'],
    ['max. 2 weeks old', 'News from 14 days ago (00:00) onwards.'],
    ['max. 1 month old', 'News from one month ago (00:00) onwards.'],
    ['max. 3 months old', 'News from three months ago (00:00) onwards.'],
    ['max. 6 months old', 'News from six months ago (00:00) onwards.'],
    ['max. 1 year old', 'News from one year ago (00:00) onwards.'],
    ['max. 2 years old', 'News from two years ago (00:00) onwards.'],
    ['of the current month', 'News from the 1st of the current month (00:00) onwards.'],
    ['of the current year', 'News from January 1st of the current year (00:00) onwards.'],

    ['colspan', '<strong>Older news (older than …)</strong>'],
    ['older than 1 week', 'News before 7 days ago (00:00).'],
    ['older than 2 weeks', 'News before 14 days ago (00:00).'],
    ['older than 1 month', 'News before one month ago (00:00).'],
    ['older than 3 months', 'News before three months ago (00:00).'],
    ['older than 6 months', 'News before six months ago (00:00).'],
    ['older than 1 year', 'News before one year ago (00:00).'],
    ['older than 2 years', 'News before two years ago (00:00).'],
    ['before the current month', 'All news before the 1st of the current month.'],
    ['before the current year', 'All news before January 1st of the current year.'],

    ['colspan', '<strong>Closed period</strong>'],
    ['of the previous month', 'Only news from the complete previous month (1st to last day).'],
    ['of the previous year', 'Only news from the complete previous year (January 1st to December 31st).'],

    ['colspan', 'Note: sorting, "Featured items", total number, items per page and "Skip items" of the module remain fully effective.'],
];
