<?php

namespace ntc\user\form;

use app\core\view\form\FormBuilder;
use app\core\http\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use app\core\controller\FormController;

/**
 * Description of UserForm
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
class AuthForm extends FormController {

  public function __construct() {

  }

  public static function inject(ContainerInterface $container) {
    return new static();
  }

  public function build(FormBuilder $builder) {
    $builder->block(
            $builder->label('username')
            , $builder->text('username', '')->addAttributes(['class' => 'form-control'])
    )->addAttributes(['class' => 'form-group']);
    $builder->block(
            $builder->label('password')
            , $builder->password('password', '')->addAttributes(['class' => 'form-control'])
    )->addAttributes(['class' => 'form-group']);

    $builder->block($builder->submit('authorize', 'Login')->addAttributes(['class' => 'btn btn-primary']))
            ->addAttributes(['class' => 'form-group']);
    return $builder;
  }

  public function formID() {
    return 'user';
  }

  public function process(Request $request) {
    if (!$request->session()->has('logged')) {
      if (isset($request->authorize)) {
        $doctrine = \app\core\Context::getDoctrine();
        $user = $doctrine->getRepository('model\User');
        $data = $user->findOneBy(['username' => $request->username]);
        if ($data) {
          $request->session()->set('logged', $data->id_user);
          $this->redirect('admin.index');
        }
      }
    } else
      $this->redirect('admin.index');
  }

  /**
   * Returns a redirect response object for the specified route.
   *
   * @param string $route_name
   *   The name of the route to which to redirect.
   * @param array $route_parameters
   *   (optional) Parameters for the route.
   *
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   *   A redirect response object that may be returned by the controller.
   */
  public function redirect($route_name, array $route_parameters = []) {
    return \app\core\Context::urlGenerator()->redirect($route_name, $route_parameters);
  }

}
