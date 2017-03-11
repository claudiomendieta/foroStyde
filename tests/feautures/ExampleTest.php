<?php


class ExampleTest extends FeatureTextCase {
    

    function test_basic_example() {
        $user = factory(\App\User::class)->create([
            'name' => 'Claudio Mendieta',
            'email' => 'claudiomendieta@gmail.com'
        ]);

        $this->actingAs($user, 'api')
                ->visit('api/user')
                ->see('Claudio Mendieta')
                ->see('claudiomendieta@gmail.com');
    }

}
