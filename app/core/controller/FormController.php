<?php

namespace app\core\controller;

use app\core\http\Request;
use app\core\utility\ArrayHelper;
use app\core\validation\Validator;
use app\core\view\form\FormBag;
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
    protected $attributes = [];
    protected $redirctUrl = '/';
    protected $redirectRoute = 'admin.index';

    public function create(Request $request, Formbuilder $builder, $id = 0)
    {

        if (!empty($request->all())) {
//            $validator = $this->validate($request->all());
//            $validator->passes() ?
            if ($this->createEntity($request)) {
                $this->redirectToRoute($this->redirectRoute);
            }
//                :$errors = $this->handleValidationErrors($validator);
        }

        $errors = null;
        $formBag = new FormBag();
        $formBag->addStorage($request);
        $return['content'] = $this->build($builder)
            ->setFormBag($formBag)
            ->render();
        return $return;
    }
                

    function validate($all)
    {
        return true;
    }

    public function handleValidate($request, $params = [])
    {
        $validator = new Validator($request->all(), $params ?? []);
        return $validator->passes() ? $this->createEntity($request) :
            $errors = $this->handleValidationErrors($validator);
    }

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
//                    $this->handleFile($entity, $value);
                    continue;
                }
                $this->object_set($entity, $key, $value);
            }
        }
//
        dump($entity);
        dump($request->all());
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
        $object = $object->{'set' . Str::studly($key)}($value);
        return $object;
    }

    public function handleValidationErrors($validator)
    {
        return $validator->errors()->getMessages();
    }

    abstract public function build(Formbuilder $builder);

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
                'action' => '',
                'enctype' => "multipart/form-data"
            ] + $this->attributes);
    }

    public function options($request, $params = [])
    {
        return [
            'file' => true,
            'upload' => function () {

            }
        ];
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

//        if (!empty($request->all())) {
//            $validator = $this->validate($request->all());
//            $validator->passes() ?
//            if ($this->createEntity($request)) {
//                $this->redirectToRoute($this->redirectRoute);
//            }
//                :$errors = $this->handleValidationErrors($validator);
//        }

        $errors = null;
        $formBag = new FormBag();
        $formBag->addStorage($request);
        if ($this->validate($request->all())) {
            $this->process($request);
        }
        $return['content'] = $this->build($builder)
            ->setFormBag($formBag)
            ->render();
        return $return;
    }

    public function process(Request $request)
    {

    }

    public function update(Request $request, Formbuilder $builder, $id)
    {
        if (!empty($request->all())) {
//            $validator = $this->validate($request->all());
//            $validator->passes() ?
            if ($this->updateEntity($request)) {
                $this->redirectToRoute($this->redirectRoute);
            }
//                :$errors = $this->handleValidationErrors($validator);
        }
        $model = $this->getModel($request);
        $errors = null;
        $formBag = new FormBag();
        $formBag->addStorage($request);
        $formBag->addStorage($model::find($id));
        $return['content'] = $this->build($builder)
            ->setFormBag($formBag)
            ->render();
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
