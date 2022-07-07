<?php

/*
 * This file is part of Laravel Likeable.
 *
 * (c) Anton Komarev <anton@komarev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Igorsgm\Likeable\Tests\Unit;

use Igorsgm\Likeable\Exceptions\LikerNotDefinedException;
use Igorsgm\Likeable\Tests\Stubs\Models\Entity;
use Igorsgm\Likeable\Tests\Stubs\Models\User;
use Igorsgm\Likeable\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class LikerNotDefinedExceptionTest.
 *
 * @package Igorsgm\Likeable\Tests\Unit\Exceptions
 */
class LikerNotDefinedExceptionTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_throw_exception_if_not_authenticated_on_like()
    {
        $this->expectException(LikerNotDefinedException::class);

        $entity = factory(Entity::class)->create();

        $entity->like();
    }

    /** @test */
    public function it_can_throw_exception_if_authenticated_but_passed_zero_on_like()
    {
        $this->expectException(LikerNotDefinedException::class);

        $entity = factory(Entity::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $entity->like(0);
    }

    /** @test */
    public function it_can_throw_exception_if_not_authenticated_on_unlike()
    {
        $this->expectException(LikerNotDefinedException::class);

        $entity = factory(Entity::class)->create();

        $entity->unlike();
    }

    /** @test */
    public function it_can_throw_exception_if_authenticated_but_passed_zero_on_unlike()
    {
        $this->expectException(LikerNotDefinedException::class);

        $entity = factory(Entity::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $entity->unlike(0);
    }

    /** @test */
    public function it_can_throw_exception_if_not_authenticated_on_where_liked_by()
    {
        $this->expectException(LikerNotDefinedException::class);

        Entity::whereLikedBy();
    }

    /** @test */
    public function it_can_throw_exception_if_authenticated_but_passed_zero_on_where_liked_by()
    {
        $this->expectException(LikerNotDefinedException::class);

        $user = factory(User::class)->create();
        $this->actingAs($user);

        Entity::whereLikedBy(0);
    }
}
