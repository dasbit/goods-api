<?php

use App\Models\Good;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Models\User;
use App\Models\Category;

class GoodsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed --class=CategoriesSeeder');
        $this->artisan('db:seed --class=GoodsSeeder');
    }

    public function testIndex()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->json('GET', '/goods')
            ->assertResponseStatus(200);
    }

    public function testStore()
    {
        $user = factory(User::class)->create(['is_admin' => true]);
        $this->actingAs($user);
        $data = factory(Good::class)->make();
        $data = [
            'title' => $data->title,
            'price' => $data->price,
            'description' => $data->description,
            'category_id' => $data->category_id,
            'tags' => $data->tags,
        ];
        $this->json('POST', '/goods', $data)->assertResponseStatus(201);
    }

    public function testUpdate()
    {
        $user = factory(User::class)->create(['is_admin' => true]);
        $this->actingAs($user);
        $good = factory(Good::class)->create();
        $this->json('PUT', "/goods/{$good->id}", [
            'title' => 'new title',
            'description' => 'new description',
            'tags' => ['new tag', 'new another tag']
        ])->assertResponseStatus(200);
    }

    public function testDelete()
    {
        $user = factory(User::class)->create(['is_admin' => true]);
        $this->actingAs($user);
        $good = factory(Good::class)->create();
        $this->json('DELETE', "/goods/{$good->id}")
            ->assertResponseStatus(200);
    }
}
