<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Address;
use App\Models\Leads;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function address()
    {

        return $this->hasMany(Address::class);
    }
}
