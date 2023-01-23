<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Controller;

use App\JsonRpc\CalculatorServiceInterface;
use App\JsonRpc\HyperfHelloAInterface;
use App\Service\TestService;
use Hyperf\CircuitBreaker\Annotation\CircuitBreaker;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use Hyperf\RateLimit\Annotation\RateLimit;
use Hyperf\Retry\Annotation\Retry;
use Hyperf\Retry\Annotation\RetryFalsy;
use Hyperf\Utils\ApplicationContext;

class IndexController extends AbstractController
{
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        $t = new TestService();
        $t->t1();

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
            'm'=>'功能xxx'
        ];
    }

    public function rpc(){
        $client = ApplicationContext::getContainer()->get(CalculatorServiceInterface::class);
        $client2 = ApplicationContext::getContainer()->get(HyperfHelloAInterface::class);
        return [$client->add(1, 1), $client2->getList(101, 'ttt', 2)];
    }

    public function config(){
        return config('nacos_config.bbb');
    }


    public function retry1(){
//        return 111;
        return $this->e1();
    }

    /**
     * @Retry(maxAttempts=3, fallback="App\Controller\IndexController::f1")
     */
    private function e1(){

//        $result = \Hyperf\Retry\Retry::whenReturns(false) // 当返回false时重试
//        ->max(3) // 最多3次
//        ->inSeconds(5) // 最长5秒
//        ->sleep(1) // 间隔1毫秒
//        ->fallback(function(){echo 1111;}) // fallback函数
//        ->call(function(){
////            if (rand(1, 100) >= 20){
////                return true;
////            }
//            return false;
//        });

        throw new \Exception('1111');
//        sleep(20);
        return false;
    }

    public function f1(){
        return ['回退f1'];
    }



    public function cb1(){
        return $this->e2();
    }
    /**
     * @CircuitBreaker(timeout=0.05, failCounter=1, successCounter=1, fallback="App\Controller\IndexController::f1")
     */
    private function e2(){
        sleep(1);
        return ['测试222'];
    }

    /**
     * @RateLimit(create=1, capacity=1,limitCallback={IndexController::class, "limitCallback"})
     */
    public function rl1()
    {
        return ["QPS 1, 峰值3"];
    }

    /**
     * @RateLimit(create=2, consume=2, capacity=4)
     */
    public function rl2()
    {
        return ["QPS 2, 峰值2"];
    }


    public static function limitCallback(float $seconds, ProceedingJoinPoint $proceedingJoinPoint)
    {
        // $seconds 下次生成Token 的间隔, 单位为秒
        // $proceedingJoinPoint 此次请求执行的切入点
        // 可以通过调用 `$proceedingJoinPoint->process()` 继续完成执行，或者自行处理
        echo 111;
        return $proceedingJoinPoint->process();
    }

}
