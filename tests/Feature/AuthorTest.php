<?php

namespace Tests\Feature;

use App\User;
use App\Book;
use App\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;
    
    protected function setUp():void
    {
        parent::setUp();
        Event::fake();
    }

    /** @test */
    public function logged_out_users_can_not_see_authors_list()
    {
        $response = $this->get('/authors')->assertRedirect('/login');
    }

    /** @test */
    public function logged_in_users_can_see_authors_list()
    {
        $this->actingAs(factory(User::class)->create());
        $response = $this->get('/authors')->assertOk();
    }

    /** @test */
    public function an_author_can_be_added_through_the_form(){
        $this->actingAsAdmin();
        $response = $this->post('/authors', $this->data());
        $this->assertCount(1, \App\Author::all());
    }

    private function actingAsAdmin()
    {
        $this->actingAs(factory(User::class)->create([
            'role' => 'admin',
        ]));
    }

    private function data(){
        return [
            'authorName' => 'test',
            'country' => 'test',
        ];
    }
}
