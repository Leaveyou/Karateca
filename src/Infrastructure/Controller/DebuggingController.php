<?php declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Domain\ApplicationUser;
use App\Domain\RedisPartyStorage;
use Redis;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class DebuggingController extends AbstractController
{
    /**
     * @Route("/redis_keys", name="redis_keys" )
     */
    public function index(Redis $redis): Response
    {
        $keys = $redis->keys("*");
        return new JsonResponse($keys);
    }

    /**
     * @Route("/redis_add_party", name="redis_add_party" )
     */
    public function add_party(Redis $redis): Response
    {
        $partyStorage = new RedisPartyStorage($redis);
        $interactor = new ApplicationUser($partyStorage);

        $interactor->throwParty();
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/redis_clear_all", name="redis_clear_all" )
     */
    public function clear_everything(Redis $redis): Response
    {
        $redis->flushDB();
        return $this->redirectToRoute('homepage');
    }
}
