<?php
namespace NullDev\TeeGee\TestDomain\TestGen;

class NothingTestMethod
{

    public function render()
    {
        $template = new \Text_Template($this->getTemplatePath());

        $template->setVar(
            [
                'methodName' => 'Nothing'
            ]
        );

        return $template->render();
    }

    protected function getTemplatePath()
    {
        return __DIR__ . '/../TestTemplate/SimpleIncompleteTestMethod.tpl';
    }
}
