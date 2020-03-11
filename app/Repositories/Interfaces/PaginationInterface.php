<?php

namespace App\Repositories\Interfaces;

interface PaginationInterface
{
    /**
     * Get limit for pagination
     */
    public function getLimit(): int;

    /**
     * Get offset for pagination
     */
    public function getOffset(): int;

    /**
     * Get last ID
     */
    public function getLastId(): int;
}
