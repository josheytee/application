<?php

namespace app\component\defaultbootstrap\TopNavPanel;

use app\core\component\Component;
use app\core\service\Graphql;

/**
 * Description of TopNavPanel
 *
 * @author adapter
 */
class TopNavPanel extends Component {

    private $smarty;

    public function __construct($schema = null, $data = null, $options = null) {
        parent::__construct($schema, $data, $options);
    }

    public function init() {
        parent::init();
        $this->name = 'TopNavPanel';
        $this->dir_name = 'defaultbootstrap';
        $this->smarty = $this->get("SmartyCustom");
        $this->initialize();
    }

    public function initialize() {
        try {
            $schema = '{  user {    current_shop {      id      name   url }  }}';
            $gr = new Graphql();
            $q = $gr->query($schema);
            $raw = json_decode($q, true);
            $arrayFinder = new \Shudrum\Component\ArrayFinder\ArrayFinder($raw);
            $this->data = $arrayFinder->get('data.user.current_shop');
//            var_dump($this->data);
        } catch (\app\core\exception\GraphqlException $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function render() {
        $tpl = $this->smarty->createTemplate($this->getTemplatePath('TopNavPanel.tpl'));
//        $tpl->assign('schema', $this->schema);
        $tpl->assign('data', $this->data);
//        $tpl->assign('options', $this->options);
        return $tpl->fetch();
    }

}
