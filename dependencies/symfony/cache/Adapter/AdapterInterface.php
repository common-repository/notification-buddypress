<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Modified by notification on 02-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

namespace BracketSpace\Notification\BuddyPress\Dependencies\Symfony\Component\Cache\Adapter;

use BracketSpace\Notification\BuddyPress\Dependencies\Psr\Cache\CacheItemPoolInterface;
use BracketSpace\Notification\BuddyPress\Dependencies\Symfony\Component\Cache\CacheItem;

// Help opcache.preload discover always-needed symbols
class_exists(CacheItem::class);

/**
 * Interface for adapters managing instances of Symfony's CacheItem.
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
interface AdapterInterface extends CacheItemPoolInterface
{
    /**
     * {@inheritdoc}
     *
     * @return CacheItem
     */
    public function getItem($key);

    /**
     * {@inheritdoc}
     *
     * @return \Traversable<string, CacheItem>
     */
    public function getItems(array $keys = []);

    /**
     * {@inheritdoc}
     *
     * @return bool
     */
    public function clear(string $prefix = '');
}
