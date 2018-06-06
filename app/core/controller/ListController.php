<?php

namespace app\core\controller;

use app\core\http\Request;
use Illuminate\Pagination\UrlWindow;


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
    protected $elements;

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
                'paginator' => $this->paginatorData,
                'elements' => $this->elements
            ], 'list/listing');
        return $return;
    }

    public function init(Request $request)
    {
        $page = $request->get('page', 1);
        $s = $this->getModel($request);
        $p = $s::where('shop_id', $this->currentShop()->id)->paginate(3, null, null, $page);
        $window = UrlWindow::make($p);

        $this->elements = array_filter([
            $window['first'],
            is_array($window['slider']) ? '...' : null,
            $window['slider'],
            is_array($window['last']) ? '...' : null,
            $window['last'],
        ]);
        $this->entities = $p;
        $this->paginatorData = $p;

    }

    // Only validates empty or completely associative arrays
    function is_assoc($arr)
    {
        return (is_array($arr) && count(array_filter(array_keys($arr), 'is_string')) == count($arr));
    }

    public function processHead()
    {
        if ($this->is_assoc($this->head()))
            return $this->head();
        return array_map(function ($e) {
            return ucwords($e);
        }, $this->head());
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
