<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductModel extends Model
{
    use HasUlids, HasFactory;

    protected $table = "inv_products";

    protected $guarded = [
        "id"
    ];

    public function stateprod(): BelongsTo
    {
        return $this->belongsTo(StateModel::class, 'state_id', 'id');
    }

    public function condition(): BelongsTo
    {
        return $this->belongsTo(ConditionModel::class, 'condition_id', 'id');
    }

    public function family(): BelongsTo
    {
        return $this->belongsTo(FamilyModel::class, 'family_id', 'id');
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }

    public function typeprod(): BelongsTo
    {
        return $this->belongsTo(TypeProductModel::class, 'type_prod_id', 'id');
    }

    public function personnel(): BelongsTo
    {
        return $this->belongsTo(PersonnelModel::class, 'personnel_id', 'id');
    }

    public function enviroment(): BelongsTo
    {
        return $this->belongsTo(EnvirommentModel::class, 'enviroment_id', 'id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(EnvirommentModel::class, 'brand_id', 'id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(EnvirommentModel::class, 'project_id', 'id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(EnvirommentModel::class, 'provider_id', 'id');
    }
}
