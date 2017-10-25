<?php

namespace app\core\controller;

use app\core\http\Request;


/**
 * This implementation uses the '_list' request attribute to determine
 * the controller to execute and uses the request attributes to determine
 * the controller method arguments. *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
abstract class ListController extends ControllerBase
{

    protected $headings;
    protected $operations;
    protected $entities = [];
    protected $headOperations;
    private $paginatorData = [];

    public function listing(Request $request)
    {
        $this->init($request);
        $return['library'] = '';
        $return['content'] = $this->renderTrait(
            [
                'title' => $this->title(),
                'headings' => $this->processHead(),
                'form_body' => $this->processBody(),
                'headOperations' => $this->headOperations,
                'paginator' => $this->paginatorData
            ], 'list/listing');
        return $return;
    }

    public function init(Request $request)
    {
        $page = $request->get('page', 1);
        $paginator = $this->doctrine()->getRepository($this->getModel($request))->paginate((int)$page, 5);
        $this->entities = $paginator['data'];
        $this->paginatorData = $paginator['templateData'];
    }

    public function processHead()
    {
        return $this->head();
    }

    abstract function head();

    public function processBody()
    {
        $rows = [];
        foreach ($this->entities as $entity) {
            $rows[] = $this->processRow($entity) + [
                    'operations' => $this->processOperation($entity),
                ];
            $this->headOperations = $this->processHeadOperations($entity);
        }
        return $rows;
    }

    public function processRow($entity)
    {
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

    abstract function row($entity);

    public function processOperation($entity)
    {
        if (!is_null($this->rowOperations($entity)) || !empty($this->rowOperations($entity))) {
            foreach ($this->rowOperations($entity) as $action => $config) {
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

    abstract function rowOperations($entity);

    public function compileOperations($operations)
    {
        //this is done purposely for templates
        $first_template = array_keys($operations);
        $first = array_shift($operations);
        $compiled[] = $this->renderTrait($first + ['first' => true], 'list/operation/' . $first_template[0]);
        if (!empty($operations)) {
            foreach ($operations as $name => $operation) {
                $compiled[] = [
                    'name' => $name,
                    'action' => $this->renderTrait($operation, 'list/operation/' . $name)
                ];
            }
        }
        return $compiled;
    }

    public function processHeadOperations($entity)
    {
        if (!is_null($this->headOperations($entity)) || !empty($this->headOperations($entity))) {
            foreach ($this->headOperations($entity) as $action => $config) {
                if (isset($config['route'])) {
                    $operations[$action]['url'] = $this->generateUrl($config['route'], $config['params'] ?? []);
                }
                if (isset($config['name'])) {
                    $operations[$action]['name'] = $config['name'];
                }
                if (isset($config['icon'])) {
                    $operations[$action]['icon'] = $config['icon'];
                }
            }
            return $operations;
        }
        return null;
    }

    abstract function headOperations($entity);

    abstract function bulkOperation();
}
