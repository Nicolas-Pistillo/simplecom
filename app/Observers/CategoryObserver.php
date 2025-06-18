<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        if ($category->image_url) Storage::delete($category->image_url);
        if ($category->cover_image_url) Storage::delete($category->cover_image_url);

        Product::where('category_id', $category->id)->update(['category_id' => null]);

        if ($category->hasChilds())
        {
            foreach($category->childs as $child)
            {
                Product::where('category_id', $child->id)->update(['category_id' => null]);

                if ($child->image_url) Storage::delete($child->image_url);

                if ($child->cover_image_url) Storage::delete($child->cover_image_url);

                $child->delete();
            }
        }
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        //
    }
}
