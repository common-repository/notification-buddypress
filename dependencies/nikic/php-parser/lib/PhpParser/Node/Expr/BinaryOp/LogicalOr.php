<?php
/**
 * @license BSD-3-Clause
 *
 * Modified by notification on 02-October-2024 using {@see https://github.com/BrianHenryIE/strauss}.
 */ declare(strict_types=1);

namespace BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node\Expr\BinaryOp;

use BracketSpace\Notification\BuddyPress\Dependencies\PhpParser\Node\Expr\BinaryOp;

class LogicalOr extends BinaryOp {
    public function getOperatorSigil(): string {
        return 'or';
    }

    public function getType(): string {
        return 'Expr_BinaryOp_LogicalOr';
    }
}