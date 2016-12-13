<?php

namespace app\core\component;

use app\core\component\Component;

/**
 *
 * @author Tobi
 */
interface ComponentPack {

    public function renderAll();

    public function render(Component $component);

    public function destroy(Component $component);

    public function destroyAll();
}
