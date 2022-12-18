<?php

namespace Tests\Feature\App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThumbnailControllerTest extends TestCase
{
    use RefreshDatabase;

//    /**
//     * @test
//     * @return void
//     */
    public function it_generated_success(): void
    {
//        $size = '500x500';
//        $method = 'resize';
//        $storage = Storage::disk('images');
//
//        config()->set('thumbnail', ['allowed_sizes' => [$size]]);
//
//        $product = ProductFactory::new()->create();
//
//        $response = $this->get($product->makeThumbnail($size, $method));
//        dd($response);
//
//        $response->assertOk();
//        $storage->assertExists(
//            "products/$method/$size/" . File::basename($product->thumbnail)
//        );
    }
}
