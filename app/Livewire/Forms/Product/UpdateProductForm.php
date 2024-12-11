<?php

namespace App\Livewire\Forms\Product;

use App\Models\V1\ProductModel;
use Livewire\Form;
use Mary\Traits\WithMediaSync;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UpdateProductForm extends Form
{
    use WithFileUploads, WithMediaSync;

    public string $id = "";
    public ?string $name = "";
    public ?string $barcode = "";
    public ?string $nro_doc = "";
    public ?float $amount = 0.00;
    public ?string $adq_date = "";
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
    public ?string $description = "";
    public $file;


    protected function rules()
    {
        return [
            "id" => ["required"],
            "name" => ["required", 'max:255'],
            "barcode" => ["nullable"],
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

    public function setProduct(string $id = "")
    {
        $product = ProductModel::where('id', $id)->first();
        if (isset($product->id)) {
            $this->id = $product->id;
            $this->name = $product->name;
            $this->barcode = $product->barcode;
            $this->nro_doc = $product->nro_doc;
            $this->amount = $product->amount;
            $this->adq_date = $product->adq_date;
            $this->personnel_id = $product->personnel_id;
            $this->environment_id = $product->environment_id;
            $this->project_id = $product->project_id;
            $this->provider_id = $product->provider_id;
            $this->state_id = $product->state_id;
            $this->condition_id = $product->condition_id;
            $this->family_id = $product->family_id;
            $this->class_id = $product->class_id;
            $this->type_prod_id = $product->type_prod_id;
            $this->brand_id = $product->brand_id;
            $this->description = $product->description;
        }
    }

    public function store()
    {
        $form = new Collection($this->validate());


        if (trim($form["adq_date"]) == "") {
            $form["adq_date"] = null;
        }


        $product = ProductModel::find($this->id);
        $product->id = $form['id'];
        $product->name = $form['name'];
        $product->barcode = $form['barcode'];
        $product->nro_doc = $form['nro_doc'];
        $product->amount = $form['amount'];
        $product->adq_date = $form['adq_date'];
        $product->personnel_id = $form['personnel_id'];
        $product->environment_id = $form['environment_id'];
        $product->project_id = $form['project_id'];
        $product->provider_id = $form['provider_id'];
        $product->state_id = $form['state_id'];
        $product->condition_id = $form['condition_id'];
        $product->family_id = $form['family_id'];
        $product->class_id = $form['class_id'];
        $product->type_prod_id = $form['type_prod_id'];
        $product->brand_id = $form['brand_id'];
        $product->description = $form['description'];

        if ($product->save()) {
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
}
