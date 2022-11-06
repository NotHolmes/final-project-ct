<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use Database\Factories\PostFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostApiTest extends TestCase
{
    protected function setUp() : void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
    }

    public function test_get_post_from_api()
    {
        $user = new User();
        $user->name = "testuser";
        $user->email = 'testuser@api.example.com';
        $user->password = bcrypt('testuserpass');
        $user->save();

        $categories = ['Wallet', 'Purse', 'Key', 'Phone',
            'Tablet', 'Book', 'Laptop', 'Bag', 'Clothes', 'Others'];

        foreach ($categories as $name){
            $category = new Category();
            $category->name = $name;
            $category->save();
        }

        Post::factory(10)->create();

        $response = $this->get('/api/posts');

        $response->assertStatus(200);

        $responseContent = $response->getContent();
        $responseList = json_decode($responseContent)->data;
        $this->assertEquals(10,collect($responseList)->count());
    }
}
