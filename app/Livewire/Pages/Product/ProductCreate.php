<?php

namespace App\Livewire\Pages\Product;

use App\Livewire\Forms\Product\CreateProductForm;
use App\Models\V1\BrandModel;
use App\Models\V1\ClassModel;
use App\Models\V1\ConditionModel;
use App\Models\V1\EnvironmentModel;
use App\Models\V1\FamilyModel;
use App\Models\V1\PersonnelModel;
use App\Models\V1\ProjectModel;
use App\Models\V1\ProviderModel;
use App\Models\V1\StateModel;
use App\Models\V1\TypeProductModel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Mary\Traits\WithMediaSync;

#[Layout('layouts.app')]
#[Title('Añadir activo')]
class ProductCreate extends Component
{

    use WithFileUploads;

    public Collection $personnel;
    public Collection $environments;
    public Collection $projects;
    public Collection $providers;
    public Collection $states;
    public Collection $conditions;
    public Collection $families;
    public Collection $classes;
    public Collection $types_prod;
    public Collection $brands;

    public CreateProductForm $form;



    public function mount(): void
    {
        $this->searchPersonnel();
        $this->searchEnvironments();
        $this->searchProjects();
        $this->searchProviders();
        $this->searchStates();
        $this->searchConditions();
        $this->searchFamilies();
        $this->searchClasses();
        $this->searchTypesProd();
        $this->searchBrands();
    }


    #[On("searchpersonnel_id")]
    public function searchPersonnel(string $value = "", int $take = 10)
    {
        $selectedOption = PersonnelModel::where('id', $this->form->personnel_id)->get();

        $this->personnel = PersonnelModel::query()
            ->where('name', 'like', "%$value%")
            ->take($take)
            ->orderBy('name')
            ->get()
            ->merge($selectedOption);
    }

    #[On("searchenvironments_id")]
    public function searchEnvironments(string $value = "", int $take = 10)
    {
        $selectedOption = EnvironmentModel::where('id', $this->form->environment_id)->get();

        $this->environments = EnvironmentModel::query()
            ->where('name', 'like', "%$value%")
            ->take($take)
            ->orderBy('name')
            ->get()
            ->merge($selectedOption);
    }

    #[On("searchprojects_id")]
    public function searchProjects(string $value = "", int $take = 10)
    {
        $selectedOption = ProjectModel::where('id', $this->form->project_id)->get();

        $this->projects = ProjectModel::query()
            ->where('name', 'like', "%$value%")
            ->take($take)
            ->orderBy('name')
            ->get()
            ->merge($selectedOption);
    }

    #[On("searchproviders_id")]
    public function searchProviders(string $value = "", int $take = 10)
    {
        $selectedOption = ProviderModel::where('id', $this->form->provider_id)->get();

        $this->providers = ProviderModel::query()
            ->where('name', 'like', "%$value%")
            ->take($take)
            ->orderBy('name')
            ->get()
            ->merge($selectedOption);
    }

    #[On("searchstates_id")]
    public function searchStates(string $value = "", int $take = 10)
    {
        $selectedOption = StateModel::where('id', $this->form->state_id)->get();

        $this->states = StateModel::query()
            ->where('name', 'like', "%$value%")
            ->take($take)
            ->orderBy('name')
            ->get()
            ->merge($selectedOption);
    }

    #[On("searchconditions_id")]
    public function searchConditions(string $value = "", int $take = 10)
    {
        $selectedOption = ConditionModel::where('id', $this->form->condition_id)->get();

        $this->conditions = ConditionModel::query()
            ->where('name', 'like', "%$value%")
            ->take($take)
            ->orderBy('name')
            ->get()
            ->merge($selectedOption);
    }

    #[On("searchfamilies_id")]
    public function searchFamilies(string $value = "", int $take = 10)
    {
        $selectedOption = FamilyModel::where('id', $this->form->family_id)->get();

        $this->families = FamilyModel::query()
            ->where('name', 'like', "%$value%")
            ->take($take)
            ->orderBy('name')
            ->get()
            ->merge($selectedOption);
    }

    #[On("searchclasses_id")]
    public function searchClasses(string $value = "", int $take = 10)
    {
        $selectedOption = ClassModel::where('id', $this->form->class_id)->get();

        $this->classes = ClassModel::query()
            ->where('name', 'like', "%$value%")
            ->take($take)
            ->orderBy('name')
            ->get()
            ->merge($selectedOption);
    }

    #[On("searchtypes_prod_id")]
    public function searchTypesProd(string $value = "", int $take = 10)
    {
        $selectedOption = TypeProductModel::where('id', $this->form->type_prod_id)->get();

        $this->types_prod = TypeProductModel::query()
            ->where('name', 'like', "%$value%")
            ->take($take)
            ->orderBy('name')
            ->get()
            ->merge($selectedOption);
    }

    #[On("searchbrands_id")]
    public function searchBrands(string $value = "", int $take = 10)
    {
        $selectedOption = BrandModel::where('id', $this->form->brand_id)->get();

        $this->brands = BrandModel::query()
            ->where('name', 'like', "%$value%")
            ->take($take)
            ->orderBy('name')
            ->get()
            ->merge($selectedOption);
    }

    public function save()
    {
        $product = $this->form->store() ?? [];

        if (isset($product->id)) {
            return $this->redirect('/activos', navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.pages.product.product-create');
    }
}
