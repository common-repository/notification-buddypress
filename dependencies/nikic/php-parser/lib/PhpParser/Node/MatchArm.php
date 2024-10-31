<?php
/**
 * @license BSD-3-Clause
 *
 * Modified by notification on 02-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node;

use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node;
use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\NodeAbstract;

class MatchArm extends NodeAbstract {
    /** @var null|list<Node\Expr> */
    public ?array $conds;
    /** @var Node\Expr */
    public Expr $body;

    /**
     * @param null|list<Node\Expr> $conds
     */
    public function __construct(?array $conds, Node\Expr $body, array $attributes = []) {
        $this->conds = $conds;
        $this->body = $body;
        $this->attributes = $attributes;
    }

    public function getSubNodeNames(): array {
        return ['conds', 'body'];
    }

    public function getType(): string {
        return 'MatchArm';
    }
}
