<?php

namespace App\Livewire\Pages\Product;

use App\Report\Pdf\ProductPdf;
use App\Repository\ProductRepository;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Activos')]
class ProductIndex extends Component
{
    use WithPagination, Toast;

    public array $selected = [];
    public int $perPage = 25;

    protected ProductRepository $productRepository;


    public array $sortBy = ['column' => 'id', 'direction' => 'desc'];


    public function genLabels($id = "")
    {
        $productsid = [];

        if ($id != "") {
            $productsid[] = $id;
        } else {
            $productsid = $this->selected;
        }

        if (count($productsid) > 0) {
            $productpdf = new ProductPdf();

            $pdf = $productpdf->generateLabels($productsid);

            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->stream(); // Echo download contents directly...
            }, 'etiquetas.pdf');
        }
    }


    public function render()
    {
        $this->productRepository = new ProductRepository();

        $products = $this->productRepository->getAllPaginated($this->getPage(), $this->perPage, $this->sortBy);

        return view('livewire.pages.product.product-index', ['products' => $products]);
    }
}
