<?php

namespace App\Models\Admin;

use App\Models\admin\ProductModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Category extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'category_products';
    protected $fillable = [
        'image_category',
        'name_category',
        'slug',
    ];
    function product() {
        return $this->hasMany(ProductModel::class, 'category_id');
    }
}
