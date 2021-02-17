<?php

namespace Tests\Feature;

use App\User;
use App\Book;
use App\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class BooksTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp():void
    {
        parent::setUp();
        Event::fake();
    }

    /** @test */
    public function logged_out_users_can_not_see_books_list()
    {
        $response = $this->get('/author/0/books')->assertRedirect('/login');
    }

    /** @test */
    public function logged_in_users_can_see_books_list()
    {
        $this->actingAs(factory(User::class)->create());
        $response = $this->get('/author/0/books')->assertOk();
    }

    /** @test */
    public function a_book_can_be_added_through_the_form(){
        $this->actingAsAdmin();

        $response = $this->post('/author/0/books', $this->data());

        $this->assertCount(1, Book::all());
    }

    /** @test */
    public function a_name_is_requered(){
        $this->actingAsAdmin();

        $response = $this->post('/author/0/books', array_merge($this->data(), ['name' => '']));
        $response->assertSessionHasErrors('name');

        $this->assertCount(0, \App\Book::all());
    }

    /** @test */
    public function a_name_is_at_lest_3_characters(){
        $this->actingAsAdmin();

        $response = $this->post('/author/0/books', array_merge($this->data(), ['name' => 'a']));
        $response->assertSessionHasErrors('book-name');

        $this->assertCount(0, \App\Book::all());
    }

    private function actingAsAdmin()
    {
        $this->actingAs(factory(User::class)->create([
            'role' => 'admin',
        ]));
    }

    private function data(){
        return [
            'book-name' => 'test',
            'book-author' => 1,
        ];
    }
}
