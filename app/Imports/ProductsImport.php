<?php

namespace App\Imports;

use App\Models\V1\BrandModel;
use App\Models\V1\ClassModel;
use App\Models\V1\ConditionModel;
use App\Models\V1\EnvironmentModel;
use App\Models\V1\FamilyModel;
use App\Models\V1\PersonnelModel;
use App\Models\V1\ProductModel;
use App\Models\V1\ProjectModel;
use App\Models\V1\ProviderModel;
use App\Models\V1\StateModel;
use App\Models\V1\TypeProductModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Str;

class ProductsImport implements ToCollection
{
    protected function setStates(Collection $rows)
    {

        $stateNames = $rows->pluck(2)->unique();

        $existingstates = StateModel::whereIn('name', $stateNames)->pluck('id', 'name');

        $newstateNames = $stateNames->diff($existingstates->keys());

        $newstates = $newstateNames->map(fn($name) => ['id' => strtolower((string) Str::ulid()), 'name' => $name]);
        StateModel::insert($newstates->toArray());

        return StateModel::whereIn('name', $stateNames)->pluck('id', 'name');
    }

    protected function setConditions(Collection $rows)
    {

        $conditionNames = $rows->pluck(3)->unique();

        $existingconditions = ConditionModel::whereIn('name', $conditionNames)->pluck('id', 'name');

        $newconditionNames = $conditionNames->diff($existingconditions->keys());

        $newconditions = $newconditionNames->map(fn($name) => ['id' => strtolower((string) Str::ulid()), 'name' => $name]);
        ConditionModel::insert($newconditions->toArray());

        return ConditionModel::whereIn('name', $conditionNames)->pluck('id', 'name');
    }

    protected function setFamilies(Collection $rows)
    {

        $familyNames = $rows->pluck(4)->unique();

        $existingfamilies = FamilyModel::whereIn('name', $familyNames)->pluck('id', 'name');

        $newfamilyNames = $familyNames->diff($existingfamilies->keys());

        $newfamilies = $newfamilyNames->map(fn($name) => ['id' => strtolower((string) Str::ulid()), 'name' => $name]);
        FamilyModel::insert($newfamilies->toArray());

        return FamilyModel::whereIn('name', $familyNames)->pluck('id', 'name');
    }

    protected function setClasses(Collection $rows)
    {

        $classNames = $rows->pluck(5)->unique();

        $existingClasses = ClassModel::whereIn('name', $classNames)->pluck('id', 'name');

        $newclassNames = $classNames->diff($existingClasses->keys());

        $newClasses = $newclassNames->map(fn($name) => ['id' => strtolower((string) Str::ulid()), 'name' => $name]);
        ClassModel::insert($newClasses->toArray());

        return ClassModel::whereIn('name', $classNames)->pluck('id', 'name');
    }

    protected function setTypesProd(Collection $rows)
    {

        $typeProdNames = $rows->pluck(6)->unique();

        $existingTypesProd = TypeProductModel::whereIn('name', $typeProdNames)->pluck('id', 'name');

        $newtypeProdNames = $typeProdNames->diff($existingTypesProd->keys());

        $newTypesProd = $newtypeProdNames->map(fn($name) => ['id' => strtolower((string) Str::ulid()), 'name' => $name]);
        TypeProductModel::insert($newTypesProd->toArray());

        return TypeProductModel::whereIn('name', $typeProdNames)->pluck('id', 'name');
    }

    protected function setPersonnel(Collection $rows)
    {

        $personnelNames = $rows->pluck(7)->unique();

        $existingPersonnel = PersonnelModel::whereIn('name', $personnelNames)->pluck('id', 'name');

        $newpersonnelNames = $personnelNames->diff($existingPersonnel->keys());

        $newPersonnel = $newpersonnelNames->map(fn($name) => ['id' => strtolower((string) Str::ulid()), 'name' => $name]);
        PersonnelModel::insert($newPersonnel->toArray());

        return PersonnelModel::whereIn('name', $personnelNames)->pluck('id', 'name');
    }

