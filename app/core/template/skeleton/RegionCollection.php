<?php

namespace app\core\template\skeleton;

use app\core\template\skeleton\Region;
use app\core\theme\ThemeManager;
use app\core\Context;
use app\core\component\ComponentProvider;

/**
 * Description of RegionCollection
 *
 * @author adapter
 */
class RegionCollection implements \Countable, \IteratorAggregate {

    use \app\core\template\Displayable;

    /**
     * @var Region[]
     */
    private $regions = array();

    /**
     * @var array
     */
    private $resources = array();

    public function __clone() {
        foreach ($this->regions as $name => $region) {
            $this->regions[$name] = clone $region;
        }
    }

    /**
     * Gets the current RegionCollection as an Iterator that includes all regions.
     *
     * It implements \IteratorAggregate.
     *
     * @see all()
     *
     * @return \ArrayIterator|Region[] An \ArrayIterator object for iterating over regions
     */
    public function getIterator() {
        return new \ArrayIterator($this->regions);
    }

    /**
     * Gets the number of Regions in this collection.
     *
     * @return int The number of regions
     */
    public function count() {
        return count($this->regions);
    }

    /**
     * Adds a region.
     *
     * @param string $name  The region name
     * @param Region  $region A Region instance
     */
    public function add($name, RegionInterface $region) {
        unset($this->regions[$name]);

        $this->regions[$name] = $region;
    }

    /**
     * Returns all regions in this collection.
     *
     * @return Region[] An array of regions
     */
    public function all() {
        return $this->regions;
    }

    /**
     * Gets a region by name.
     *
     * @param string $name The region name
     *
     * @return Region|null A Region instance or null when not found
     */
    public function get($name) {
        return isset($this->regions[$name]) ? $this->regions[$name] : null;
    }

    /**
     * Removes a region or an array of regions by name from the collection.
     *
     * @param string|array $name The region name or an array of region names
     */
    public function remove($name) {
        foreach ((array) $name as $n) {
            unset($this->regions[$n]);
        }
    }

    /**
     * Adds a region collection at the end of the current set by appending all
     * regions of the added collection.
     *
     * @param RegionCollection $collection A RegionCollection instance
     */
    public function addCollection(RegionCollection $collection) {
// we need to remove all regions with the same names first because just replacing them
// would not place the new region at the end of the merged array
        foreach ($collection->all() as $name => $region) {
            unset($this->regions[$name]);
            $this->regions[$name] = $region;
        }

        $this->resources = array_merge($this->resources, $collection->getResources());
    }

    /**
     * Returns an array of resources loaded to build this collection.
     *
     * @return ResourceInterface[] An array of resources
     */
    public function getResources() {
        return array_unique($this->resources);
    }

    public function getContent() {
        foreach ($this->regions as $name => $region) {
            $assign[$name] = $region->getContent();
        }
        return $this->display($assign, 'layout/html.tpl');
    }

}
