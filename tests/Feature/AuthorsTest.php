<?php

namespace Tests\Feature;

use App\User;
use App\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorsTest extends TestCase
{
    use RefreshDatabase;

    // Test index function
    /** @test */
    public function logged_in_users_can_see_authors_list()
    {
        $this->actingAsUser();
        $response = $this->get('/authors')->assertOk();
    }

    /** @test */
    public function logged_out_users_can_not_see_authors_list()
    {
        $response = $this->get('/authors')->assertRedirect('/login');
    }

    // Test store function
    /** @test */
    public function an_author_can_be_stored_by_admin(){
        $this->actingAsAdmin();
        $response = $this->post('/authors', $this->data());

        $this->assertDatabaseHas('authors', $this->data());
        $response->assertRedirect('/authors');
    }

    /** @test */
    public function an_author_can_not_be_stored_by_user(){
        $this->actingAsUser();
        $response = $this->post('/authors', $this->data());

        $this->assertDatabaseMissing('authors', $this->data());
        $response->assertRedirect('/authors');
    }

    //Test update function
    /** @test */
    public function an_author_can_be_updated_by_admin(){
        $this->actingAsAdmin();

        $author = factory(Author::class)->create();
        $author->save();

        $response = $this->patch('/authors/'.$author->id, 
            array_merge($this->data(), ['id' => $author->id]));

        $this->assertDatabaseHas('authors', array_merge($this->data(), ['id' => $author->id]));
        $response->assertRedirect('/authors');
    }

    /** @test */
    public function an_author_can_not_be_updated_by_user(){
        $this->actingAsUser();

        $author = factory(Author::class)->create();
        $author->save();

        $response = $this->patch('/authors/'.$author->id, 
            array_merge($this->data(), ['id' => $author->id]));

        $this->assertDatabaseMissing('authors', array_merge($this->data(), ['id' => $author->id]));
        $response->assertRedirect('/authors');
    }

    //Test destroy function
    /** @test */
    public function an_author_can_be_deleted_by_admin(){
        $this->actingAsAdmin();

        $author = factory(Author::class)->create();
        $author->save();

        $this->delete('/authors/'.$author->id);

        $this->assertCount(0, Author::all());
    }

    /** @test */
    public function an_author_can_not_be_deleted_by_user(){
        $this->actingAsUser();

        $author = factory(Author::class)->create();
        $author->save();

        $this->delete('/authors/'.$author->id);

        $this->assertCount(1, Author::all());
    }

    //Test show function
    /** @test */
    public function logged_in_users_can_see_author(){
        $this->actingAsUser();

        $author = factory(Author::class)->create();
        $author->save();

        $response = $this->get('/authors/'.$author->id);

        $response->assertOk();
    }

    /** @test */
    public function logged_out_users_can_not_see_author(){
        $author = factory(Author::class)->create();
        $author->save();

        $response = $this->get('/authors/'.$author->id);

        $response->assertRedirect('/login');
    }

    // Supporting functions
    private function actingAsAdmin()
    {
        $admin = factory(User::class)->create(['role' => 'admin']);
        $this->actingAs($admin);
    }
    
    private function actingAsUser()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
    }

    private function data(){
        return [
            "authorName" => "testing",
            "country" => "testing",
        ];
    }
}
