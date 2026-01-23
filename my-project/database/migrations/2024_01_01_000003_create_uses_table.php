<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('uses', function (Blueprint $table) {
            $table->id();                      
            $table->unsignedBigInteger('thing_id'); 
            $table->unsignedBigInteger('place_id'); 
            $table->unsignedBigInteger('user_id');  
            $table->integer('amount')->default(1); 
            $table->timestamps();             
            
            $table->foreign('thing_id')         
                ->references('id')                
                ->on('things')                 
                ->onDelete('cascade');          
            
            $table->foreign('place_id')            
                ->references('id')
                ->on('places')
                ->onDelete('cascade');
            
            $table->foreign('user_id')          
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            
            $table->unique(['thing_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('uses');              
    }
};