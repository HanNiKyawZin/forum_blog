<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // Fix for foreign key
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->string('guest_name');
            $table->text('content');
            $table->unsignedBigInteger('parent_id')->nullable(); // nested reply
            $table->boolean('is_read')->default(false);
            $table->timestamps();

            $table->index('post_id');
            $table->index('parent_id');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');

            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
