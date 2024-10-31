<?php
/**
 * @license BSD-3-Clause
 *
 * Modified by notification on 02-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node\Stmt;

use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node;

class TraitUse extends Node\Stmt {
    /** @var Node\Name[] Traits */
    public array $traits;
    /** @var TraitUseAdaptation[] Adaptations */
    public array $adaptations;

    /**
     * Constructs a trait use node.
     *
     * @param Node\Name[] $traits Traits
     * @param TraitUseAdaptation[] $adaptations Adaptations
     * @param array<string, mixed> $attributes Additional attributes
     */
    public function __construct(array $traits, array $adaptations = [], array $attributes = []) {
        $this->attributes = $attributes;
        $this->traits = $traits;
        $this->adaptations = $adaptations;
    }

    public function getSubNodeNames(): array {
        return ['traits', 'adaptations'];
    }

    public function getType(): string {
        return 'Stmt_TraitUse';
    }
}