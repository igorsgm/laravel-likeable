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

use Igorsgm\Likeable\Contracts\Likeable as LikeableContract;

/**
 * Class ModelObserver.
 *
 * @package Igorsgm\Likeable\Observers
 */
class ModelObserver
{
    /**
     * Handle the deleted event for the model.
     *
     * @param \Igorsgm\Likeable\Contracts\Likeable $likeable
     * @return void
     */
    public function deleted(LikeableContract $likeable)
    {
        if (!$this->removeLikesOnDelete($likeable)) {
            return;
        }

        $likeable->removeLikes();
    }

    /**
     * Should remove likes on model delete (defaults to true).
     *
     * @param \Igorsgm\Likeable\Contracts\Likeable $likeable
     * @return bool
     */
    protected function removeLikesOnDelete(LikeableContract $likeable)
    {
        return isset($likeable->removeLikesOnDelete) ? $likeable->removeLikesOnDelete : true;
    }
}
