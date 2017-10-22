<?php

namespace app\core\entity\controller;


use app\core\http\Request;
use app\core\view\form\Formbuilder;

/**
 *
 * @author joshua
 */
abstract class EntityFormController extends EntityControllerBase
{

    public function create(Request $request, Formbuilder $builder, $entity = 0)
    {
//        dump($request->all());
        if ($this->validate()) {
            $return['content'] = $this->build($builder, $this->getEntity($request, $entity))->fetch();
            $this->addEntity($request);
            return $return;
        }
    }

    public function validate()
    {
        return true;
    }

    abstract public function build(Formbuilder $builder, $entity);

    public function getEntity(Request $request, $entity_id)
    {
        if ($entity_id === 0) {
            return $this->getDefaults($this->getModel($request));
        }
        $doctrine = $this->doctrine();
        $entity = $doctrine->find($this->getModel($request), $entity_id);
        return $entity;
    }

    public function getDefaults($model)
    {
        $strripos = strripos($model, '\\');
        $len = strlen($model);
        $default = substr($model, $strripos + 1);
        $class = '\app\core\entity\defaults\en\\' . $default;
        return new $class();
    }

    public function addEntity(Request $request)
    {
        $model = $this->getModel($request);
        $doctrine = $this->doctrine();
        $dependencies = $this->getDependencies();

        $entity = new $model();
//        dump($entity);
        if ($dependencies) {
            if (is_array($dependencies)) {
                foreach ($dependencies as $dependency => $property) {
                    if (strpos($property, '|')) {
                        list($map_ppty, $ppty) = explode('|', $property);
                        $ppty = trim($ppty);
                        $map_ppty = trim($map_ppty);
                    } else {
                        $ppty = 'id';
                        $map_ppty = $property;
                    }

                    if (property_exists($model, $map_ppty)) {
                        $map_ppty_object = $doctrine->getRepository($dependency)->findOneBy([$ppty => $request->{$map_ppty}]);
                    }
                    $array_replacing [$map_ppty] = $map_ppty_object;
                }
                $sett = array_replace_recursive($request->all(), $array_replacing);
            }
        }
        if (isset($sett)) {
            foreach ($sett as $key => $value) {
                $this->object_set($entity, $key, $value);
            }
        }

//        dump($entity);
//        dump(is_object($entity));
        if (!empty($request->all())) {
            $doctrine->persist($entity);
            $doctrine->flush();
        }
    }

    /**
     * Get an item from an object using "dot" notation.
     *
     * @param  object $object
     * @param  string $key
     * @param null $value
     * @internal param mixed $default
     * @return mixed
     */
    function object_set($object, $key, $value = null)
    {
        if (is_null($key) || trim($key) == '') {
            return $object;
        }
        $object = $object->{'set' . ucfirst($key)}($value);
        return $object;
    }

    /**
     * This is the method for _form routes without _model
     * @param Request $request
     * @param Formbuilder $builder
     * @param int $entity
     * @return mixed
     */
    public function add(Request $request, Formbuilder $builder)
    {
        if ($this->validate()) {
            $return['content'] = $this->build($builder, $this->getEntity($request))->fetch();
            $this->addEntity($request);
            return $return;
        }
    }

    public function update(Request $request, Formbuilder $builder, $entity)
    {
        if ($this->validate()) {
            $return['content'] = $this->build($builder, $this->getEntity($request, $entity))->fetch();
            $this->updateEntity($request, $entity);
            return $return;
        }
    }

    protected function updateEntity(Request $request, $entity_id)
    {
        $model = $this->getModel($request);
        $key = $request->get('_key');
        $doctrine = $this->doctrine();
        $dependencies = $this->getDependencies();
        $entity = $doctrine->getRepository($model)->findOneBy([$key => $entity_id]);
        if ($dependencies) {
            if (is_array($dependencies)) {
                foreach ($dependencies as $dependency => $property) {
                    if (strpos($property, '|')) {
                        list($map_ppty, $ppty) = explode('|', $property);
                        $ppty = trim($ppty);
                        $map_ppty = trim($map_ppty);
                    } else {
                        $ppty = 'id';
                        $map_ppty = $property;
                    }

                    if (property_exists($model, $map_ppty)) {
                        $map_ppty_object = $doctrine->getRepository($dependency)->findOneBy([$ppty => $request->{$map_ppty}]);
                    }
                    $array_replacing [$map_ppty] = $map_ppty_object;
                }
            }
            $sett = array_replace_recursive($request->all(), $array_replacing);
            foreach ($sett as $key => $value) {
                $this->object_set($entity, $key, $value);
            }
        }
        if (!empty($request->all())) {
            $doctrine->persist($entity);
            $doctrine->flush();
        }
    }

    public function delete($entity)
    {
        return $this->deleteEntity($entity);
    }

    public function deleteEntity(Request $request, $entity)
    {
        $doctrine = $this->doctrine();
        $entity = $doctrine->find($this->getModel($request), $entity);
        if (!$entity) {
            throw new \Exception('Entity not found');
        }
// Delete the entity and flush
        $doctrine->remove($entity);
        $doctrine->flush();
    }

    /**
     * Get an item from an object using "dot" notation.
     *
     * @param  object $object
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     */
    function object_get($object, $key, $default = null)
    {
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

}
