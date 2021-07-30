<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
        ]);
    }
 /**
     * @Route("/success", name="success")
     */
    public function success()
    {
        return $this->render('default/success.html.twig', [
        ]);
    }
     /**
     * @Route("/error", name="error")
     */
    public function error()
    {
        return $this->render('default/error.html.twig', [
        ]);
    }

    /**
     * @Route("/create-checkout-session/{amount}" , name="checkout")
     */
    public function checkout($amount)
    {
        \Stripe\Stripe::setApiKey('sk_test_51JBkFmCcU5zzZM8VDPCc48QMlJDy78FZOjQCqf8bZhoZANBc5tobGv6YEwmH0f5SYW3F3Gje2ACK9Vc3drxGMEtZ00kPgaFisV');
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
              'price_data' => [
                'currency' => 'EUR',
                'product_data' => [
                  'name' => 'terrain',
                ],
                'unit_amount' => $amount,
              ],
              'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $this->generateUrl('success',[],UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('error',[],UrlGeneratorInterface::ABSOLUTE_URL),
          ]);
          return new JsonResponse([['id'=> $session->url]]);

    }
}
