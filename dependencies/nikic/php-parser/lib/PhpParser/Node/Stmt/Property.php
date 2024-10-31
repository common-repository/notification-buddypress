<?php
/**
 * @license BSD-3-Clause
 *
 * Modified by notification on 02-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node\Stmt;

use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Modifiers;
use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node;
use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node\ComplexType;
use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node\Identifier;
use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node\Name;
use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node\PropertyItem;

class Property extends Node\Stmt {
    /** @var int Modifiers */
    public int $flags;
    /** @var PropertyItem[] Properties */
    public array $props;
    /** @var null|Identifier|Name|ComplexType Type declaration */
    public ?Node $type;
    /** @var Node\AttributeGroup[] PHP attribute groups */
    public array $attrGroups;

    /**
     * Constructs a class property list node.
     *
     * @param int $flags Modifiers
     * @param PropertyItem[] $props Properties
     * @param array<string, mixed> $attributes Additional attributes
     * @param null|Identifier|Name|ComplexType $type Type declaration
     * @param Node\AttributeGroup[] $attrGroups PHP attribute groups
     */
    public function __construct(int $flags, array $props, array $attributes = [], ?Node $type = null, array $attrGroups = []) {
        $this->attributes = $attributes;
        $this->flags = $flags;
        $this->props = $props;
        $this->type = $type;
        $this->attrGroups = $attrGroups;
    }

    public function getSubNodeNames(): array {
        return ['attrGroups', 'flags', 'type', 'props'];
    }

    /**
     * Whether the property is explicitly or implicitly public.
     */
    public function isPublic(): bool {
        return ($this->flags & Modifiers::PUBLIC) !== 0
            || ($this->flags & Modifiers::VISIBILITY_MASK) === 0;
    }

    /**
     * Whether the property is protected.
     */
    public function isProtected(): bool {
        return (bool) ($this->flags & Modifiers::PROTECTED);
    }

    /**
     * Whether the property is private.
     */
    public function isPrivate(): bool {
        return (bool) ($this->flags & Modifiers::PRIVATE);
    }

    /**
     * Whether the property is static.
     */
    public function isStatic(): bool {
        return (bool) ($this->flags & Modifiers::STATIC);
    }

    /**
     * Whether the property is readonly.
     */
    public function isReadonly(): bool {
        return (bool) ($this->flags & Modifiers::READONLY);
    }

    public function getType(): string {
        return 'Stmt_Property';
    }
}
