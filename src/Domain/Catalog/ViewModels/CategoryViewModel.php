<?php

namespace Domain\Catalog\ViewModels;

use Domain\Catalog\Model\Category;
use Illuminate\Database\Eloquent\Collection;
use Support\Traits\Makeable;

class CategoryViewModel
{
    use Makeable;

    public function homePage(): Collection|array
    {
//        return Cache::rememberForever('category.home_page', function () {
        return Category::query()
            ->homePage()
            ->get();
//        });
    }
}
