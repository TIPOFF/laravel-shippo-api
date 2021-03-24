<?php

declare(strict_types=1);

namespace Tipoff\LaravelShippoApi\tests\Support\Models\User;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tipoff\LaravelShippoApi\Models\User;
use Tipoff\LaravelShippoApi\Tests\Support\Models\User;

class UserModelTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    /** @test */
    public function create()
    {
        $model = User::factory()->create();
        $this->assertNotNull($model);
    }
}
