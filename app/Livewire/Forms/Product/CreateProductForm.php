<?php

namespace App\Livewire\Forms\Product;

use App\Models\V1\ProductModel;
use Livewire\Form;
use Mary\Traits\WithMediaSync;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Storage;

class CreateProductForm extends Form
{
    use WithFileUploads, WithMediaSync;

    public string $name = "";
    public string $nro_doc = "";
    public float $amount = 0.00;
    public string $adq_date = "";
    public ?string $personnel_id = null;
    public ?string $environment_id = null;
    public ?string $project_id = null;
    public ?string $provider_id = null;
    public ?string $state_id = null;
    public ?string $condition_id = null;
    public ?string $family_id = null;
    public ?string $class_id = null;
    public ?string $type_prod_id = null;
    public ?string $brand_id = null;
    public string $description = "";
    public $file;


    protected function rules()
    {
        return [
            "name" => ["required", 'max:255'],
            "nro_doc" => ["nullable", 'max:100'],
            "amount" => ["nullable", 'decimal:0,2'],
            "adq_date" => ["nullable", 'date'],
            "description" => ["nullable"],
            "personnel_id" => ["nullable", Rule::exists('inv_personnel', 'id')->where(function (Builder $query) {
                $query->where('state', 1);
            })],
            "environment_id" => ["nullable", Rule::exists('inv_environments', "id")->where(function (Builder $query) {
                $query->where('state', true);
            })],
            "project_id" => ["nullable", Rule::exists('inv_projects', "id")->where(function (Builder $query) {
                $query->where('state', true);
            })],
            "provider_id" => ["nullable", Rule::exists('inv_providers', "id")->where(function (Builder $query) {
                $query->where('state', true);
            })],
            "state_id" => ["nullable", Rule::exists('inv_states', "id")->where(function (Builder $query) {
                $query->where('state', true);
            })],
            "condition_id" => ["nullable", Rule::exists('inv_conditions', "id")->where(function (Builder $query) {
                $query->where('state', true);
            })],
            "family_id" => ["nullable", Rule::exists('inv_families', "id")->where(function (Builder $query) {
                $query->where('state', true);
            })],
            "class_id" => ["nullable", Rule::exists('inv_classes', "id")->where(function (Builder $query) {
                $query->where('state', true);
            })],
            "type_prod_id" => ["nullable", Rule::exists('inv_types_product', "id")->where(function (Builder $query) {
                $query->where('state', true);
            })],
            "brand_id" => ["nullable", Rule::exists('inv_brands', "id")->where(function (Builder $query) {
                $query->where('state', true);
            })],
            "file" => ["nullable", "image", 'max:1024']
        ];
    }

    protected function messages()
    {
        return [
            "name.required" => "El nombre es requerido",
            "name.max" => "El nombre debe tener como máximo 255 carácteres",
            "nro_doc.max" => "El número de documento debe tener como máximo 100 carácteres",
            "amount.decimal" => "El monto debe ser decimal",
            "adq_date.date" => "La fecha de adquisición debe ser una fecha válida",
            "personnel_id.exists" => "El responsable no existe",
            "environment_id.exists" => "El ambiente no existe",
            "project_id.exists" => "El proyecto no existe",
            "provider_id.exists" => "El proveedor no existe",
            "state_id.exists" => "El estado no existe",
            "condition_id.exists" => "La condición no existe",
            "family_id.exists" => "La familia no existe",
            "class_id.exists" => "La clase no existe",
            "type_prod_id.exists" => "El tipo de bien no existe",
            "brand_id.exists" => "La marca no existe",
            "file.image" => "Debe ser una imagen",
            "file.max" => "Máximo 100Kb",
        ];
    }

    public function store()
    {
        $form = new Collection($this->validate());


        if (trim($form["adq_date"]) == "") {
            $form["adq_date"] = null;
        }

        $last = ProductModel::orderBy('id', 'DESC')->first() ?? [];

        $barcodelast = $last->barcode ?? "000000";

        $barcodeint = (int)$barcodelast;

        $newbarcode = str_pad($barcodeint + 1, 6, "0", STR_PAD_LEFT);

        $form["barcode"] = $newbarcode;
        $product = ProductModel::create($form->except("file")->toArray());
        $path = "";
        if (isset($product->id)) {
            $folderPath  = 'public/img/products/' . $product->id;

            if (!Storage::exists($folderPath)) {
                Storage::makeDirectory($folderPath);

                // Asigna permisos al directorio (ejemplo: 0755)
                chmod(storage_path('app/' . $folderPath), 0777);
            }

            if (isset($this->file)) {
                $path = $this->file->storeAs(path: $folderPath, name: "avatar.png");
            }
        }

        return $product;
    }
}
