<?php

namespace App\Services\Maintenance\Ticket;

use App\Models\Ticket\Category;

class CategoryService
{
    private $category;

    /**
     * Creates a category
     *
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes)
    {
        $this->category = Category::create([
            'name' => $attributes['name'],
            'description' => $attributes['description'],
            'parent_id' => $attributes['parent_category'] ?? null,
        ]);

        return $this;
    }

    /**
     * Update a category
     *
     * @param array $attributes
     * @param integer $categoryId
     * @return mixed
     */
    public function update($attributes, $categoryId)
    {
        $this->category = Category::findOrFail($categoryId);
        $this->category->update([
            'name' => $attributes['name'],
            'description' => $attributes['description'],
            'parent_id' => $attributes['parent_category'] ?? null,
        ]);

        return $this;
    }

    /**
     * Remove category
     *
     * @param integer $categoryId
     * @return mixed
     */
    public function remove($categoryId)
    {
        Category::findOrFail((integer) $categoryId)->delete();
    }
}
