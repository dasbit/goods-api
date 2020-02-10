<?php

use App\Models\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\Category;

class CategoriesTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed --class=CategoriesSeeder');
    }

    public function testGetCategoriesTree()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $tree = Category::get()->toTree()->toArray();
        $this->json('GET', '/categories/tree')
            ->seeJson($tree);
    }

    public function testGetCategories()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->json('GET', '/categories')
            ->assertResponseStatus(200);
    }

    public function testCategoryStore()
    {
        $user = factory(User::class)->create(['is_admin' => true]);
        $this->actingAs($user);
        $data = factory(Category::class)->make();
        $data = [
            'name' => $data->name,
            'description' => $data->description,
            'parent_id' => $data->parent_id
        ];
        $this->json('POST', '/categories', $data)->assertResponseStatus(201);
    }

    public function testCategoryUpdate()
    {
        $user = factory(User::class)->create(['is_admin' => true]);
        $this->actingAs($user);
        $category = factory(Category::class)->create();
        $this->json('PUT', "/categories/{$category->id}", [
            'name' => 'new name',
            'description' => 'new description'
        ])->assertResponseStatus(200);
    }

    public function testCategoryDelete()
    {
        $user = factory(User::class)->create(['is_admin' => true]);
        $this->actingAs($user);
        $category = factory(Category::class)->create();
        $this->json('DELETE', "/categories/{$category->id}")
            ->assertResponseStatus(200);
    }
}
