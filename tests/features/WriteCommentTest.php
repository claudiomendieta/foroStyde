<?php

class WriteCommentTest extends FeatureTestCase {

    function test_a_user_cant_write_a_comment() {
        $post = $this->createPost();

        $this->actingAs($this->defaultUser())
                ->visit($post->url)
                ->type('Un comentario', 'comment')
                ->press('Publicar comentario');
    }

}
