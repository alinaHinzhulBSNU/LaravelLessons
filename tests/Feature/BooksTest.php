<?php

namespace Tests\Feature;

use App\User;
use App\Book;
use App\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BooksTest extends TestCase
{
    use RefreshDatabase;

    // Test index function
    /** @test */
    public function logged_in_users_can_see_books_list()
    {
        $this->actingAsUser();
        $response = $this->get('/books')->assertOk();
    }

    /** @test */
    public function logged_out_users_can_not_see_books_list()
    {
        $response = $this->get('/books')->assertRedirect('/login');
    }

    // Test store function
    /** @test */
    public function a_book_can_be_stored_by_admin(){
        $this->actingAsAdmin();
        $data = $this->data(); // Важливо!!!

        $response = $this->post('/books', $data);

        $this->assertDatabaseHas('books', $data);
        $response->assertRedirect('/books');
    }

    /** @test */
    public function a_book_can_not_be_stored_by_user(){
        $this->actingAsUser();
        $response = $this->post('/books', $this->data());

        $this->assertDatabaseMissing('books', $this->data());
        $response->assertRedirect('/books');
    }

    //Test update function
    /** @test */
    public function a_book_can_be_updated_by_admin(){
        $this->actingAsAdmin();

        $book = factory(Book::class)->create();
        $book->save();
        $data = array_merge($this->data(), ['id' => $book->id]);

        $response = $this->patch('/books/'.$book->id, $data);

        $this->assertDatabaseHas('books', $data);
        $response->assertRedirect('/books');
    }

    /** @test */
    public function a_book_can_not_be_updated_by_user(){
        $this->actingAsUser();

        $book = factory(Book::class)->create();
        $book->save();
        $data = array_merge($this->data(), ['id' => $book->id]);

        $response = $this->patch('/books/'.$book->id, $data);

        $this->assertDatabaseMissing('books', $data);
        $response->assertRedirect('/books');
    }

    //Test destroy function
    /** @test */
    public function a_book_can_be_deleted_by_admin(){
        $this->actingAsAdmin();

        $book = factory(Book::class)->create();
        $book->save();

        $response = $this->delete('/books/'.$book->id);

        $this->assertCount(0, Book::all());
        $response->assertRedirect('/books');
    }

    /** @test */
    public function a_book_can_not_be_deleted_by_user(){
        $this->actingAsUser();

        $book = factory(Book::class)->create();
        $book->save();

        $response = $this->delete('/books/'.$book->id);

        $this->assertCount(1, Book::all());
        $response->assertRedirect('/books');
    }

    //Test show function
    /** @test */
    public function logged_in_users_can_see_book(){
        $this->actingAsUser();

        $book = factory(Book::class)->create();
        $book->save();

        $response = $this->get('/books/'.$book->id);

        $response->assertOk();
    }

    /** @test */
    public function logged_out_users_can_not_see_book(){
        $book = factory(Book::class)->create();
        $book->save();

        $response = $this->get('/books/'.$book->id);

        $response->assertRedirect('/login');
    }

    //Test download function
    /** @test */
    public function logged_in_users_can_download_book(){
        $this->actingAsUser();
        $response = $this->get('/books/download')->assertOk();
    }

    /** @test */
    public function logged_out_users_can_not_download_book(){
        $response = $this->get('/books/download')->assertRedirect('/login');
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

    private function data()
    {
        $author = factory(Author::class)->create();

        return [
            'name' => 'testing',
            'author_id' => $author->id,
        ];
    }
}
