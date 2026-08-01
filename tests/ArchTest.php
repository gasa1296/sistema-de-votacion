<?php

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

arch('models extend the base model')
    ->expect('App\Models')
    ->toExtend(Model::class);

arch('controllers extend the base controller')
    ->expect('App\Http\Controllers')
    ->toExtend(Controller::class);

arch('factories extend the base factory')
    ->expect('Database\Factories')
    ->toExtend(Factory::class);

arch('jobs are queueable')
    ->expect('App\Jobs')
    ->toImplement(ShouldQueue::class);

arch('no debugging statements')
    ->expect('App')
    ->not->toUse(['dd', 'dump', 'var_dump', 'ray', 'sleep']);
