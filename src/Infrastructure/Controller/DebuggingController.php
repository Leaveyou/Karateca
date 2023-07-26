<?php declare(strict_types=1);

namespace App\Infrastructure\Controller;

use Redis;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class DebuggingController extends AbstractController
{
    /**
     * @Route("/redis", name="redis" )
     */
    public function index(Redis $redis): Response
    {
        $keys = $redis->keys("foo");
        return new JsonResponse($keys);

    }
}
