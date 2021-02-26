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

    /** @test */
    public function logged_out_users_can_not_see_authors_list()
    {
        $this->get('authors')->assertRedirect('/login');
    }
}
