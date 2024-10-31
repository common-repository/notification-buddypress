<?php
/**
 * @license BSD-3-Clause
 *
 * Modified by notification on 02-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node\Expr;

use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node;
use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node\MatchArm;

class Match_ extends Node\Expr {
    /** @var Node\Expr Condition */
    public Node\Expr $cond;
    /** @var MatchArm[] */
    public array $arms;

    /**
     * @param Node\Expr $cond Condition
     * @param MatchArm[] $arms
     * @param array<string, mixed> $attributes Additional attributes
     */
    public function __construct(Node\Expr $cond, array $arms = [], array $attributes = []) {
        $this->attributes = $attributes;
        $this->cond = $cond;
        $this->arms = $arms;
    }

    public function getSubNodeNames(): array {
        return ['cond', 'arms'];
    }

    public function getType(): string {
        return 'Expr_Match';
    }
}
