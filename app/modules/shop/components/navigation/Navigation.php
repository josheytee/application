<?php

namespace ntc\shop\navigation;

use app\core\component\Component;
use app\core\entity\Section;
use app\core\http\Request;
use app\core\view\form\Formbuilder;

class Navigation extends Component
{

    private $themeManager;

    public function init()
    {
//        dump($this->themeManager());
        $this->themeManager = $this->themeManager();
    }

    public function configure(Request $request, Formbuilder $builder)
    {
//        $builder->sett
        $builder->block(
            $builder->label('name')
            , $builder->text('name')->addAttributes(['class' => 'form-control'])
        )->addAttributes(['class' => 'form-group']);

        $builder->block($builder->submit('Save')->addAttributes(['class' => 'btn btn-primary']))
            ->addAttributes(['class' => 'form-group']);
        return $builder->fetch();
    }

    public function processConfigure(Request $request, Formbuilder $builder)
    {

        if ($request->isValid(['name' => 'required']) === true) {
            dump($request->all());
            $this->themeManager->setConfig(['components' => [$this->getName() => $request->name]]);
        }
    }

    public function render()
    {
//        dump($this->currentShop());
//        dump($this->doctrine()->createQuery('SELECT s FROM app\core\entity\Section s WHERE s.shop =' . $this->currentShop()->getId())->getResult());
        $sections =[];

        $query = $this->doctrine()->createQuery('SELECT s FROM app\core\entity\Section s WHERE s.shop ='
            . $this->currentShop()->getId());
        $repo = $this->doctrine()->getRepository(Section::class);
//        $query = $this->doctrine()
//            ->createQueryBuilder()
//            ->select('node')
//            ->from(Section::class, 'node')
//            ->orderBy('node.root, node.lft', 'ASC')
//            ->where('node.root = 1')
//            ->getQuery()
//        ;
//        $options = array('decorate' => true);
//        $sections = $repo->buildTree($query->getArrayResult());
//        dump($sections);

        return $this->display('ntc/shop/navigation', compact('sections'));
    }

}
