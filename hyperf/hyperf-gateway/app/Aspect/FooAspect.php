<?php

namespace App\Aspect;

use App\Service\TestService;

/**
 * @\Hyperf\Di\Annotation\Aspect
 */
class FooAspect extends \Hyperf\Di\Aop\AbstractAspect
{
    // 要切入的类或 Trait，可以多个，亦可通过 :: 标识到具体的某个方法，通过 * 可以模糊匹配
    public $classes = [
        TestService::class
    ];

    // 要切入的注解，具体切入的还是使用了这些注解的类，仅可切入类注解和类方法注解
    public $annotations = [
//        SomeAnnotation::class,
    ];

    /**
     * @inheritDoc
     */
    public function process(\Hyperf\Di\Aop\ProceedingJoinPoint $proceedingJoinPoint)
    {
        echo 4444;

        $result = $proceedingJoinPoint->process();

        echo 123123;

        // 在调用后进行某些处理
        return $result;

    }
}