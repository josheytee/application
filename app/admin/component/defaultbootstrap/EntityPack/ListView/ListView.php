<?php

namespace app\admin\component\defaultbootstrap\EntityPack\ListView;

use app\core\component\Component;

/**
 * Description of List
 *
 * @author Tobi
 */
class ListView extends Component {

    public $smarty;
    private $graphql;

    public function __construct($schema = null, $data = null, $options = null) {
        parent::__construct($schema, $data, $options);
    }

    public function init() {
        parent::init();
        $this->smarty = $this->get('SmartyCustom');
        $this->graphql = $this->get('Graphql');
        $this->name = 'listview';
        $this->pack_name = 'entitypack';
        $this->dir_name = 'defaultbootstrap';
    }

    public function render() {

        $tpl = $this->smarty->createTemplate($this->getTemplatePath('listview.tpl'));
        $tpl->assign('schema', $this->schema);
        $tpl->assign('data', $this->data);
        $tpl->assign('options', $this->options);
        //extract ids form the data array
        $ids = [];
        foreach ($this->data as $id) {
            $ids[] = $id['id'];
        }
        $tpl->assign([
            'end' => count($this->data),
            'ids' => $ids,
        ]);
        return $tpl->fetch();
    }

}
