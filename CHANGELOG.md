# Changelog

Alle nennenswerten Änderungen an diesem Projekt werden hier dokumentiert.
Format nach [Keep a Changelog](https://keepachangelog.com/de/1.1.0/), Versionierung nach [Semantic Versioning](https://semver.org/lang/de/).

## [1.0.0] – 2026-09-25

### Hinzugefügt

- Feld **Zeitfilter** (`npnf_timeFilter`) im Frontend-Modul *Nachrichtenliste*
- 20 Filteroptionen in drei Gruppen:
  - **Aktuelle Nachrichten:** max. 1/2 Wochen, 1/3/6 Monate, 1/2 Jahre alt, laufender Monat, laufendes Jahr
  - **Ältere Nachrichten:** älter als 1/2 Wochen, 1/3/6 Monate, 1/2 Jahre, vor dem laufenden Monat, vor dem laufenden Jahr
  - **Abgeschlossener Zeitraum:** vorheriger Monat, vorheriges Jahr
- Hooks `newsListCountItems` und `newsListFetchItems` – Pagination, Sortierung, Hervorgehoben-Filter und Offset bleiben voll funktionsfähig
- Hilfe-Assistent (helpwizard) mit Erklärung aller Optionen
- Übersetzungen Deutsch und Englisch

### Ersetzt

- Ersetzt den früheren Prototyp `neckarpixel/contao-npnewslist-bundle`
