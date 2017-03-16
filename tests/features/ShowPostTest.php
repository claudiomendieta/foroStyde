<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowPostTest extends TestCase {

    public function test_a_user_can_see_a_post() {

        //Having
        
        $user = $this->defaultUser([
            'name' => 'Claudio Mendieta'
        ]);
        
        $post = factory(\App\Post::class)->make([
            'title' => 'Como instalar laravel',
            'content' => 'Este es el contenido del post'
        ]);
        
        $user->posts()->save($post);
        
        //When
        
        $this->visit(route('posts.show',$post))
                ->seeInElement('h1', $post->title)
                ->see($post->comment)
                ->see($post->name);
    }

}