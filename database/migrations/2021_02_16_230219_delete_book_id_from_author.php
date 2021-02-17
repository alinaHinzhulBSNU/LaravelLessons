<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteBookIdFromAuthor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('authors', function (Blueprint $table) {
            if (DB::getDriverName() !== 'sqlite') {
                Schema::table('authors', function (Blueprint $table) {
                    $table->dropForeign('authors_book_id_foreign');
                });
            }
            $table->dropColumn('book_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('authors', function (Blueprint $table) {
            //
        });
    }
}
