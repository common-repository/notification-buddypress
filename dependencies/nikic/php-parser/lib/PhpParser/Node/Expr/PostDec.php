<?php
/**
 * @license BSD-3-Clause
 *
 * Modified by notification on 02-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node\Expr;

use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node\Expr;

class PostDec extends Expr {
    /** @var Expr Variable */
    public Expr $var;

    /**
     * Constructs a post decrement node.
     *
     * @param Expr $var Variable
     * @param array<string, mixed> $attributes Additional attributes
     */
    public function __construct(Expr $var, array $attributes = []) {
        $this->attributes = $attributes;
        $this->var = $var;
    }

    public function getSubNodeNames(): array {
        return ['var'];
    }

    public function getType(): string {
        return 'Expr_PostDec';
    }
}