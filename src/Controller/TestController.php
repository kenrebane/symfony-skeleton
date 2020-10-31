<?php

namespace App\Controller;

use App\Client\VwsClient;
use App\Payment\PayseraPayment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    private $client;

    public function __construct(VwsClient $client)
    {
        $this->client = $client;
    }

    /**
     * @Route("/", name="test")
     */
    public function index(): Response
    {
        /*
         * country EE
         * ref OTT_SEFLSERVICE
         * custnum 258906
         * finaccnum 258906
         * currency EUR
         * amount 61.00
         * desc desc
         * bank hanzaee
         * service_id Paysera
         * internalId null
         * status new
         * */
        $payment = new PayseraPayment();
        $payment->setCountry('EE');
        $payment->setCustnum('258906');
        $payment->setFinaccNum('258906');
        $payment->setNormalAmount('61.00');
        $payment->setBank('hanzaee');

        dump($payment);
        $this->client->setPayment($payment);

        if ($this->client->savePayment())
        {
            
        }

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TestController.php',
        ]);
    }
}
