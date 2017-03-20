<?php


use App\Post;

class ShowPostTest extends FeatureTestCase {

    function test_a_user_can_see_the_post_details() {  

        //Having

        $user = $this->defaultUser([
            'name' => 'Claudio Mendieta'
        ]);

        $post = $this->createPost([
            'title' => 'Como instalar laravel',
            'content' => 'Este es el contenido del post',
            'user_id' => $user->id,
        ]);


        //When

        $this->visit($post->url)
                ->seeInElement('h1', $post->title)
                ->see($post->comment)
                ->see($post->name);
    }

    function test_old_urls_are_redirected() {
        
       
        $post = $this->createPost([
            'title' => 'Old title'
        ]);
        
        
        
        $url = $post->url;
        
        $post->update(['title'=>'New title']);
        
        $this->visit($url)
                ->seePageIs($post->url);
                
                
    }

}
