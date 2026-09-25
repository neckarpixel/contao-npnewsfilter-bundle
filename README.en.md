# Contao News Time Filter Bundle

> **Time filter for the Contao "News list" module** – show only news that are at most *X* old, older than *X*, or from the current/previous month or year. Exactly like you know it from the event list.

🇩🇪 [Deutsche Version → README.md](README.md)

| | |
|---|---|
| **Package** | `neckarpixel/contao-npnewsfilter-bundle` |
| **Contao** | 4.9 LTS · 4.13 LTS · 5.x |
| **PHP** | 7.2 – 8.x (depending on Contao version) |
| **License** | LGPL-3.0-or-later |
| **Author** | [Neckarpixel](https://www.neckarpixel.de) |
| **Repository** | [github.com/neckarpixel/contao-npnewsfilter-bundle](https://github.com/neckarpixel/contao-npnewsfilter-bundle) |

---

## Table of contents

1. [Why?](#why)
2. [Features](#features)
3. [Requirements](#requirements)
4. [Installation](#installation)
5. [Backend configuration](#backend-configuration)
6. [All filter options](#all-filter-options)
7. [Example: "Latest" + "Archive"](#example-latest--archive)
8. [Interaction with module settings](#interaction-with-module-settings)
9. [How it works](#how-it-works)
10. [Edge cases & notes](#edge-cases--notes)
11. [Troubleshooting](#troubleshooting)
12. [Uninstall](#uninstall)
13. [License](#license)

---

## Why?

The Contao **event list** offers options like "+1 month", "−1 year", "of the current year" etc. The **news list** does not – it always shows all published news of the selected archives.

This bundle adds exactly that to the news list:

```
News archive "Press"
        │
        ├──► News list "Latest"    →  time filter: max. 1 year old
        │
        └──► News list "Archive"   →  time filter: older than 1 year
```

**One source, two lists – no moving or duplicating news.**

---

## Features

- ✅ New field **"Time filter"** in the *News list* front end module
- ✅ **20 filter options** in three groups (recent / older / closed period)
- ✅ "max. X old" and "older than X" complement each other **without gap or overlap**
- ✅ Fully compatible with **sorting, featured filter, pagination, total number, skip items**
- ✅ Works with **preview mode**
- ✅ **Help wizard** (?) in the backend explaining every option
- ✅ Fully translated: **German & English**
- ✅ **One code base for Contao 4.9, 4.13 and 5.x**
- ✅ No custom module, no template override
- ✅ Empty field = exact Contao default behaviour

---

## Requirements

| Component | Version |
|---|---|
| Contao | `^4.9` or `^5.0` |
| contao/news-bundle | `^4.9` or `^5.0` |
| PHP | `^7.2` or `^8.0` (the actual minimum is set by Contao) |
| Contao Manager Plugin | `^2.0` |

### Compatibility

| Contao version | Status | PHP (required by Contao) | Note |
|---|---|---|---|
| 4.0 – 4.8 | ❌ not supported | – | end of life |
| **4.9 LTS** | ✅ supported | 7.2 – 8.0 | |
| 4.10 – 4.12 | ✅ supported | 7.3 – 8.x | end of life |
| **4.13 LTS** | ✅ supported | 7.4 – 8.x | |
| **5.x** (incl. 5.3 LTS and newer) | ✅ supported | 8.1+ | |

Why one code base works for both major versions: `ModuleNewsList`, the hooks `newsListCountItems` / `newsListFetchItems` (same signature), the sorting logic, `TokenChecker::isPreviewMode()` and the `src/Resources/contao/` directory are identical in Contao 4.9, 4.13 and 5.x. The code intentionally avoids PHP 8 features so it also runs on PHP 7.2.

---

## Installation

### Option A – Composer with GitHub repository (recommended)

Add the repository to the `composer.json` **of your Contao installation**:

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

```bash
composer require neckarpixel/contao-npnewsfilter-bundle
```

> 💡 The latest tag is installed (e.g. `v1.0.0`). Without a tag use `:dev-main`.

### Option B – Local path repository

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

### After installation (required)

```bash
php vendor/bin/contao-console cache:clear --env=prod
php vendor/bin/contao-console contao:migrate
```

---

## Backend configuration

1. **Layout → Themes → Front end modules**
2. Edit or create a module of type **News list**
3. Below *Featured items* you will find the new field **Time filter**
4. Select an option → save → done

The **(?) icon** opens the help wizard with an explanation of all options.

---

## All filter options

**Reference date for all examples: Friday, 25 Sep 2026.**
"from" = inclusive (`>=`), "before" = exclusive (`<`). All boundaries are at **00:00**.

### 🟢 Recent news (at most … old)

| Option (EN) | Option (DE) | Value | Condition | Example: shows … |
|---|---|---|---|---|
| max. 1 week old | max. 1 Woche alt | `new_1w` | date ≥ today − 1 week | from 18 Sep 2026 |
| max. 2 weeks old | max. 2 Wochen alt | `new_2w` | date ≥ today − 2 weeks | from 11 Sep 2026 |
| max. 1 month old | max. 1 Monat alt | `new_1m` | date ≥ today − 1 month | from 25 Aug 2026 |
| max. 3 months old | max. 3 Monate alt | `new_3m` | date ≥ today − 3 months | from 25 Jun 2026 |
| max. 6 months old | max. 6 Monate alt | `new_6m` | date ≥ today − 6 months | from 25 Mar 2026 |
| max. 1 year old | max. 1 Jahr alt | `new_1y` | date ≥ today − 1 year | from 25 Sep 2025 |
| max. 2 years old | max. 2 Jahre alt | `new_2y` | date ≥ today − 2 years | from 25 Sep 2024 |
| of the current month | des laufenden Monats | `new_curmonth` | date ≥ 1st of month | from 1 Sep 2026 |
| of the current year | des laufenden Jahres | `new_curyear` | date ≥ 1 Jan | from 1 Jan 2026 |

### 🔵 Older news (older than …)

| Option (EN) | Option (DE) | Value | Condition | Example: shows … |
|---|---|---|---|---|
| older than 1 week | älter als 1 Woche | `old_1w` | date < today − 1 week | before 18 Sep 2026 |
| older than 2 weeks | älter als 2 Wochen | `old_2w` | date < today − 2 weeks | before 11 Sep 2026 |
| older than 1 month | älter als 1 Monat | `old_1m` | date < today − 1 month | before 25 Aug 2026 |
| older than 3 months | älter als 3 Monate | `old_3m` | date < today − 3 months | before 25 Jun 2026 |
| older than 6 months | älter als 6 Monate | `old_6m` | date < today − 6 months | before 25 Mar 2026 |
| older than 1 year | älter als 1 Jahr | `old_1y` | date < today − 1 year | before 25 Sep 2025 |
| older than 2 years | älter als 2 Jahre | `old_2y` | date < today − 2 years | before 25 Sep 2024 |
| before the current month | vor dem laufenden Monat | `old_curmonth` | date < 1st of month | before 1 Sep 2026 |
| before the current year | vor dem laufenden Jahr | `old_curyear` | date < 1 Jan | before 1 Jan 2026 |

### 🟣 Closed period

| Option (EN) | Option (DE) | Value | Condition | Example: shows … |
|---|---|---|---|---|
| of the previous month | des vorherigen Monats | `prev_month` | 1st prev. month ≤ date < 1st of month | 1 Aug – 31 Aug 2026 |
| of the previous year | des vorherigen Jahres | `prev_year` | 1 Jan prev. year ≤ date < 1 Jan | 1 Jan – 31 Dec 2025 |

### ⚪ No filter

| Option | Value | Behaviour |
|---|---|---|
| *(empty)* | `''` | Contao default, the bundle does not interfere |

---

## Example: "Latest" + "Archive"

| Setting | Module "Latest" | Module "Archive" |
|---|---|---|
| Module type | News list | News list |
| News archives | ☑ Press | ☑ Press |
| **Time filter** | **max. 1 year old** | **older than 1 year** |
| Sort order | Date descending | Date descending |
| Items per page | 10 | 20 |

```
timeline ──────────────────────────┬──────────────────────────────►
        « Archive »                │          « Latest »
   date < 25 Sep 2025 00:00        │     date ≥ 25 Sep 2025 00:00
```

The boundary moves forward every day – news items move from "Latest" to "Archive" automatically.

---

## Interaction with module settings

| Module setting | Behaviour with time filter |
|---|---|
| News archives | ✅ respected |
| Featured items (all / only / none / first) | ✅ respected |
| Sort order (date, headline, random) | ✅ respected |
| Total number of items | ✅ limits the filtered set |
| Skip items | ✅ applied to the filtered set |
| Items per page (pagination) | ✅ based on the filtered set |
| Published / show from / until | ✅ as in core |
| Preview mode | ✅ as in core |
| Templates | ✅ unchanged |

---

## How it works

Two Contao hooks of `Contao\ModuleNewsList` are used:

| Hook | Purpose |
|---|---|
| `newsListCountItems` | returns the **number** of filtered news (pagination) |
| `newsListFetchItems` | returns the **news items** (limit, offset, sorting) |

If the time filter is empty, both hooks return `false` and Contao uses its default query. Otherwise the conditions of `NewsModel::findPublishedByPids()` are rebuilt and extended by:

```sql
AND tl_news.date >= :from   -- "max. X old"
AND tl_news.date <  :to     -- "older than X"
```

Database: `tl_module.npnf_timeFilter` – `varchar(32) NOT NULL default ''`

---

## Edge cases & notes

- 🕛 **Reference point is today 00:00**, not "now" – the list changes once per day.
- 📅 **Month calculation** uses PHP `strtotime()` like the Contao event list: 31 Mar − 1 month = 3 Mar.
- 🌍 **Time zone** is taken from the Contao settings.
- 🗄️ **Page cache:** set the cache time of affected pages to **max. 1 day**.
- 🔀 The **News archive** module (`newsarchive`) is not affected.
- 🧩 If another extension uses the same hooks, the first hook returning a result wins.

---

## Troubleshooting

| Problem | Solution |
|---|---|
| Field not visible | `cache:clear` |
| "Unknown column npnf_timeFilter" | `contao:migrate` |
| Filter has no effect | clear page cache / check other news extensions |
| Labels show internal values | `cache:clear`, check backend language |

---

## Uninstall

```bash
composer remove neckarpixel/contao-npnewsfilter-bundle
php vendor/bin/contao-console cache:clear --env=prod
php vendor/bin/contao-console contao:migrate --with-deletes
```

---

## License

[LGPL-3.0-or-later](LICENSE) © [Neckarpixel](https://www.neckarpixel.de)
