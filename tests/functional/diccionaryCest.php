<?php

use app\models\Diccionary;
use app\controllers\DiccionaryController;
use yii\helpers\Url;

class diccionaryCest
{
    public function testviewAllPages(FunctionalTester $I){
        $I->amGoingTo('Test Index View Diccionary');
        $I->amOnRoute("diccionary");
        $I->see("Diccionaries", "h1");

        $I->amGoingTo('Test Create View Diccionary');
        $I->click('Create Diccionary');
        $I->see('Create Diccionary','h1');

        $I->amGoingTo('Test View Diccionary');
        $model = new Diccionary(['word' => 'pasado', 'language' => 'EN', 'translate' => 'past']);
        $model->save();
        $I->amOnRoute("diccionary/view", ['id' => $model->id]);
        $I->see($model->id, 'h1');

        $I->amGoingTo('Test Update View Diccionary');
        $I->amOnRoute("diccionary/update", ['id' => $model->id]);
        $I->see($model->id, 'h1');
    }

    public function createRegisterFormTest(FunctionalTester $I){
        $I->amGoingTo('Test Submit Diccionary');
        $I->amOnRoute("diccionary/create");
        $I->fillField('#diccionary-word', 'ads');
        $I->fillField('#diccionary-language', 'EN');
        $I->fillField('#diccionary-translate', 'testeo');
        $I->click('Save');
        $model = Diccionary::findOne(['word'=>'ads']);
        $I->see($model->id,'h1');
        $I->seeResponseCodeIs(200);
    }

    public function createTest(FunctionalTester $I)
    {
        $model = new Diccionary(['word' => 'pasado', 'language' => 'EN', 'translate' => 'past']);
        $model->save();
        $I->amOnRoute("diccionary/view", ['id' => $model->id]);
        $I->seeResponseCodeIs(200);
    }


    public function updateFormTest(FunctionalTester $I){
        $model = new Diccionary(['word' => 'pasado', 'language' => 'EN', 'translate' => 'past']);
        $model->save();
        $I->amOnRoute("diccionary/update", ['id' => $model->id]);
        $I->fillField('#diccionary-word', 'present');
        $I->click('Save');
        $I->see($model->id,'h1');
        $test = Diccionary::findOne(['word'=>'present']);
        $I->see($test->word,'td');
    }

    public function formUpdateFailsTest(FunctionalTester $I){
        $model = new Diccionary(['word' => 'pasado', 'language' => 'EN', 'translate' => 'past']);
        $model->save();
        $I->amOnRoute("diccionary/update", ['id' => $model->id]);
        $I->fillField('#diccionary-word', 'aaa');
        $I->click('Save');
        $I->dontsee($model->word,'td');
    }
        public function TestIncompletandIncorrectForm(\FunctionalTester $I)
        {
            $I->amOnRoute("diccionary/create");
            $I->fillField('#diccionary-word', 'aaa');
            $I->fillField('#diccionary-translate', 'testeo');
            $I->click('Save');
            $I->expectTo('see validations errors');
            $I->see('Create Diccionary', 'h1');
            $I->see('Language cannot be blank');
        }

        public function submitEmptyFormTest(FunctionalTester $I)
            {
                $I->amOnRoute("diccionary/create");
                $I->fillField('#diccionary-word', '');
                $I->fillField('#diccionary-translate', '');
                $I->fillField('#diccionary-language', '');
                $I->click('Save');
                $I->expectTo('see validations errors');
                $I->see('Create Diccionary', 'h1');
                $I->see('Word cannot be blank.');
                $I->see('Language cannot be blank');
                $I->see('Translate cannot be blank.');

            }
        public function duplicateTest(FunctionalTester $I)
        {
                $model = new Diccionary(['word' => 'pasado', 'language' => 'EN', 'translate' => 'past']);
                $model->save();
                $I->amOnRoute("diccionary/create");
                $I->fillField('#diccionary-word', 'pasado');
                $I->fillField('#diccionary-language', 'EN');
                $I->fillField('#diccionary-translate', 'past');
                $I->click('Save');
                $I->see('The combination "pasado"-"EN" of Word and Language has already been taken.', 'div');
        }

        
    
}