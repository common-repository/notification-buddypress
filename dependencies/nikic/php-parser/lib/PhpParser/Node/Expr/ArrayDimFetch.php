<?php
/**
 * @license BSD-3-Clause
 *
 * Modified by notification on 02-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node\Expr;

use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node\Expr;

class ArrayDimFetch extends Expr {
    /** @var Expr Variable */
    public Expr $var;
    /** @var null|Expr Array index / dim */
    public ?Expr $dim;

    /**
     * Constructs an array index fetch node.
     *
     * @param Expr $var Variable
     * @param null|Expr $dim Array index / dim
     * @param array<string, mixed> $attributes Additional attributes
     */
    public function __construct(Expr $var, ?Expr $dim = null, array $attributes = []) {
        $this->attributes = $attributes;
        $this->var = $var;
        $this->dim = $dim;
    }

    public function getSubNodeNames(): array {
        return ['var', 'dim'];
    }

    public function getType(): string {
        return 'Expr_ArrayDimFetch';
    }
}