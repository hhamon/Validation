<?php

namespace Respect\Validation\Rules;

use SplObjectStorage;
use Countable;

/**
 * Base class for composite rules.
 */
abstract class AbstractComposite implements RuleInterface, Countable
{
    /**
     * @var SplObjectStorage
     */
    private $rules;

    public function __construct()
    {
        foreach (func_get_args() as $rule) {
            $this->addRule($rule);
        }
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->getRules()->count();
    }

    /**
     * @param RuleInterface $rule
     * @param string        $ruleName
     *
     * @return self
     */
    public function addRule(RuleInterface $rule)
    {
        $this->getRules()->attach($rule);

        return $this;
    }

    /**
     * @return SplObjectStorage
     */
    public function getRules()
    {
        if (!$this->rules instanceof SplObjectStorage) {
            $this->rules = new SplObjectStorage();
        }

        return $this->rules;
    }
}