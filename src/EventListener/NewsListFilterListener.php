<?php

declare(strict_types=1);

namespace Neckarpixel\NpnewsfilterBundle\EventListener;

use Contao\CoreBundle\Security\Authentication\Token\TokenChecker;
use Contao\Date;
use Contao\Module;
use Contao\NewsModel;

/**
 * Grenzt die Nachrichtenliste (newslist) anhand von tl_news.date ein.
 * Ist im Modul kein Zeitfilter gesetzt, wird false zurückgegeben
 * und Contao verwendet die Standard-Abfrage.
 */
class NewsListFilterListener
{
    private $tokenChecker;

    public function __construct(TokenChecker $tokenChecker)
    {
        $this->tokenChecker = $tokenChecker;
    }

    /**
     * Hook: newsListCountItems
     *
     * @return int|false
     */
    public function onNewsListCountItems($newsArchives, $blnFeatured, Module $module)
    {
        $criteria = $this->buildCriteria($newsArchives, $blnFeatured, $module);

        if (null === $criteria) {
            return false;
        }

        return (int) NewsModel::countBy($criteria['columns'], $criteria['values']);
    }

    /**
     * Hook: newsListFetchItems
     *
     * @return \Contao\Model\Collection|null|false
     */
    public function onNewsListFetchItems($newsArchives, $blnFeatured, $limit, $offset, Module $module)
    {
        $criteria = $this->buildCriteria($newsArchives, $blnFeatured, $module);

        if (null === $criteria) {
            return false;
        }

        return NewsModel::findBy($criteria['columns'], $criteria['values'], [
            'order' => $this->getOrder($module),
            'limit' => (int) $limit,
            'offset' => (int) $offset,
        ]);
    }

    /**
     * Baut die WHERE-Bedingungen analog zu NewsModel::findPublishedByPids()
     * plus Datumsbereich. Gibt null zurück, wenn kein Filter aktiv ist.
     */
    private function buildCriteria($newsArchives, $blnFeatured, Module $module): ?array
    {
        $filter = (string) $module->npnf_timeFilter;

        if ('' === $filter || empty($newsArchives) || !\is_array($newsArchives)) {
            return null;
        }

        $range = $this->getRange($filter);

        if (null === $range) {
            return null;
        }

        $t = NewsModel::getTable();
        $columns = ["$t.pid IN(".implode(',', array_map('intval', $newsArchives)).')'];
        $values = [];

        if (true === $blnFeatured) {
            $columns[] = "$t.featured='1'";
        } elseif (false === $blnFeatured) {
            $columns[] = "$t.featured=''";
        }

        if (!$this->tokenChecker->isPreviewMode()) {
            $time = Date::floorToMinute();
            $columns[] = "$t.published='1' AND ($t.start='' OR $t.start<=$time) AND ($t.stop='' OR $t.stop>$time)";
        }

        [$from, $to] = $range;

        if (null !== $from) {
            $columns[] = "$t.date>=?";
            $values[] = $from;
        }

        if (null !== $to) {
            $columns[] = "$t.date<?";
            $values[] = $to;
        }

        return ['columns' => $columns, 'values' => $values];
    }

    /**
     * Liefert [von, bis) als Timestamps. null = offen.
     * Alle relativen Grenzen beziehen sich auf heute 00:00 Uhr,
     * damit "max. 1 Jahr alt" und "älter als 1 Jahr" lückenlos zusammenpassen.
     */
    private function getRange(string $filter): ?array
    {
        $today = strtotime('today');
        $monthStart = strtotime(date('Y-m-01', $today));
        $yearStart = strtotime(date('Y-01-01', $today));

        $relative = [
            '1w' => '-1 week',
            '2w' => '-2 weeks',
            '1m' => '-1 month',
            '3m' => '-3 months',
            '6m' => '-6 months',
            '1y' => '-1 year',
            '2y' => '-2 years',
        ];

        switch ($filter) {
            // Aktuelle Nachrichten: höchstens X alt
            case 'new_1w':
            case 'new_2w':
            case 'new_1m':
            case 'new_3m':
            case 'new_6m':
            case 'new_1y':
            case 'new_2y':
                return [strtotime($relative[substr($filter, 4)], $today), null];

            case 'new_curmonth':
                return [$monthStart, null];

            case 'new_curyear':
                return [$yearStart, null];

            // Ältere Nachrichten: älter als X
            case 'old_1w':
            case 'old_2w':
            case 'old_1m':
            case 'old_3m':
            case 'old_6m':
            case 'old_1y':
            case 'old_2y':
                return [null, strtotime($relative[substr($filter, 4)], $today)];

            case 'old_curmonth':
                return [null, $monthStart];

            case 'old_curyear':
                return [null, $yearStart];

            // Fester Zeitraum
            case 'prev_month':
                return [strtotime('-1 month', $monthStart), $monthStart];

            case 'prev_year':
                return [strtotime('-1 year', $yearStart), $yearStart];
        }

        return null;
    }

    /**
     * Sortierung wie in Contao\ModuleNewsList::fetchItems() (4.13).
     */
    private function getOrder(Module $module): string
    {
        $t = NewsModel::getTable();
        $order = '';

        if ('featured_first' === $module->news_featured) {
            $order .= "$t.featured DESC, ";
        }

        switch ($module->news_order) {
            case 'order_headline_asc':
                $order .= "$t.headline";
                break;

            case 'order_headline_desc':
                $order .= "$t.headline DESC";
                break;

            case 'order_random':
                $order .= 'RAND()';
                break;

            case 'order_date_asc':
                $order .= "$t.date";
                break;

            default:
                $order .= "$t.date DESC";
        }

        return $order;
    }
}
