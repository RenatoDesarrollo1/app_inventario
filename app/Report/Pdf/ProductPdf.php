<?php

namespace App\Report\Pdf;

use App\Models\V1\ProductModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Picqer\Barcode\BarcodeGeneratorPNG;

class ProductPdf
{

    public function generateLabels(array $productsid)
    {

        $products = ProductModel::select('id', 'barcode', 'name')->whereIn('id', $productsid)->take(100)->get()->toArray();

        $start = 1;

        if ($start == 1) {
            if (count($products) == 1) {
                $products[] = [];
                $products[] = [];
            } else if (count($products) == 2) {
                $products[] = [];
            }
        } else if ($start == 2) {

            if (count($products) == 1) {
                $products[] = [];
            }

            array_unshift($products, []);
        } else if ($start == 3) {
            array_unshift($products, []);
            array_unshift($products, []);
        }

        $c = 1;
        $group = [];
        foreach ($products as $key => $item) {

            $generator = new BarcodeGeneratorPNG();

            $barcode64 = base64_encode($generator->getBarcode($item['barcode'], $generator::TYPE_CODE_128));
            $item['barcode64'] = $barcode64;
            
            $group[] = $item;

            if ($c == 3) {
                $productssplitted[] = $group;
                $c = 0;
                $group = [];
            } else if ($key == (count($products) - 1)) {
                $productssplitted[] = $group;
                $c = 0;
                $group = [];
            }


            $c++;
        }

        $pdf = Pdf::setPaper([0, 0, 242.362204, 37.020472], 'portrait')
            ->loadView(
                'livewire.pdf.product.product-labels',
                [
                    'data' => $productssplitted
                ]
            );

        return $pdf;
    }
}
