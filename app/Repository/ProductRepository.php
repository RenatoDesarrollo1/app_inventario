<?php

namespace App\Repository;

use App\Interfaces\ProductInterface;
use App\Models\V1\ProductModel;

class ProductRepository implements ProductInterface
{

    public function getAllPaginated($page, $perPage, $sort, $filter)
    {

        $products = ProductModel::withAggregate('stateprod', 'name')
            ->withAggregate('condition', 'name')
            ->withAggregate('family', 'name')
            ->withAggregate('class', 'name')
            ->withAggregate('typeprod', 'name')
            ->withAggregate('personnel', 'name')
            ->withAggregate('environment', 'name')
            ->withAggregate('brand', 'name')
            ->withAggregate('project', 'name')
            ->withAggregate('provider', 'name')
            ->withAggregate('provider', 'doc');

        if (count($sort) > 0) {
            foreach ($sort as $key => $value) {
                $products = $products->orderBy($key, $value);
            }
        }

        if (count($filter) > 0) {
            foreach ($filter as $key => $item) {
                if ($item["value"] != "") {
                    if (isset($item['relation'])) {
                        $products = $products->whereRelation($item['relation'], $item['column'], $item['operator'], "%" . $item['value'] . "%");
                    } else {
                        $products = $products->where($item['column'], $item['operator'], "%" . $item['value'] . "%");
                    }
                }
            }
        }

        return $products->paginate(perPage: $perPage, page: $page);
    }
}
