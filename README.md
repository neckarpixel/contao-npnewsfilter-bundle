# Contao News Time Filter Bundle

> **Zeitfilter für das Contao-Modul „Nachrichtenliste“** – zeige nur Nachrichten, die höchstens *X* alt sind, die älter als *X* sind, oder die aus dem laufenden bzw. vorherigen Monat/Jahr stammen. Genau so, wie du es von der Eventliste kennst.

🇬🇧 [English version → README.en.md](README.en.md)

| | |
|---|---|
| **Paket** | `neckarpixel/contao-npnewsfilter-bundle` |
| **Contao** | 4.9 LTS · 4.13 LTS · 5.x |
| **PHP** | 7.2 – 8.x (je nach Contao-Version) |
| **Lizenz** | LGPL-3.0-or-later |
| **Autor** | [Neckarpixel](https://www.neckarpixel.de) |
| **Repository** | [github.com/neckarpixel/contao-npnewsfilter-bundle](https://github.com/neckarpixel/contao-npnewsfilter-bundle) |

---

## Inhaltsverzeichnis

1. [Wozu das Ganze?](#wozu-das-ganze)
2. [Features](#features)
3. [Voraussetzungen](#voraussetzungen)
4. [Installation](#installation)
5. [Konfiguration im Backend](#konfiguration-im-backend)
6. [Alle Filteroptionen im Detail](#alle-filteroptionen-im-detail)
7. [Praxisbeispiel: „Aktuelles“ + „Archiv“](#praxisbeispiel-aktuelles--archiv)
8. [Zusammenspiel mit den Moduleinstellungen](#zusammenspiel-mit-den-moduleinstellungen)
9. [Technische Funktionsweise](#technische-funktionsweise)
10. [Grenzfälle & Hinweise](#grenzfälle--hinweise)
11. [Fehlerbehebung](#fehlerbehebung)
12. [Deinstallation](#deinstallation)
13. [Verzeichnisstruktur](#verzeichnisstruktur)
14. [Übersetzungen](#übersetzungen)
15. [Lizenz](#lizenz)

---

## Wozu das Ganze?

Die Contao-**Eventliste** bietet eine Auswahl wie „+1 Monat“, „−1 Jahr“, „des laufenden Jahres“ usw. Die **Nachrichtenliste** kann das im Core nicht – sie zeigt immer alle veröffentlichten Nachrichten der gewählten Archive.

Dieses Bundle ergänzt die Nachrichtenliste um genau diese Möglichkeit. Typischer Anwendungsfall:

```
Nachrichtenarchiv „Presse“
        │
        ├──► Nachrichtenliste „Aktuelles“   →  Zeitfilter: max. 1 Jahr alt
        │
        └──► Nachrichtenliste „Archiv“      →  Zeitfilter: älter als 1 Jahr
```

**Eine Quelle, zwei Listen – ohne Nachrichten zu verschieben oder doppelt zu pflegen.**

---

## Features

- ✅ Neues Feld **„Zeitfilter“** im Frontend-Modul *Nachrichtenliste*
- ✅ **20 Filteroptionen** in drei Gruppen (aktuell / älter / abgeschlossener Zeitraum)
- ✅ „max. X alt“ und „älter als X“ ergänzen sich **lückenlos und ohne Überschneidung**
- ✅ Volle Kompatibilität mit **Sortierung, Hervorgehoben-Filter, Pagination, Gesamtzahl, Elemente überspringen**
- ✅ Funktioniert mit der **Vorschau** (Backend-Benutzer sehen auch unveröffentlichte Nachrichten)
- ✅ **Hilfe-Assistent** (?) im Backend mit Erklärung jeder Option
- ✅ Vollständig übersetzt: **Deutsch & Englisch**
- ✅ **Eine Codebasis für Contao 4.9, 4.13 und 5.x** – keine getrennten Versionen nötig
- ✅ Kein eigenes Modul, kein Template-Override – die bestehende Nachrichtenliste wird nur erweitert
- ✅ Leeres Feld = exakt das Contao-Standardverhalten

---

## Voraussetzungen

| Komponente | Version |
|---|---|
| Contao | `^4.9` oder `^5.0` |
| contao/news-bundle | `^4.9` oder `^5.0` |
| PHP | `^7.2` oder `^8.0` (Contao gibt die tatsächliche Mindestversion vor) |
| Contao Manager Plugin | `^2.0` |

### Kompatibilität

| Contao-Version | Status | PHP (Vorgabe von Contao) | Hinweis |
|---|---|---|---|
| 4.0 – 4.8 | ❌ nicht unterstützt | – | End of Life, bitte updaten |
| **4.9 LTS** | ✅ unterstützt | 7.2 – 8.0 | |
| 4.10 – 4.12 | ✅ unterstützt | 7.3 – 8.x | End of Life |
| **4.13 LTS** | ✅ unterstützt | 7.4 – 8.x | |
| **5.x** (inkl. 5.3 LTS und neuer) | ✅ unterstützt | ab 8.1 | |

**Warum eine Codebasis für beide Hauptversionen reicht:**

| Baustein | Contao 4.9 / 4.13 | Contao 5.x |
|---|---|---|
| Nachrichtenliste | `ModuleNewsList` | `ModuleNewsList` (unverändert) |
| Hooks `newsListCountItems` / `newsListFetchItems` | ✅ gleiche Signatur | ✅ gleiche Signatur |
| Sortierung (`news_order`, `featured_first`) | ✅ identisch | ✅ identisch |
| Vorschau-Erkennung `TokenChecker::isPreviewMode()` | ✅ | ✅ |
| Ressourcen-Ordner `src/Resources/contao/` | ✅ Standard | ✅ wird weiterhin geladen |
| Sprachdateien als PHP | ✅ | ✅ |
| Symfony | 4.4 / 5.4 | 6.4 / 7.x |

> ℹ️ Der Code verwendet bewusst keine PHP-8-Features (Attribute, Constructor Property Promotion, `match`), damit er auch unter Contao 4.9 mit PHP 7.2 läuft.

---

## Installation

### Variante A – Composer mit GitHub-Repository (empfohlen)

Solange das Paket nicht auf Packagist liegt, trägst du das GitHub-Repository in der `composer.json` **deiner Contao-Installation** ein:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/neckarpixel/contao-npnewsfilter-bundle"
        }
    ]
}
```

Dann installieren:

```bash
composer require neckarpixel/contao-npnewsfilter-bundle
```

> 💡 **Hinweis:** Installiert wird der neueste Tag (z. B. `v1.0.0`). Ohne Tag musst du `dev-main` angeben:
> `composer require neckarpixel/contao-npnewsfilter-bundle:dev-main`

### Variante B – Lokaler Ordner (Path-Repository)

Bundle z. B. nach `packages/contao-npnewsfilter-bundle` kopieren und in der `composer.json` der Installation eintragen:

```json
{
    "repositories": [
        {
            "type": "path",
            "url": "packages/contao-npnewsfilter-bundle"
        }
    ]
}
```

```bash
composer require neckarpixel/contao-npnewsfilter-bundle:@dev
```

### Variante C – Contao Manager

Im Contao Manager unter **Pakete → Paket hochladen** bzw. nach Eintragen des Repositories (siehe A) über die Suche installieren.

### Nach der Installation (Pflicht)

```bash
# Cache leeren
php vendor/bin/contao-console cache:clear --env=prod

# Datenbank aktualisieren (legt die Spalte tl_module.npnf_timeFilter an)
php vendor/bin/contao-console contao:migrate
```

> ⚠️ Bei mehreren PHP-Versionen auf dem Server das passende Binary verwenden, z. B. `php74 vendor/bin/contao-console …` (Contao 4) oder `php83 vendor/bin/contao-console …` (Contao 5)

Alternativ: **Contao Manager → Systemwartung → Prod.-Cache neu erzeugen** und anschließend **Datenbank aktualisieren** im Install-Tool bzw. Contao Manager.

---

## Konfiguration im Backend

1. **Layout → Themes → Frontend-Module** öffnen (Contao 4 und 5 identisch)
2. Ein Modul vom Typ **Nachrichtenliste** bearbeiten oder neu anlegen
3. Im Bereich **Modul-Konfiguration** direkt unter *Hervorgehobene Nachrichten* erscheint das neue Feld:

```
┌──────────────────────────────────────────────┐
│ Zeitfilter                              (?)  │
│ ┌──────────────────────────────────────────┐ │
│ │ -                                     ▼  │ │
│ └──────────────────────────────────────────┘ │
│ Grenzt die Nachrichten anhand ihres Datums   │
│ ein. … Leer lassen = keine Einschränkung.    │
└──────────────────────────────────────────────┘
```

4. Option wählen → speichern → fertig.

Über das **(?)-Symbol** öffnet sich der Hilfe-Assistent mit einer Erklärung aller Optionen.

---

## Alle Filteroptionen im Detail

**Stichtag für alle Beispiele: Freitag, 25.09.2026.**
„ab“ = inklusive (`>=`), „vor“ = exklusive (`<`). Alle Grenzen liegen auf **00:00 Uhr**.

### 🟢 Aktuelle Nachrichten (höchstens … alt)

| Option (DE) | Option (EN) | Interner Wert | Bedingung | Beispiel: angezeigt wird … |
|---|---|---|---|---|
| max. 1 Woche alt | max. 1 week old | `new_1w` | Datum ≥ heute − 1 Woche | ab 18.09.2026 |
| max. 2 Wochen alt | max. 2 weeks old | `new_2w` | Datum ≥ heute − 2 Wochen | ab 11.09.2026 |
| max. 1 Monat alt | max. 1 month old | `new_1m` | Datum ≥ heute − 1 Monat | ab 25.08.2026 |
| max. 3 Monate alt | max. 3 months old | `new_3m` | Datum ≥ heute − 3 Monate | ab 25.06.2026 |
| max. 6 Monate alt | max. 6 months old | `new_6m` | Datum ≥ heute − 6 Monate | ab 25.03.2026 |
| max. 1 Jahr alt | max. 1 year old | `new_1y` | Datum ≥ heute − 1 Jahr | ab 25.09.2025 |
| max. 2 Jahre alt | max. 2 years old | `new_2y` | Datum ≥ heute − 2 Jahre | ab 25.09.2024 |
| des laufenden Monats | of the current month | `new_curmonth` | Datum ≥ 1. des Monats | ab 01.09.2026 |
| des laufenden Jahres | of the current year | `new_curyear` | Datum ≥ 1. Januar | ab 01.01.2026 |

### 🔵 Ältere Nachrichten (älter als …)

| Option (DE) | Option (EN) | Interner Wert | Bedingung | Beispiel: angezeigt wird … |
|---|---|---|---|---|
| älter als 1 Woche | older than 1 week | `old_1w` | Datum < heute − 1 Woche | vor 18.09.2026 |
| älter als 2 Wochen | older than 2 weeks | `old_2w` | Datum < heute − 2 Wochen | vor 11.09.2026 |
| älter als 1 Monat | older than 1 month | `old_1m` | Datum < heute − 1 Monat | vor 25.08.2026 |
| älter als 3 Monate | older than 3 months | `old_3m` | Datum < heute − 3 Monate | vor 25.06.2026 |
| älter als 6 Monate | older than 6 months | `old_6m` | Datum < heute − 6 Monate | vor 25.03.2026 |
| älter als 1 Jahr | older than 1 year | `old_1y` | Datum < heute − 1 Jahr | vor 25.09.2025 |
| älter als 2 Jahre | older than 2 years | `old_2y` | Datum < heute − 2 Jahre | vor 25.09.2024 |
| vor dem laufenden Monat | before the current month | `old_curmonth` | Datum < 1. des Monats | vor 01.09.2026 |
| vor dem laufenden Jahr | before the current year | `old_curyear` | Datum < 1. Januar | vor 01.01.2026 |

### 🟣 Abgeschlossener Zeitraum

| Option (DE) | Option (EN) | Interner Wert | Bedingung | Beispiel: angezeigt wird … |
|---|---|---|---|---|
| des vorherigen Monats | of the previous month | `prev_month` | 1. Vormonat ≤ Datum < 1. des Monats | 01.08.2026 – 31.08.2026 |
| des vorherigen Jahres | of the previous year | `prev_year` | 1.1. Vorjahr ≤ Datum < 1.1. | 01.01.2025 – 31.12.2025 |

### ⚪ Kein Filter

| Option | Interner Wert | Verhalten |
|---|---|---|
| *(leer)* | `''` | Contao-Standard, das Bundle greift nicht ein |

### Welche Paare passen zusammen?

Diese Kombinationen teilen ein Archiv **vollständig und ohne Doppelungen** auf:

| Liste „Aktuelles“ | Liste „Archiv“ |
|---|---|
| `new_1w` max. 1 Woche alt | `old_1w` älter als 1 Woche |
| `new_1m` max. 1 Monat alt | `old_1m` älter als 1 Monat |
| `new_6m` max. 6 Monate alt | `old_6m` älter als 6 Monate |
| `new_1y` max. 1 Jahr alt | `old_1y` älter als 1 Jahr |
| `new_curmonth` des laufenden Monats | `old_curmonth` vor dem laufenden Monat |
| `new_curyear` des laufenden Jahres | `old_curyear` vor dem laufenden Jahr |
| … | … (gilt für alle gleichnamigen Paare) |

---

## Praxisbeispiel: „Aktuelles“ + „Archiv“

**Ziel:** Auf der Startseite die Nachrichten der letzten 12 Monate, auf der Seite „Archiv“ alles Ältere – beides aus demselben Archiv „Presse“.

### Modul 1 – „Nachrichten aktuell“

| Einstellung | Wert |
|---|---|
| Modultyp | Nachrichtenliste |
| Nachrichtenarchive | ☑ Presse |
| Hervorgehobene Nachrichten | Alle Nachrichten anzeigen |
| **Zeitfilter** | **max. 1 Jahr alt** |
| Sortierung | Datum absteigend |
| Elemente pro Seite | 10 |

### Modul 2 – „Nachrichten Archiv“

| Einstellung | Wert |
|---|---|
| Modultyp | Nachrichtenliste |
| Nachrichtenarchive | ☑ Presse |
| Hervorgehobene Nachrichten | Alle Nachrichten anzeigen |
| **Zeitfilter** | **älter als 1 Jahr** |
| Sortierung | Datum absteigend |
| Elemente pro Seite | 20 |

### Ergebnis (Stichtag 25.09.2026)

```
Zeitachse ─────────────────────────┬──────────────────────────────►
                                   │
        « Archiv »                 │          « Aktuelles »
   Datum < 25.09.2025 00:00        │     Datum ≥ 25.09.2025 00:00
                                   │
                              Stichtag − 1 Jahr
```

Am nächsten Tag verschiebt sich die Grenze automatisch um einen Tag – Nachrichten „wandern“ selbstständig vom Aktuell- ins Archiv-Modul.

---

## Zusammenspiel mit den Moduleinstellungen

| Moduleinstellung | Verhalten mit Zeitfilter |
|---|---|
| Nachrichtenarchive | ✅ Es werden nur die gewählten Archive berücksichtigt |
| Hervorgehobene Nachrichten (alle / nur / keine / zuerst) | ✅ Wird vollständig berücksichtigt |
| Sortierung (Datum auf-/absteigend, Überschrift, Zufall) | ✅ Wird vollständig berücksichtigt |
| Gesamtzahl der Beiträge | ✅ Begrenzt die gefilterte Menge |
| Elemente überspringen | ✅ Wird auf die gefilterte Menge angewandt |
| Elemente pro Seite (Pagination) | ✅ Seitenanzahl basiert auf der gefilterten Menge |
| Veröffentlichung / Anzeigen ab / bis | ✅ Wie im Core (nur veröffentlichte Nachrichten) |
| Vorschau-Modus (Backend-Login) | ✅ Unveröffentlichte Nachrichten sichtbar – wie im Core |
| Templates (`mod_newslist`, `news_*`) | ✅ Unverändert nutzbar |

---

## Technische Funktionsweise

Das Bundle registriert zwei Contao-Hooks aus `Contao\ModuleNewsList`:

| Hook | Aufgabe |
|---|---|
| `newsListCountItems` | Liefert die **Anzahl** der gefilterten Nachrichten (für Pagination) |
| `newsListFetchItems` | Liefert die **Nachrichten** selbst (mit Limit, Offset, Sortierung) |

**Ablauf:**

```
ModuleNewsList::compile()
        │
        ├── countItems() ──► Hook newsListCountItems
        │                        │
        │                        ├─ Zeitfilter leer?  → return false  → Contao-Standard
        │                        └─ Zeitfilter gesetzt → NewsModel::countBy(...)
        │
        └── fetchItems() ──► Hook newsListFetchItems
                                 │
                                 ├─ Zeitfilter leer?  → return false  → Contao-Standard
                                 └─ Zeitfilter gesetzt → NewsModel::findBy(...)
```

Die SQL-Bedingungen entsprechen `NewsModel::findPublishedByPids()` aus dem Core, ergänzt um:

```sql
-- "max. X alt"
AND tl_news.date >= :grenze

-- "älter als X"
AND tl_news.date < :grenze

-- "vorheriger Monat / vorheriges Jahr"
AND tl_news.date >= :von AND tl_news.date < :bis
```

Die Grenzwerte werden als Prepared-Statement-Parameter übergeben.

### Klassen & Dateien

| Datei | Zweck |
|---|---|
| `src/ContaoNpnewsfilterBundle.php` | Bundle-Klasse (registriert die Container-Extension explizit) |
| `src/ContaoManager/Plugin.php` | Contao-Manager-Plugin, lädt nach Core- und News-Bundle |
| `src/DependencyInjection/ContaoNpnewsfilterExtension.php` | Lädt `services.yaml` |
| `src/Resources/config/services.yaml` | Registriert den Listener und die beiden Hooks |
| `src/EventListener/NewsListFilterListener.php` | Filterlogik (Zeitgrenzen, SQL, Sortierung) |
| `src/Resources/contao/dca/tl_module.php` | Feld `npnf_timeFilter` + Palette `newslist` |
| `src/Resources/contao/languages/{de,en}/tl_module.php` | Labels & Optionen |
| `src/Resources/contao/languages/{de,en}/explain.php` | Texte für den Hilfe-Assistenten |

### Datenbank

| Tabelle | Spalte | Typ |
|---|---|---|
| `tl_module` | `npnf_timeFilter` | `varchar(32) NOT NULL default ''` |

---

## Grenzfälle & Hinweise

### 🕛 Stichtag ist immer heute 00:00 Uhr

Alle relativen Grenzen werden ab **Mitternacht des aktuellen Tages** gerechnet, nicht ab „jetzt“. Dadurch:

- ändert sich die Liste nur **einmal pro Tag**,
- passen „max. X alt“ und „älter als X“ exakt aneinander.

### 📅 Monatsrechnung

Die Berechnung erfolgt mit PHP `strtotime()` – identisch zur Contao-Eventliste. Bei Monatsenden kann das zu Verschiebungen führen:

| Stichtag | „− 1 Monat“ ergibt |
|---|---|
| 25.09.2026 | 25.08.2026 |
| 31.03.2026 | 03.03.2026 (es gibt keinen 31.02.) |

### 🌍 Zeitzone

Maßgeblich ist die in Contao eingestellte Zeitzone (**System → Einstellungen → Zeitzone**).

### 🗄️ Seiten-Cache

Ist für die Seite der **Shared Cache** aktiv, zeigt Contao die gecachte Version bis zum Ablauf der Cache-Zeit. Da sich die Filtergrenzen täglich verschieben:

> **Empfehlung:** Cache-Zeit der betroffenen Seiten auf **maximal 1 Tag** (86400 Sekunden) setzen.

### 🔀 Nachrichtenarchiv-Modul

Das Modul **Nachrichtenarchiv** (`newsarchive`) ist **nicht** betroffen – der Zeitfilter gilt ausschließlich für die **Nachrichtenliste** (`newslist`).

### 🧩 Andere Erweiterungen

Nutzt eine andere Erweiterung ebenfalls die Hooks `newsListCountItems` / `newsListFetchItems`, gewinnt der **erste** Hook, der ein Ergebnis zurückgibt. Bei leerem Zeitfilter gibt dieses Bundle `false` zurück und lässt anderen Erweiterungen den Vortritt.

---

## Fehlerbehebung

| Problem | Ursache | Lösung |
|---|---|---|
| Feld „Zeitfilter“ erscheint nicht | Cache nicht geleert | `cache:clear` ausführen |
| Fehler „Unknown column npnf_timeFilter“ | Datenbank nicht aktualisiert | `contao:migrate` ausführen |
| Filter hat keine Wirkung | Seite ist gecacht | Cache leeren / Cache-Zeit reduzieren |
| Filter hat keine Wirkung | Anderer Hook liefert vorher ein Ergebnis | Andere News-Erweiterungen prüfen |
| Liste ist leer | Keine Nachricht im gewählten Zeitraum | Nachrichtendatum prüfen, ggf. größeren Zeitraum wählen |
| Options-Labels zeigen interne Werte (`new_1y`) | Sprachdatei nicht geladen / Cache | `cache:clear`, Backend-Sprache prüfen |

**Debug-Tipp:** Im Debug-Modus (`APP_ENV=dev` bzw. Contao Manager → Debug-Modus) zeigt der Symfony-Profiler unter *Doctrine* die ausgeführte SQL-Abfrage inkl. `tl_news.date`-Bedingung.

---

## Deinstallation

```bash
composer remove neckarpixel/contao-npnewsfilter-bundle
php vendor/bin/contao-console cache:clear --env=prod
php vendor/bin/contao-console contao:migrate --with-deletes
```

Mit `--with-deletes` entfernt `contao:migrate` auch die nicht mehr benötigte Spalte `tl_module.npnf_timeFilter`. Die Nachrichtenlisten verhalten sich danach wieder wie im Contao-Standard.

---

## Verzeichnisstruktur

```
contao-npnewsfilter-bundle/
├── CHANGELOG.md
├── LICENSE
├── README.md
├── README.en.md
├── composer.json
└── src/
    ├── ContaoNpnewsfilterBundle.php
    ├── ContaoManager/
    │   └── Plugin.php
    ├── DependencyInjection/
    │   └── ContaoNpnewsfilterExtension.php
    ├── EventListener/
    │   └── NewsListFilterListener.php
    └── Resources/
        ├── config/
        │   └── services.yaml
        └── contao/
            ├── dca/
            │   └── tl_module.php
            └── languages/
                ├── de/
                │   ├── explain.php
                │   └── tl_module.php
                └── en/
                    ├── explain.php
                    └── tl_module.php
```

---

## Übersetzungen

| Sprache | Labels | Optionen | Hilfe-Assistent |
|---|---|---|---|
| 🇩🇪 Deutsch | ✅ | ✅ | ✅ |
| 🇬🇧 Englisch | ✅ | ✅ | ✅ |

Weitere Sprachen: Ordner `src/Resources/contao/languages/<sprachkürzel>/` anlegen und `tl_module.php` sowie `explain.php` aus `en/` übersetzen.

---

## Lizenz

[LGPL-3.0-or-later](LICENSE) © [Neckarpixel](https://www.neckarpixel.de)
