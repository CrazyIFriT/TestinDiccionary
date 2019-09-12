<?php

namespace tests\unit\models;

use app\models\Diccionary;
use app\controllers\DiccionaryController;

class DiccionaryTest extends \Codeception\Test\Unit
{
    private $model;
    /**
     * @var \UnitTester
     */
    public $tester;

    public function testCreateRegister()
    {
        $model = new Diccionary(['word' => 'Hola', 'language' => 'EN', 'translate' => 'hello']);
        $model->save();
        expect(Diccionary::translate("aaaa","EN"))->equals("aaaa");
        expect(Diccionary::translate("hola","EN"))->equals("hello");
    }

    public function testNullRegister()
    {
        $model = new Diccionary();
        expect($model->save())->equals(false);
    }
}
//vendor\bin\codecept run unit tests\unit\models\DiccionaryTest.php