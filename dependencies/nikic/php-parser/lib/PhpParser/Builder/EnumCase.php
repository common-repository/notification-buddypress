<?php
/**
 * @license BSD-3-Clause
 *
 * Modified by notification on 02-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */

declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Builder;

use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser;
use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\BuilderHelpers;
use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node;
use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node\Identifier;
use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node\Stmt;

class EnumCase implements BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Builder {
    /** @var Identifier|string */
    protected $name;
    /** @var ?Node\Expr */
    protected ?Node\Expr $value = null;
    /** @var array<string, mixed> */
    protected array $attributes = [];

    /** @var list<Node\AttributeGroup> */
    protected array $attributeGroups = [];

    /**
     * Creates an enum case builder.
     *
     * @param string|Identifier $name Name
     */
    public function __construct($name) {
        $this->name = $name;
    }

    /**
     * Sets the value.
     *
     * @param Node\Expr|string|int $value
     *
     * @return $this
     */
    public function setValue($value) {
        $this->value = BuilderHelpers::normalizeValue($value);

        return $this;
    }

    /**
     * Sets doc comment for the constant.
     *
     * @param BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Comment\Doc|string $docComment Doc comment to set
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function setDocComment($docComment) {
        $this->attributes = [
            'comments' => [BuilderHelpers::normalizeDocComment($docComment)]
        ];

        return $this;
    }

    /**
     * Adds an attribute group.
     *
     * @param Node\Attribute|Node\AttributeGroup $attribute
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function addAttribute($attribute) {
        $this->attributeGroups[] = BuilderHelpers::normalizeAttribute($attribute);

        return $this;
    }

    /**
     * Returns the built enum case node.
     *
     * @return Stmt\EnumCase The built constant node
     */
    public function getNode(): BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node {
        return new Stmt\EnumCase(
            $this->name,
            $this->value,
            $this->attributeGroups,
            $this->attributes
        );
    }
}
