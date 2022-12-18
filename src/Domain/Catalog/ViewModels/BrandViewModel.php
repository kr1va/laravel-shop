<?php

namespace Domain\Catalog\ViewModels;

use Domain\Catalog\Model\Brand;
use Illuminate\Database\Eloquent\Collection;
use Support\Traits\Makeable;

class BrandViewModel
{
    use Makeable;

    public function homePage(): Collection|array
    {
//        return Cache::rememberForever('brand.home_page', function () {
        return Brand::query()
            ->homePage()
            ->get();
//        });
    }
}
