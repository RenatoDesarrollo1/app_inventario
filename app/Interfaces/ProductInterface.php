<?php

namespace App\Interfaces;

interface ProductInterface
{

    public function getAllPaginated($page, $perPage, $sort, $filter);
}
