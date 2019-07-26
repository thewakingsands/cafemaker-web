<?php

namespace App\Controller;

use App\Common\Utils\SiteVersion;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->redirect('https://ainou.plus/cafemaker-home', 302);
    }
    
    /**
     * @Route("/.well-known/acme-challenge/{hash}")
     */
    public function le($hash)
    {
        return $this->json(null);
    }

    /**
     * @Route("/discord", name="discord")
     */
    public function discord()
    {
        return $this->redirect('https://ainou.plus/cafemaker-discord', 302);
    }
    
    /**
     * @Route("/404", name="404")
     */
    public function four0four()
    {
        return $this->render('404.html.twig');
    }
    
    /**
     * @Route("/ws", name="ws")
     */
    public function ws()
    {
        // return $this->render('ws.html.twig');
    }
    
    /**
     * @Route("/battlebar", name="battlebar")
     */
    public function battlebar()
    {
        // return $this->render('battle_bar/index.html.twig');
    }

    /**
     * @Route("/version")
     */
    public function version()
    {
        $ver = SiteVersion::get();
        return $this->json([
            'Version'   => $ver->version,
            'Hash'      => $ver->hash,
            'Timestamp' => $ver->time
        ]);
    }
}
