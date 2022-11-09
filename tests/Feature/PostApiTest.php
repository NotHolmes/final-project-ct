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
    }

    public function test_get_post_from_api()
    {
        Post::factory(10)->create();

        $response = $this->get('/api/posts');

        $response->assertStatus(200);

        $responseContent = $response->getContent();
        $responseList = json_decode($responseContent)->data;
        $this->assertEquals(10,collect($responseList)->count());
    }

    public function test_search_posts_with_title_and_found()
    {
        $post = Post::factory()->create([
            'title' => 'test title',
        ]);

        $response = $this->get('/api/posts?search=test');
        $response->assertStatus(200);

        $responseContent = $response->getContent();
        $responseList = json_decode($responseContent)->data;
        $this->assertEquals(1,collect($responseList)->count());
        $this->assertEquals($post->id,collect($responseList)->first()->id);
    }

    public function test_search_posts_with_description_and_found(){
        $post = Post::factory()->create([
            'description' => 'test description',
        ]);

        $response = $this->get('/api/posts?search=test');
        $response->assertStatus(200);

        $responseContent = $response->getContent();
        $responseList = json_decode($responseContent)->data;
        $this->assertEquals(1,collect($responseList)->count());
        $this->assertEquals($post->id,collect($responseList)->first()->id);
    }

    public function test_is_not_lost_post_reward_equals_zero(){
        $post = Post::factory()->create([
            'is_lost' => false,
        ]);

        $response = $this->get('/api/posts');
        $response->assertStatus(200);

        $responseContent = $response->getContent();
        $responseList = json_decode($responseContent)->data;
        $this->assertEquals(1,collect($responseList)->count());
        $this->assertEquals($post->id,collect($responseList)->first()->id);
    }

    public function test_get_nearby_posts(){
        $post = Post::factory()->create([
            'latitude' => 13.7563,
            'longitude' => 100.5018,
        ]);

        $response = $this->get('/api/posts?latitude=13.7563&longitude=100.5018');
        $response->assertStatus(200);

        $responseContent = $response->getContent();
        $responseList = json_decode($responseContent)->data;
        $this->assertEquals(1,collect($responseList)->count());
        $this->assertEquals($post->id,collect($responseList)->first()->id);
    }


}
