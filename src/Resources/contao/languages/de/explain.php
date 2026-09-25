<?php

/*
 * This file is part of neckarpixel/contao-npnewsfilter-bundle.
 *
 * (c) Neckarpixel
 *
 * @license LGPL-3.0-or-later
 */

/*
 * Hilfe-Assistent (helpwizard) für das Feld "Zeitfilter"
 */
$GLOBALS['TL_LANG']['XPL']['npnf_timeFilter'] = [
    ['colspan', 'Grundlage: Maßgeblich ist das Datum der Nachricht (Feld „Datum“). Alle relativen Grenzen werden ab <strong>heute 00:00 Uhr</strong> berechnet. „max. X alt“ und „älter als X“ mit demselben X ergänzen sich daher lückenlos und ohne Überschneidung – ideal für eine Liste „Aktuelles“ und eine Liste „Archiv“ aus demselben Nachrichtenarchiv.'],
    ['colspan', '<strong>(leer)</strong> – kein Zeitfilter, die Liste verhält sich wie im Contao-Standard.'],

    ['colspan', '<strong>Aktuelle Nachrichten (höchstens … alt)</strong>'],
    ['max. 1 Woche alt', 'Nachrichten ab heute vor 7 Tagen (00:00 Uhr).'],
    ['max. 2 Wochen alt', 'Nachrichten ab heute vor 14 Tagen (00:00 Uhr).'],
    ['max. 1 Monat alt', 'Nachrichten ab heute vor einem Monat (00:00 Uhr).'],
    ['max. 3 Monate alt', 'Nachrichten ab heute vor drei Monaten (00:00 Uhr).'],
    ['max. 6 Monate alt', 'Nachrichten ab heute vor sechs Monaten (00:00 Uhr).'],
    ['max. 1 Jahr alt', 'Nachrichten ab heute vor einem Jahr (00:00 Uhr).'],
    ['max. 2 Jahre alt', 'Nachrichten ab heute vor zwei Jahren (00:00 Uhr).'],
    ['des laufenden Monats', 'Nachrichten ab dem 1. des aktuellen Monats (00:00 Uhr).'],
    ['des laufenden Jahres', 'Nachrichten ab dem 1. Januar des aktuellen Jahres (00:00 Uhr).'],

    ['colspan', '<strong>Ältere Nachrichten (älter als …)</strong>'],
    ['älter als 1 Woche', 'Nachrichten vor heute vor 7 Tagen (00:00 Uhr).'],
    ['älter als 2 Wochen', 'Nachrichten vor heute vor 14 Tagen (00:00 Uhr).'],
    ['älter als 1 Monat', 'Nachrichten vor heute vor einem Monat (00:00 Uhr).'],
    ['älter als 3 Monate', 'Nachrichten vor heute vor drei Monaten (00:00 Uhr).'],
    ['älter als 6 Monate', 'Nachrichten vor heute vor sechs Monaten (00:00 Uhr).'],
    ['älter als 1 Jahr', 'Nachrichten vor heute vor einem Jahr (00:00 Uhr).'],
    ['älter als 2 Jahre', 'Nachrichten vor heute vor zwei Jahren (00:00 Uhr).'],
    ['vor dem laufenden Monat', 'Alle Nachrichten vor dem 1. des aktuellen Monats.'],
    ['vor dem laufenden Jahr', 'Alle Nachrichten vor dem 1. Januar des aktuellen Jahres.'],

    ['colspan', '<strong>Abgeschlossener Zeitraum</strong>'],
    ['des vorherigen Monats', 'Nur Nachrichten aus dem kompletten Vormonat (1. bis letzter Tag).'],
    ['des vorherigen Jahres', 'Nur Nachrichten aus dem kompletten Vorjahr (1. Januar bis 31. Dezember).'],

    ['colspan', 'Hinweis: Sortierung, „Hervorgehobene Nachrichten“, Gesamtzahl, Elemente pro Seite und „Elemente überspringen“ des Moduls bleiben voll wirksam.'],
];
