<?php

namespace app\core\access;

/**
 * Accesscheckers is responsible for managing access to modules ,route and the app as a whole
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail dot com>
 */
class AccessCheckerCollector
{
    protected $checkers;
    protected $sorted_checkers;

    public function __construct()
    {
    }

    public function addChecker(AccessCheckerInterface $checkers, $priority)
    {
        $this->checkers[$priority][] = $checkers;
// Force the resolvers to be re-sorted.
        $this->sorted_checkers = NULL;

    }

    public function getSortedCheckers()
    {
        if (!isset($this->sorted_checkers)) {
// Sort the negotiators according to priority.
            krsort($this->checkers);
// Merge nested negotiators from $this->negotiators into
// $this->sortedNegotiators.
            $this->sorted_checkers = array();
            foreach ($this->checkers as $checker) {
                $this->sorted_checkers = array_merge($this->sorted_checkers, $checker);
            }
        }
        return $this->sorted_checkers;
    }

}
