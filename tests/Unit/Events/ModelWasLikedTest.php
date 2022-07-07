<?php

/*
 * This file is part of Laravel Likeable.
 *
 * (c) Anton Komarev <anton@komarev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Igorsgm\Likeable\Tests\Unit\Events;

use Igorsgm\Likeable\Events\ModelWasLiked;
use Igorsgm\Likeable\Tests\Stubs\Models\Entity;
use Igorsgm\Likeable\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class ModelWasLikedTest.
 *
 * @package Igorsgm\Likeable\Tests\Unit\Events
 */
class ModelWasLikedTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_fire_model_was_liked_event()
    {
        $this->expectsEvents(ModelWasLiked::class);

        $entity = factory(Entity::class)->create();
        $entity->like(1);
    }
}
