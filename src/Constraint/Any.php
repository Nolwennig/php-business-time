<?php

namespace BusinessTime\Constraint;

use DateTime;

/**
 * A set of constraints that matches if any of the included constraints matches.
 *
 * This is equivalent to logical OR.
 */
class Any implements BusinessTimeConstraint
{
    use Combinations;

    /** @var BusinessTimeConstraint[] */
    private $constraints;

    /**
     * @param BusinessTimeConstraint[] $constraints
     */
    public function __construct(BusinessTimeConstraint ...$constraints)
    {
        $this->constraints = $constraints;
    }

    /**
     * @param DateTime $time
     *
     * @return bool
     */
    public function isBusinessTime(DateTime $time): bool
    {
        foreach ($this->constraints as $constraint) {
            if ($constraint->isBusinessTime($time)) {
                return true;
            }
        }

        return false;
    }
}