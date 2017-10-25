<?php

namespace app\core\controller;

use app\core\http\Request;
use app\core\http\UploadedFile;
use app\core\utility\ArrayHelper;
use app\core\validation\Validator;
use app\core\view\form\Formbuilder;
use Illuminate\Support\Str;

/**
 * This implementation uses the '_form' request attribute to determine
 * the controller to execute and uses the request attributes to determine
 * the controller method arguments. *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
abstract class FormController extends ControllerBase
{

    use ArrayHelper;

    public function create(Request $request, Formbuilder $builder, $id = 0)
    {
//        dump($request->all());
        $errors = null;
        if (!empty($request->all())) {
            $validator = $this->validate($request->all());
            $validator->passes() ? $this->createEntity($request) :
                $errors = $this->handleValidationErrors($validator);
        }
        $return['content'] = $this->build($builder, $this->getEntity($request, $id))
            ->setErrors($errors)->setAttributes($this->formAttributes())->fetch();
        return $return;
    }

    public function validate($request)
    {
        $validator = new Validator($request, $this->validationRules() ?? []);
        return $validator;
    }

    abstract public function validationRules();

    public function createEntity(Request $request)
    {
        $model = $this->getModel($request);
        $doctrine = $this->doctrine();
        $dependencies = $this->getDependencies();
        $entity = new $model();
//        dump($entity);
        if ($dependencies) {
            if (is_array($dependencies)) {
                foreach ($dependencies as $property => $dependency) {
                    $propertyIdentifier = 'id';
                    $mappedProperty = $property;
                    if (strpos($property, '|')) {
                        list($mappedProperty, $propertyIdentifier) = explode('|', $property);
                        $propertyIdentifier = trim($propertyIdentifier);
                        $mappedProperty = trim($mappedProperty);
                    }
                    if (property_exists($model, $mappedProperty)) {
                        $mappedPropertyObject = $doctrine->getRepository($dependency)->findOneBy([$propertyIdentifier => $request->{$mappedProperty}]);
                        if ($mappedPropertyObject == null)
                            $mappedPropertyObject = new $dependency();
                    }
                    $array_replacing[$mappedProperty] = $mappedPropertyObject;
                }
                $sett = array_replace_recursive($request->all(), $array_replacing);
            }
        } else {
            $sett = $request->all();
        }
        if (isset($sett)) {
            foreach ($sett as $key => $value) {
                if ($key == 'file') {
                    $this->handleFile($entity, $value);
                    continue;
                }
                $this->object_set($entity, $key, $value);
            }
        }
//
//        dump($entity);
//        dump($request->all());
        if (!empty($request->all())) {
            $doctrine->persist($entity);
            $doctrine->flush();
        }
    }

    public function handleFile($entity, UploadedFile $file)
    {
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
        $object = $object->{'set' . Str::studly($key)}($value);
        return $object;
    }

    public function handleValidationErrors($validator)
    {
        return $validator->errors()->getMessages();
    }

    abstract public function build(Formbuilder $builder, $entity);

    public function getEntity(Request $request, $id)
    {
        $model = $this->getModel($request);
        if ($id === 0) {
            return new $model();
        }
        return $this->doctrine()->find($model, $id);
    }

    public function formAttributes()
    {
        return $this->processArray([
                'id' => '',
                'class' => '',
                'method' => 'post',
                'action' => ''
            ] + $this->attributes());
    }

    public function attributes()
    {
        return [];
    }

    /**
     * This is the method for _form routes without _model
     * @param Request $request
     * @param Formbuilder $builder
     * @return mixed
     * @internal param int $entity
     */
    public function add(Request $request, Formbuilder $builder)
    {
        if ($this->validate($request->all())) {
            $this->process($request);
            $return['content'] = $this->build($builder, null)->setAttributes($this->formAttributes())->fetch();
            return $return;
        }
    }

    public function process(Request $request)
    {

    }

    public function update(Request $request, Formbuilder $builder, $id)
    {
        $errors = null;
        if (!empty($request->all())) {
            $validator = $this->validate($request->all());
            $validator->passes() ? $this->updateEntity($request, $id) : $errors = $this->handleValidationErrors($validator);
        }
        $return['content'] = $this->build($builder, $this->getEntity($request, $id))
            ->setErrors($errors)->setAttributes($this->formAttributes())->fetch();
        return $return;
    }

    protected function updateEntity(Request $request, $id)
    {
        $model = $this->getModel($request);
        $key = $request->get('_key');
        $doctrine = $this->doctrine();
        $dependencies = $this->getDependencies();
        $entity = $doctrine->getRepository($model)->findOneBy([$key => $id]);
        if ($dependencies) {
            if (is_array($dependencies)) {
                foreach ($dependencies as $property => $dependency) {
                    $propertyIdentifier = 'id';
                    $mappedProperty = $property;
                    if (strpos($property, '|')) {
                        list($mappedProperty, $propertyIdentifier) = explode('|', $property);
                        $propertyIdentifier = trim($propertyIdentifier);
                        $mappedProperty = trim($mappedProperty);
                    }
                    if (property_exists($model, $mappedProperty)) {
                        $mappedPropertyObject = $doctrine->getRepository($dependency)->findOneBy([$propertyIdentifier => $request->{$mappedProperty}]);
                    }
                    $array_replacing[$mappedProperty] = $mappedPropertyObject;
                }
                $sett = array_replace_recursive($request->all(), $array_replacing);
            }
        } else {
            $sett = $request->all();
        }
        if (isset($sett)) {
            foreach ($sett as $key => $value) {
                $this->object_set($entity, $key, $value);
            }
        }
//        dump($entity);
//        dump($request->all());
        if (!empty($request->all())) {
            $doctrine->flush();
        }
    }

    public function delete(Request $request, $id)
    {
        return $this->deleteEntity($request, $id);
    }

    public function deleteEntity(Request $request, $id)
    {
        $doctrine = $this->doctrine();
        $entity = $doctrine->find($this->getModel($request), $id);
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
