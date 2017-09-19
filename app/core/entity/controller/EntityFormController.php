<?php

namespace app\core\entity\controller;


use app\core\http\Request;
use app\core\view\form\Formbuilder;

/**
 *
 * @author joshua
 */
abstract class EntityFormController extends EntityControllerBase {

    abstract public function build(Formbuilder $builder, $entity);

    public function getEntity($entity_id) {
        if ($entity_id === 0) {
            return $this->getDefaults($this->getModel());
        }
        $doctrine = $this->doctrine();
        $entity = $doctrine->find($this->getModel(), $entity_id);
        return $entity;
    }

    public function addEntity($request) {
//        if ($entity_id == 0) {
//            return $this->getDefaults($this->getModel());
//        }
        $doctrine = $this->doctrine();
        if (is_array($this->model())) {
            foreach ($this->model() as $model => $dependencies) {
                $entity = new $model();
//                dump($entity);
                if (is_array($dependencies)) {
                    foreach ($dependencies as $dependency) {
                        foreach ($dependency as $depndency => $property) {
                            if (strpos($property, '|')) {
                                list($map_ppty, $ppty) = explode('|', $property);
                                $ppty = trim($ppty);
                                $map_ppty = trim($map_ppty);
                            } else {
                                $ppty = 'id';
                                $map_ppty = $property;
                            }

                            if (property_exists($model, $map_ppty)) {
                                $map_ppty_object = $doctrine->getRepository($depndency)->findOneBy([$ppty => $request->{$map_ppty}]);
                            }
                            $array_replacing [$map_ppty] = $map_ppty_object;
                        }
                    }
                    $sett = array_replace_recursive($request->all(), $array_replacing);
                }
                foreach ($sett as $key => $value) {
                    $this->object_set($entity, $key, $value);
                }
            }
        }
//        dump(is_object($entity));
//        $doctrine->persist($entity);
//        $doctrine->flush();
    }

    protected function updateEntity(Request $request, $entity_id) {
        $doctrine = $this->doctrine();
        if (is_array($this->model())) {
            foreach ($this->model() as $model => $dependencies) {
                $entity = $doctrine->getRepository($model)->findOneBy(['id' => $entity_id]);
//                dump($entity);
                if (is_array($dependencies)) {
                    foreach ($dependencies as $dependency) {
                        foreach ($dependency as $depndency => $property) {
                            if (strpos($property, '|')) {
                                list($map_ppty, $ppty) = explode('|', $property);
                                $ppty = trim($ppty);
                                $map_ppty = trim($map_ppty);
                            } else {
                                $ppty = 'id';
                                $map_ppty = $property;
                            }

                            if (property_exists($model, $map_ppty)) {
                                $map_ppty_object = $doctrine->getRepository($depndency)->findOneBy([$ppty => $request->{$map_ppty}]);
                            }
                            $array_replacing [$map_ppty] = $map_ppty_object;
                        }
                    }
                    $sett = array_replace_recursive($request->all(), $array_replacing);
                }
                foreach ($sett as $key => $value) {
                    $this->object_set($entity, $key, $value);
                }
            }
        }
        $doctrine->persist($entity);
        $doctrine->flush();
    }

    public function deleteEntity($entity) {
        $doctrine = $this->doctrine();
        $post = $doctrine->find($this->getModel(), $entity);
        if (!$post) {
            throw new \Exception('Post not found');
        }
// Delete the entity and flush
        $doctrine->remove($post);
        $doctrine->flush();
    }

    public function getDefaults($model) {
        $strripos = strripos($model, '\\');
        $len = strlen($model);
        $default = substr($model, $strripos + 1);
        $class = '\app\core\entity\defaults\en\\' . $default;
        return new $class();
    }

    public function create(Request $request, Formbuilder $builder, $entity = 0) {
//        dump($request->all());
        if ($this->validate()) {
            $return['content'] = $this->build($builder, $this->getEntity($entity))->fetch();
            $this->addEntity($request);
            return $return;
        }
    }

    public function update(Request $request, Formbuilder $builder, $entity) {
        if ($this->validate()) {
            $return['content'] = $this->build($builder, $this->getEntity($entity))->fetch();
            $this->updateEntity($request, $entity);
            return $return;
        }
    }

    public function validate() {
        return true;
    }

    public function delete($entity) {
        return $this->deleteEntity($entity);
    }

    /**
     * Get an item from an object using "dot" notation.
     *
     * @param  object $object
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     */
    function object_get($object, $key, $default = null) {
        if (is_null($key) || trim($key) == '') {
            return $object;
        }

        foreach (explode('.', $key) as $segment) {
            if (!is_object($object) || !isset($object->{$segment})) {
                return value($default);
            }

            $object = $object->{$segment};
        }

        return $object;
    }

    /**
     * Get an item from an object using "dot" notation.
     *
     * @param  object $object
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     */
    function object_set($object, $key, $value = null) {
        if (is_null($key) || trim($key) == '') {
            return $object;
        }
        $object = $object->{'set' . ucfirst($key)}($value);
        return $object;
    }

}
