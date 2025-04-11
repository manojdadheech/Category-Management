<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Recursive path for display
    public function getFullPathAttribute()
    {
        return $this->parent ? $this->parent->full_path . ' > ' . $this->name : $this->name;
    }




    public function descendants()
    {
        return $this->children()->with('descendants');
    }

    public function allDescendantIds(): array
    {
        $ids = [];

        foreach ($this->children as $child) {
            $ids[] = $child->id;
            $ids = array_merge($ids, $child->allDescendantIds());
        }

        return $ids;
    }



    public static function buildDropdownOptions($categories, $parentId = null, $prefix = '', $excludedIds = [])
    {
        $options = [];

        foreach ($categories->where('parent_id', $parentId) as $category) {
            if (in_array($category->id, $excludedIds)) {
                continue;
            }

            $options[$category->id] = $prefix . $category->name;

            $children = self::buildDropdownOptions($categories, $category->id, $prefix . '— ', $excludedIds);
            $options += $children;
        }

        return $options;
    }
}
