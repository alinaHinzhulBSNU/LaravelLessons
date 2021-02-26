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
}
