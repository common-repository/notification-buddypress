<?php
/**
 * @license BSD-3-Clause
 *
 * Modified by notification on 02-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node\Expr;

use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node\Expr;
use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node\InterpolatedStringPart;

class ShellExec extends Expr {
    /** @var (Expr|InterpolatedStringPart)[] Interpolated string array */
    public array $parts;

    /**
     * Constructs a shell exec (backtick) node.
     *
     * @param (Expr|InterpolatedStringPart)[] $parts Interpolated string array
     * @param array<string, mixed> $attributes Additional attributes
     */
    public function __construct(array $parts, array $attributes = []) {
        $this->attributes = $attributes;
        $this->parts = $parts;
    }

    public function getSubNodeNames(): array {
        return ['parts'];
    }

    public function getType(): string {
        return 'Expr_ShellExec';
    }
}