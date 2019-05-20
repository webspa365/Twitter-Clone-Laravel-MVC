<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    protected $table = 'relationships';

    protected $fillable = [
      'follower', 'followed', 'boolean'
    ];
}

/*
public function up()
{
    Schema::create('relationships', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('follower');
        $table->integer('followed');
        $table->boolean('boolean');
        $table->timestamps();
    });
}
*/
