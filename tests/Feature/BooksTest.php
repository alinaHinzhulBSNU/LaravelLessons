<?php

namespace Tests\Feature;

use App\User;
use App\Book;
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
        $response = $this->get('/author/0/books')->assertOk();
    }

    /** @test */
    public function logged_out_users_can_not_see_books_list()
    {
        $response = $this->get('/author/0/books')->assertRedirect('/login');
    }

    // Supporting functions
    private function actingAsUser()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
    }
}
