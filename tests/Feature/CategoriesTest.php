<?php

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

it('displays categories', function () {
    $category = \App\Domain\Common\Models\Category::factory()->create();

    $this->get(route('categories'))->assertStatus(200);
});
