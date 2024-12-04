<?php

namespace App\Models\V1;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConditionModel extends Model
{
    use HasUlids, HasFactory;

    protected $table = "inv_conditions";
}