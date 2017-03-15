<?php

class CreatePostsTest extends FeatureTestCase {

    function test_a_user_create_a_post() {


        //Having
        $title = 'Esta es una preguntax';
        $content = 'Este es el contenidox';

        $this->actingAs($user = $this->defaultUser());

        // When
        $this->visit(route('posts.create'))
                ->type($title, 'title')
                ->type($content, 'content')
                ->press('Publicar');

        // Then
   
        $this->seeInDatabase('posts',[
            'title' => $title,
            'content'=> $content,
            'pending' => true,
            'user_id' => $user->id,
        ]);
        
        // El usuario debe ser redirigido al titulo del post luego de crearlo
        $this->see($title);
        
    }
    
    
    function test_si_el_usuario_esta_logueado_para_crear() {
        //Verificamos que al ingresar sin credenciales se envíe al login
        $this->visit(route('posts.create'))
                ->seePageIs(route('login'));

   
    }
    
    function test_create_post_form_validation(){
        $this->actingAs($this->defaultUser())
                ->visit(route('posts.create'))
                ->press('Publicar')
                ->seePageIs(route('posts.create'))
                ->seeErrors([
                    'title' => 'el campo título es obligatorio',
                    'content' => 'el campo contenido es obligatorio'
                ]);
                
    }

}