    protected function setEnvironments(Collection $rows)
    {

        $enviromentNames = $rows->pluck(8)->unique();

        $existingenvironments = EnvironmentModel::whereIn('name', $enviromentNames)->pluck('id', 'name');

        $newenviromentNames = $enviromentNames->diff($existingenvironments->keys());

        $newenvironments = $newenviromentNames->map(fn($name) => ['id' => strtolower((string) Str::ulid()), 'name' => $name]);
        EnvironmentModel::insert($newenvironments->toArray());

        return EnvironmentModel::whereIn('name', $enviromentNames)->pluck('id', 'name');
    }

    protected function setBrands(Collection $rows)
    {

        $brandNames = $rows->pluck(9)->unique();

        $existingBrands = BrandModel::whereIn('name', $brandNames)->pluck('id', 'name');

        $newBrandNames = $brandNames->diff($existingBrands->keys());

        $newBrands = $newBrandNames->map(fn($name) => ['id' => strtolower((string) Str::ulid()), 'name' => $name]);
        BrandModel::insert($newBrands->toArray());

        return BrandModel::whereIn('name', $brandNames)->pluck('id', 'name');
    }

    protected function setProjects(Collection $rows)
    {
        $projectNames = new Collection();
        $projectNamesarr = $rows->pluck(10)->unique();
        foreach ($projectNamesarr as $key => $value) {
            $projectNames[$key] = preg_replace('/\s+/', ' ', $value);
        }

        $existingprojects = ProjectModel::whereIn('name', $projectNames)->pluck('id', 'name');

        $newprojectNames = $projectNames->diff($existingprojects->keys());

        $newprojects = $newprojectNames->map(fn($name) => ['id' => strtolower((string) Str::ulid()), 'name' => preg_replace('/\s+/', ' ', $name)]);
        ProjectModel::insert($newprojects->toArray());

        return ProjectModel::whereIn('name', $projectNames)->pluck('id', 'name');
    }

    protected function setProviders(Collection $rows)
    {

        $providerDocs = $rows->pluck(12)->unique();
        $providerNames = $rows->pluck(13)->unique();

        $existingproviders = ProviderModel::whereIn('doc', $providerDocs)->pluck('id', 'doc');

        $newproviderDocs = $providerDocs->diff($existingproviders->keys());

        $newproviders = $newproviderDocs->map(fn($doc, $key) => ['id' => strtolower((string) Str::ulid()), 'doc' => $doc, 'name' => $providerNames[$key]]);
        ProviderModel::insert($newproviders->toArray());

        return ProviderModel::whereIn('doc', $providerDocs)->pluck('id', 'doc');
    }


    public function collection(Collection $rows)
    {
        $rows->shift();

        $allStates = $this->setStates($rows);
        $allConditions = $this->setConditions($rows);
        $allFamilies = $this->setFamilies($rows);
        $allClasses = $this->setClasses($rows);
        $allTypesProd = $this->setTypesProd($rows);
        $allPersonnel = $this->setPersonnel($rows);
        $allEnvironments = $this->setEnvironments($rows);
        $allBrands = $this->setBrands($rows);
        $allProjects = $this->setProjects($rows);
        $allProviders = $this->setProviders($rows);

        $productsToInsert = $rows->map(function ($row) use ($allStates, $allConditions, $allFamilies, $allClasses, $allTypesProd, $allPersonnel, $allEnvironments, $allBrands, $allProjects, $allProviders) {
            return [
                'id' => strtolower((string) Str::ulid()),
                'barcode' => str_pad($row[0], 6, "0", STR_PAD_LEFT),
                'name' => $row[1],
                'state_id' => $allStates[$row[2]],
                'condition_id' => $allConditions[$row[3]],
                'family_id' => $allFamilies[$row[4]],
                'class_id' => $allClasses[$row[5]],
                'type_prod_id' => $allTypesProd[$row[6]],
                'personnel_id' => $allPersonnel[$row[7]],
                'environment_id' => $allEnvironments[$row[8]],
                'brand_id' => $allBrands[$row[9]],
                'project_id' => $allProjects[preg_replace('/\s+/', ' ', $row[10])],
                'adq_date' => $row[11],
                'provider_id' => $allProviders[$row[12]],
                'nro_doc' => $row[14],
                'amount' => $row[15],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });

        ProductModel::insert($productsToInsert->toArray());
    }

    public function chunkSize(): int
    {
        return 200;
    }
}
