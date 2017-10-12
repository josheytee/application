<?php

namespace app\core\entity\controller;
use app\core\http\Request;


/**
 * This implementation uses the '_list' request attribute to determine
 * the controller to execute and uses the request attributes to determine
 * the controller method arguments. *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
abstract class EntityListController extends EntityControllerBase {

    protected $headings;
    protected $operations;
    protected $entities = [];

    public function init(Request $request) {
        $doctrine = $this->doctrine();
        $this->entities = $doctrine->getRepository($this->getModel($request))->findAll();
    }

    public function processHead() {
        return $this->head();
    }

    public function processBody() {
        $rows = [];
        foreach ($this->entities as $entity) {
            $rows[] = $this->processRow($entity) + [
                'operations' => $this->processOperation($entity),
            ];
        }
//        dump($rows);
        return $rows;
    }

    public function processRow($entity) {
        $row_array = [];
        foreach ($this->row($entity) as $row => $value) {
            if (is_array($value) && isset($value['callback'])) {
                $row_array[$row] = call_user_func([$this, $value['callback']], $value[0]);
                continue;
            }
            $row_array[$row] = $value;
        }
        return $row_array;
    }

    public function processOperation($entity) {
        if (!is_null($this->defaultOperation($entity)) || !empty($this->defaultOperation($entity))) {
            foreach ($this->defaultOperation($entity) as $action => $config) {
                if (isset($config['route'])) {
                    $operations[$action]['url'] = $this->generateUrl($config['route'], $config['params'] ?? []);
                }
                if (isset($config['name'])) {
                    $operations[$action]['name'] = $config['name'];
                }
            }
            return $this->compileOperations($operations);
        }
        return null;
    }

    public function compileOperations($operations) {
        //this is done purposely for templates
        $first_template = array_keys($operations);
        $first = array_shift($operations);
        $compiled[] = $this->renderTrait($first + ['first' => true], 'list/operation/' . $first_template[0] );
        if (!empty($operations)) {
            foreach ($operations as $name => $operation) {

                $compiled[] = $this->renderTrait($operation, 'list/operation/' . $name );
            }
        }
        return $compiled;
    }

    public function listing(Request $request) {
        $this->init($request);
        $return['library'] = '';
        $return['content'] = $this->renderTrait(
                [
            'headings' => $this->processHead(),
            'form_body' => $this->processBody()
                ], 'list/listing');
        return $return;
    }

    abstract function head();

    abstract function row($entity);

    abstract function bulkOperation();

    abstract function defaultOperation($entity);
}
