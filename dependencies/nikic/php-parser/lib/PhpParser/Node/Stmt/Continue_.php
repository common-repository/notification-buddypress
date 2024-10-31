<?php
/**
 * @license BSD-3-Clause
 *
 * Modified by notification on 02-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node\Stmt;

use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node;

class Continue_ extends Node\Stmt {
    /** @var null|Node\Expr Number of loops to continue */
    public ?Node\Expr $num;

    /**
     * Constructs a continue node.
     *
     * @param null|Node\Expr $num Number of loops to continue
     * @param array<string, mixed> $attributes Additional attributes
     */
    public function __construct(?Node\Expr $num = null, array $attributes = []) {
        $this->attributes = $attributes;
        $this->num = $num;
    }

    public function getSubNodeNames(): array {
        return ['num'];
    }

    public function getType(): string {
        return 'Stmt_Continue';
    }
}
