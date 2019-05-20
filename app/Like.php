<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';

    protected $fillable = [
      'userId', 'tweetId', 'boolean'
    ];

    protected $attributes = [
    ];
}

/*
public function up()
{
    Schema::create('likes', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('userId');
        $table->integer('tweetId');
        $table->boolean('boolean');
        $table->timestamps();
    });
}
*/
