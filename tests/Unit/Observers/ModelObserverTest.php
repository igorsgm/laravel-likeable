<?php

/*
 * This file is part of Laravel Likeable.
 *
 * (c) Anton Komarev <anton@komarev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Igorsgm\Likeable\Tests\Unit\Observers;

use Igorsgm\Likeable\Contracts\Likeable as LikeableContract;
use Igorsgm\Likeable\Models\Like;
use Igorsgm\Likeable\Models\LikeCounter;
use Igorsgm\Likeable\Observers\ModelObserver;
use Igorsgm\Likeable\Tests\Stubs\Models\Entity;
use Igorsgm\Likeable\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery;

/**
 * Class ModelObserverTest.
 *
 * @package Igorsgm\Likeable\Tests\Unit\Observers
 */
class ModelObserverTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_call_remove_likes_on_model_deleted()
    {
        $observer = new ModelObserver;
        $model = Mockery::mock(LikeableContract::class);
        $model->shouldReceive('removeLikes');
        $observer->deleted($model);
    }

    /** @test */
    public function it_can_omit_call_remove_likes_on_model_deleted()
    {
        $observer = new ModelObserver;
        $model = Mockery::mock(LikeableContract::class);
        $model->removeLikesOnDelete = false;
        $model->shouldNotHaveReceived('removeLikes');
        $observer->deleted($model);
    }

    /** @test */
    public function it_can_delete_likes_with_entity_delete()
    {
        $entity1 = factory(Entity::class)->create();
        $entity2 = factory(Entity::class)->create();

        $entity1->like(1);
        $entity1->like(7);
        $entity1->like(8);
        $entity2->like(1);
        $entity2->like(2);
        $entity2->like(3);
        $entity2->like(4);

        $entity1Likes = $entity1->likes;

        $entity1->delete();

        $entity1Likes = Like::whereIn('id', $entity1Likes->pluck('id'))->get();
        $likeCounter = LikeCounter::all();

        $this->assertCount(0, $entity1Likes);
        $this->assertCount(1, $likeCounter);
    }
}
