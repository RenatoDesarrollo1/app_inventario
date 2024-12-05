<?php

namespace App\Repository;

use App\Interfaces\ProductInterface;
use App\Models\V1\ProductModel;

class ProductRepository implements ProductInterface
{

    public function getAllPaginated($page, $perPage, $sortBy)
    {

        return ProductModel::withAggregate('stateprod', 'name')
            ->withAggregate('condition', 'name')
            ->withAggregate('family', 'name')
            ->withAggregate('class', 'name')
            ->withAggregate('typeprod', 'name')
            ->withAggregate('personnel', 'name')
            ->withAggregate('environment', 'name')
            ->withAggregate('brand', 'name')
            ->withAggregate('project', 'name')
            ->withAggregate('provider', 'name')
            ->withAggregate('provider', 'doc')
            ->orderBy(...array_values($sortBy))
            ->paginate(perPage: $perPage, page: $page);
    }
}
