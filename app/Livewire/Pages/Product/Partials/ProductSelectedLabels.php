<?php

namespace App\Livewire\Pages\Product\Partials;

use App\Models\V1\ProductModel;
use Livewire\Attributes\On;
use Livewire\Component;

class ProductSelectedLabels extends Component
{
    public array $products = [];

    #[On('getProductsSelectedLabelsModal')]
    public function getProducts($productsid)
    {
        $this->products = [];
        $this->products = ProductModel::select('id', 'barcode', 'name')->whereIn('id', $productsid)->take(value: 50)->get()->toArray();
    }

    #[On('deleteProductsSelectedLabelsModal')]
    public function deleteProducts()
    {
        $this->products = [];
    }

    public function render()
    {


        return view('livewire.pages.product.partials.product-selected-labels');
    }
}
