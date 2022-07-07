<?php

/*
 * This file is part of Laravel Likeable.
 *
 * (c) Anton Komarev <anton@komarev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Igorsgm\Likeable\Tests\Unit\Relations;

use Igorsgm\Likeable\Models\LikeCounter;
use Igorsgm\Likeable\Tests\Stubs\Models\Entity;
use Igorsgm\Likeable\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class LikeCounterTest.
 *
 * @package Igorsgm\Likeable\Tests\Unit\Relations
 */
class LikeCounterTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_belong_to_likeable_model()
    {
        $entity = factory(Entity::class)->create();

        $entity->like(1);

        $this->assertInstanceOf(Entity::class, LikeCounter::first()->likeable);
    }
}
