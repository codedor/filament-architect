<?php

use Livewire\Livewire;
use Wotz\FilamentArchitect\Tests\Fixtures\Blocks\TestBlock;
use Wotz\FilamentArchitect\Tests\Fixtures\Livewire\ArchitectInputComponent;

beforeEach(function () {
    config(['filament-architect.default-blocks' => [TestBlock::class]]);
});

it('opens the edit block modal after adding the first block', function () {
    $component = Livewire::test(ArchitectInputComponent::class)
        ->call('mountAction', 'addBlock', ['row' => -1], ['schemaComponent' => 'form.body'])
        ->set('mountedActions.0.data.block', 0)
        ->call('callMountedAction');

    $state = $component->get('data.body');

    expect($state)->toHaveCount(1);

    $uuid = array_key_first($state[0]);

    expect($state[0][$uuid])
        ->type->toBe('TestBlock')
        ->width->toBe(12)
        ->data->toBe([]);

    $mountedActions = $component->get('mountedActions');

    expect($mountedActions)->toHaveCount(1)
        ->and($mountedActions[0]['name'])->toBe('editBlock')
        ->and($mountedActions[0]['arguments']['row'])->toBe(0)
        ->and($mountedActions[0]['arguments']['uuid'])->toBe($uuid)
        ->and($mountedActions[0]['arguments']['blockClassName'])->toBe(TestBlock::class)
        ->and($mountedActions[0]['context']['schemaComponent'])->toBe('form.body');
});

it('saves data submitted through the chained edit block modal', function () {
    $component = Livewire::test(ArchitectInputComponent::class)
        ->call('mountAction', 'addBlock', ['row' => -1], ['schemaComponent' => 'form.body'])
        ->set('mountedActions.0.data.block', 0)
        ->call('callMountedAction')
        ->set('mountedActions.0.data.working_title', 'My new block')
        ->call('callMountedAction');

    $state = $component->get('data.body');
    $uuid = array_key_first($state[0]);

    expect($component->get('mountedActions'))->toBeEmpty()
        ->and($state[0][$uuid]['data']['working_title'])->toBe('My new block');
});

it('opens the edit block modal after adding a block below an existing row', function () {
    $component = Livewire::test(ArchitectInputComponent::class)
        ->call('mountAction', 'addBlock', ['row' => -1], ['schemaComponent' => 'form.body'])
        ->set('mountedActions.0.data.block', 0)
        ->call('callMountedAction')
        ->call('unmountAction');

    $component->call('mountAction', 'addBlock', ['row' => 0], ['schemaComponent' => 'form.body'])
        ->set('mountedActions.0.data.block', 0)
        ->call('callMountedAction');

    $state = $component->get('data.body');

    expect($state)->toHaveCount(2);

    $newUuid = array_key_first($state[1]);

    $mountedActions = $component->get('mountedActions');

    expect($mountedActions)->toHaveCount(1)
        ->and($mountedActions[0]['name'])->toBe('editBlock')
        ->and($mountedActions[0]['arguments']['row'])->toBe(1)
        ->and($mountedActions[0]['arguments']['uuid'])->toBe($newUuid);
});

it('opens the edit block modal after adding a block next to an existing block', function () {
    $component = Livewire::test(ArchitectInputComponent::class)
        ->call('mountAction', 'addBlock', ['row' => -1], ['schemaComponent' => 'form.body'])
        ->set('mountedActions.0.data.block', 0)
        ->call('callMountedAction')
        ->call('unmountAction');

    $existingUuid = array_key_first($component->get('data.body')[0]);

    $component->call('mountAction', 'addBlockBetween', ['row' => 0, 'insertAfter' => $existingUuid], ['schemaComponent' => 'form.body'])
        ->set('mountedActions.0.data.block', 0)
        ->call('callMountedAction');

    $state = $component->get('data.body');

    expect($state)->toHaveCount(1)
        ->and($state[0])->toHaveCount(2);

    $newUuid = array_keys($state[0])[1];

    $mountedActions = $component->get('mountedActions');

    expect($mountedActions)->toHaveCount(1)
        ->and($mountedActions[0]['name'])->toBe('editBlock')
        ->and($mountedActions[0]['arguments']['row'])->toBe(0)
        ->and($mountedActions[0]['arguments']['uuid'])->toBe($newUuid);
});
