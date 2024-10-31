<?php
/**
 * @license BSD-3-Clause
 *
 * Modified by notification on 02-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node\Stmt;

use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node\Name;
use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node\Stmt;
use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node\UseItem;

class GroupUse extends Stmt {
    /**
     * @var Use_::TYPE_* Type of group use
     */
    public int $type;
    /** @var Name Prefix for uses */
    public Name $prefix;
    /** @var UseItem[] Uses */
    public array $uses;

    /**
     * Constructs a group use node.
     *
     * @param Name $prefix Prefix for uses
     * @param UseItem[] $uses Uses
     * @param Use_::TYPE_* $type Type of group use
     * @param array<string, mixed> $attributes Additional attributes
     */
    public function __construct(Name $prefix, array $uses, int $type = Use_::TYPE_NORMAL, array $attributes = []) {
        $this->attributes = $attributes;
        $this->type = $type;
        $this->prefix = $prefix;
        $this->uses = $uses;
    }

    public function getSubNodeNames(): array {
        return ['type', 'prefix', 'uses'];
    }

    public function getType(): string {
        return 'Stmt_GroupUse';
    }
}