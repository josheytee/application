<?php

namespace app\component\defaultbootstrap\EntityPack\Form;

use app\core\component\Component;

/**
 * Description of List
 *
 * @author Tobi
 */
class Form extends Component {

    public $smarty;
    private $graphql;

    public function __construct($schema = null, $data = null, $options = null) {
        parent::__construct($schema, $data, $options);
    }

    public function init() {
        parent::init();
        $this->smarty = $this->get('SmartyTemplateManagementService');
        $this->graphql = $this->get('Graphql');
        $this->name = 'form';
        $this->pack_name = 'entitypack';
        $this->dir_name = 'defaultbootstrap';
    }

    public function render() {
        $tpl = $this->smarty->createTemplate($this->getTemplatePath('form.tpl'));
        $tpl->assign('schema', $this->schema);
        $tpl->assign('data', $this->data);
        $tpl->assign('options', $this->options);
        $tpl->assign([
            'end' => count($this->data),
        ]);
        return $tpl->fetch();
    }

}
