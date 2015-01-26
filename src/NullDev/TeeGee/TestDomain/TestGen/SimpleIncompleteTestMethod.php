<?php
namespace NullDev\TeeGee\TestDomain\TestGen;

class SimpleIncompleteTestMethod
{

    public function render($method)
    {
        $template = new \Text_Template($this->getTemplatePath());

        $template->setVar(
            [
                'methodName' => ucfirst($method->name)
            ]
        );

        return $template->render();
    }

    protected function getTemplatePath()
    {
        return __DIR__ . '/../TestTemplate/SimpleIncompleteTestMethod.tpl';
    }
}
