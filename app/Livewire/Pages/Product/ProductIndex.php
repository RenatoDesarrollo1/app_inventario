<?php

namespace App\Livewire\Pages\Product;

use App\Models\V1\EnvironmentModel;
use App\Report\Pdf\ProductPdf;
use App\Repository\ProductRepository;
use Illuminate\Support\Collection;
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


    public bool $productSelectedLabelsModal = false;
    public array $headers = [
        ['key' => 'actions', 'label' => ''],
        ['key' => 'avatar', 'label' => 'Imagen'],
        ['key' => 'barcode', 'label' => 'Código', 'filter' => "input", "sort" => true, 'class' => 'min-w-48 max-w-48 w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
        ['key' => 'name', 'label' => 'Producto', 'filter' => "input", "sort" => true, 'class' => 'min-w-48 max-w-48 w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
        ['key' => 'stateprod_name', 'label' => 'Estado', 'class' => 'min-w-48 max-w-48 w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
        ['key' => 'condition_name', 'label' => 'Condición', 'class' => 'min-w-48 max-w-48 w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
        ['key' => 'family_name', 'label' => 'Familia', 'filter' => "input", "sort" => true, 'class' => 'min-w-48 max-w-48 w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
        ['key' => 'class_name', 'label' => 'Clase', 'filter' => "input", "sort" => true, 'class' => 'min-w-48 max-w-48 w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
        ['key' => 'typeprod_name', 'label' => 'Tipo Bien', 'class' => 'min-w-48 max-w-48 w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
        ['key' => 'personnel_name', 'label' => 'Responsable', 'filter' => "input", "sort" => true, 'class' => 'min-w-48 max-w-48 w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
        ['model' => 'environment', 'key' => 'environment_name', 'label' => 'Ambiente', 'filter' => "input", "options" => [["id" => 1, "name" => "Hola"]], "search" => "searchEnvironments", "sort" => true, 'class' => 'min-w-48 max-w-48 w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
        ['key' => 'brand_name', 'label' => 'Marca', 'filter' => "input", "sort" => true, 'class' => 'min-w-48 max-w-48 w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
        ['key' => 'project_name', 'label' => 'Proyecto', 'filter' => "input", "sort" => true, 'class' => 'min-w-48 max-w-48 w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
        ['key' => 'adq_date', 'label' => 'Fecha adquisición', 'class' => 'min-w-48 max-w-48 w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
        ['key' => 'provider_doc', 'label' => 'RUC Proveedor', 'filter' => "input", "sort" => true, 'class' => 'min-w-48 max-w-48 w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
        ['key' => 'provider_name', 'label' => 'Proveedor', 'filter' => "input", "sort" => true, 'class' => 'min-w-48 max-w-48 w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
        ['key' => 'nro_doc', 'label' => 'Nro. Doc', 'class' => 'min-w-48 max-w-48 w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
        ['key' => 'amount', 'label' => 'Monto', 'class' => 'min-w-48 max-w-48 w-48 text-ellipsis overflow-hidden whitespace-nowrap'],
    ];

    public array $selected = [];

    public function desactivate($id = "")
    {
        if ($id != "") {
            $this->selected = array_diff($this->selected, array($id));
        } else {
            $this->selected = [];
        }

        $this->dispatch('getProductsSelectedLabelsModal', productsid: $this->selected);
    }

    public int $perPage = 25;

    public array $sort = ["id" => "DESC"];
    public array $filter = [
        "barcode" => [
            "column" => "barcode",
            "value" => "",
            "operator" => "LIKE"
        ],
        "name" => [
            "column" => "name",
            "value" => "",
            "operator" => "LIKE"
        ],
        "family_name" => [
            "relation" => "family",
            "column" => "name",
            "value" => "",
            "operator" => "LIKE"
        ],
        "class_name" => [
            "relation" => "class",
            "column" => "name",
            "value" => "",
            "operator" => "LIKE"
        ],
        "personnel_name" => [
            "relation" => "personnel",
            "column" => "name",
            "value" => "",
            "operator" => "LIKE"
        ],
        "environment_name" => [
            "relation" => "environment",
            "column" => "name",
            "value" => "",
            "operator" => "LIKE"
        ],
        "brand_name" => [
            "relation" => "brand",
            "column" => "name",
            "value" => "",
            "operator" => "LIKE"
        ],
        "project_name" => [
            "relation" => "project",
            "column" => "name",
            "value" => "",
            "operator" => "LIKE"
        ],
        "provider_name" => [
            "relation" => "provider",
            "column" => "name",
            "value" => "",
            "operator" => "LIKE"
        ],
        "provider_doc" => [
            "relation" => "provider",
            "column" => "doc",
            "value" => "",
            "operator" => "LIKE"
        ]
    ];

    protected ProductRepository $productRepository;

    public int $position = 1;


    // public function mount()
    // {
    //     $this->searchEnvironments();
    // }

    // public function searchEnvironments(string $value = '')
    // {
    //     $selectedOption = EnvironmentModel::whereIn('id', $this->environment_ids)->get();

    //     $this->headers[9]['options'] = EnvironmentModel::query()
    //         ->where('name', 'like', "%$value%")
    //         ->take(5)
    //         ->orderBy('name')
    //         ->get()
    //         ->merge($selectedOption);
    // }

    public string $productid = "";

    public function openModalProductSelectedLabelsModal($productid = "")
    {
        $productsid = [];
        if ($productid != "") {
            $this->productid = $productid;
            $productsid[] = $productid;
        } else {
            $this->productid = "";
            $productsid = $this->selected;
        }
        if (count($productsid) > 0) {
            $this->productSelectedLabelsModal = true;
            $this->dispatch('getProductsSelectedLabelsModal', productsid: $productsid);
        }
    }

    public function closeModalProductSelectedLabelsModal()
    {
        $this->productSelectedLabelsModal = false;
        $this->dispatch('deleteProductsSelectedLabelsModal');
    }


    public function manageSort($property = "", $value = "")
    {
        $this->sort = [];
        if ($property != "") {
            if ($value != "") {
                $this->sort[$property] = $value;
            }
        }
    }

    public function genLabels($id = "")
    {
        $this->closeModalProductSelectedLabelsModal();
        $productsid = [];

        if ($id != "") {
            $productsid[] = $id;
        } else {
            $productsid = $this->selected;
        }
        if (count($productsid) > 0) {
            $productpdf = new ProductPdf();

            $pdf = $productpdf->generateLabels($productsid, $this->position);

            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->stream();
            }, 'etiquetas.pdf');
        }
    }

    public function updatedFilter()
    {
        $this->setPage(1);
    }

    public function render()
    {
        $this->productRepository = new ProductRepository();



        $products = $this->productRepository->getAllPaginated($this->getPage(), $this->perPage, $this->sort, $this->filter);

        return view('livewire.pages.product.product-index', ['products' => $products]);
    }
}
