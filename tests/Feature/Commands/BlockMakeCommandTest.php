<?php

use function Spatie\Snapshots\{assertMatchesFileSnapshot};

it('can make a block', function () {
    $this->artisan('make:architect-block', ['name' => 'TestBlock'])
        ->assertSuccessful();

    $this->assertFileExists($this->architectClassPath('TestBlock.php'));
    $this->assertFileExists($this->architectViewPath('test-block.blade.php'));

    assertMatchesFileSnapshot($this->architectClassPath('TestBlock.php'));
    assertMatchesFileSnapshot($this->architectViewPath('test-block.blade.php'));
});

it('will not make the block if file already exists', function () {
    mkdir($this->architectClassPath(), 0777, true);

    file_put_contents($this->architectClassPath('TestBlock.php'), 'test');

    $this->artisan('make:architect-block', ['name' => 'TestBlock'])
        ->assertSuccessful();
});

it('will throw error if block is made, but view already exists', function () {
    mkdir($this->architectViewPath(), 0777, true);

    file_put_contents($this->architectViewPath('test-block.blade.php'), 'test');

    $this->artisan('make:architect-block', ['name' => 'TestBlock'])
        ->expectsOutputToContain('View already exists.')
        ->assertOk();
});

it('can use custom stub path', function () {
    $stubPath = base_path('stubs');
    mkdir($stubPath, 0777, true);

    file_put_contents($stubPath . '/architect-block.stub', 'test');

    $this->artisan('make:architect-block', ['name' => 'TestBlock'])
        ->assertOk();

    assertMatchesFileSnapshot($this->architectClassPath('TestBlock.php'));
});
