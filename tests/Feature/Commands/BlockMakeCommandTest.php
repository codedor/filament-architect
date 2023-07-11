<?php

it('can make a block', function () {
    $this->artisan('make:architect-block', ['name' => 'TestBlock'])
        ->assertExitCode(0);

    $this->assertFileExists(base_path('resources/views/architect/test-block.blade.php'));
});
