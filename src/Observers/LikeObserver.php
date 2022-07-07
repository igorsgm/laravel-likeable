<?php

/*
 * This file is part of Laravel Likeable.
 *
 * (c) Anton Komarev <anton@komarev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Igorsgm\Likeable\Observers;

use Igorsgm\Likeable\Enums\LikeType;
use Igorsgm\Likeable\Events\ModelWasDisliked;
use Igorsgm\Likeable\Events\ModelWasLiked;
use Igorsgm\Likeable\Events\ModelWasUndisliked;
use Igorsgm\Likeable\Events\ModelWasUnliked;
use Igorsgm\Likeable\Contracts\Like as LikeContract;
use Igorsgm\Likeable\Contracts\LikeableService as LikeableServiceContract;

/**
 * Class LikeObserver.
 *
 * @package Igorsgm\Likeable\Observers
 */
class LikeObserver
{
    /**
     * Handle the created event for the model.
     *
     * @param \Igorsgm\Likeable\Contracts\Like $like
     * @return void
     */
    public function created(LikeContract $like)
    {
        if ($like->type_id == LikeType::LIKE) {
            event(new ModelWasLiked($like->likeable, $like->user_id));
            app(LikeableServiceContract::class)->incrementLikesCount($like->likeable);
        } else {
            event(new ModelWasDisliked($like->likeable, $like->user_id));
            app(LikeableServiceContract::class)->incrementDislikesCount($like->likeable);
        }
    }

    /**
     * Handle the deleted event for the model.
     *
     * @param \Igorsgm\Likeable\Contracts\Like $like
     * @return void
     */
    public function deleted(LikeContract $like)
    {
        if ($like->type_id == LikeType::LIKE) {
            event(new ModelWasUnliked($like->likeable, $like->user_id));
            app(LikeableServiceContract::class)->decrementLikesCount($like->likeable);
        } else {
            event(new ModelWasUndisliked($like->likeable, $like->user_id));
            app(LikeableServiceContract::class)->decrementDislikesCount($like->likeable);
        }
    }
}
