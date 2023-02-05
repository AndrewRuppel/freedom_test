<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface;

class DataController extends Controller
{
    public function getData(RequestInterface $request)
    {
        $queryParams = $request->getQueryParams();

        $page = $queryParams['page'] ?? 1;
        $limit = $queryParams['perPage'] ?? 5;
        $offset = ($page - 1) * $limit;

        $total = $this->db->fetchOne('SELECT COUNT(`id`) as `count` FROM `data`', mode: \PDO::FETCH_COLUMN);
        $items = $this->db->fetchAll('SELECT * FROM `data` LIMIT ? OFFSET ?', ['limit' => $limit, 'offset' => $offset]);

        return [
            'total' => $total,
            'current_page' => (int) $page,
            'next_page' => (($offset + $limit) <= $total) ? $page + 1 : null,
            'prev_page' => (($offset - $limit) >= 0) ? $page - 1 : null,
            'items' => $items,
        ];
    }
}