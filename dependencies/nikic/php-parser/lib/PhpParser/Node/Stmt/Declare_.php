<?php
/**
 * @license BSD-3-Clause
 *
 * Modified by notification on 02-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node\Stmt;

use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node;
use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node\DeclareItem;

class Declare_ extends Node\Stmt {
    /** @var DeclareItem[] List of declares */
    public array $declares;
    /** @var Node\Stmt[]|null Statements */
    public ?array $stmts;

    /**
     * Constructs a declare node.
     *
     * @param DeclareItem[] $declares List of declares
     * @param Node\Stmt[]|null $stmts Statements
     * @param array<string, mixed> $attributes Additional attributes
     */
    public function __construct(array $declares, ?array $stmts = null, array $attributes = []) {
        $this->attributes = $attributes;
        $this->declares = $declares;
        $this->stmts = $stmts;
    }

    public function getSubNodeNames(): array {
        return ['declares', 'stmts'];
    }

    public function getType(): string {
        return 'Stmt_Declare';
    }
}
