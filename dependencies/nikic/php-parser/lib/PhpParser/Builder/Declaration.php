<?php
/**
 * @license BSD-3-Clause
 *
 * Modified by notification on 02-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Builder;

use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser;
use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\BuilderHelpers;

abstract class Declaration implements BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Builder {
    /** @var array<string, mixed> */
    protected array $attributes = [];

    /**
     * Adds a statement.
     *
     * @param BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node\Stmt|BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Builder $stmt The statement to add
     *
     * @return $this The builder instance (for fluid interface)
     */
    abstract public function addStmt($stmt);

    /**
     * Adds multiple statements.
     *
     * @param (BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node\Stmt|BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Builder)[] $stmts The statements to add
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function addStmts(array $stmts) {
        foreach ($stmts as $stmt) {
            $this->addStmt($stmt);
        }

        return $this;
    }

    /**
     * Sets doc comment for the declaration.
     *
     * @param BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Comment\Doc|string $docComment Doc comment to set
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function setDocComment($docComment) {
        $this->attributes['comments'] = [
            BuilderHelpers::normalizeDocComment($docComment)
        ];

        return $this;
    }
}
