<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Stripe\Stripe;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', []);
    }
    /**
     * @Route("/success", name="success")
     */
    public function success()
    {
        return $this->redirect('http://localhost:4200/home');
    }
    /**
     * @Route("/error", name="error")
     */
    public function error()
    {
        return $this->redirect('http://localhost:4200/home');
    }

    /**
     * @Route("/api/create-checkout-session/{amount}" , name="checkout")
     */
    public function checkout($amount)
    {
        Stripe::setApiKey(
            'sk_test_51JJ4BxFEfnXK19T7kkoea5UcKeyJYmPmqoK8w7m9eU6ENNtp7BTrDNjVQM4kbLZYaaPR04RMaCIKlk95YJoBlBzw00LUetNjqr'
        );
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'EUR',
                        'product_data' => [
                            'name' => 'terrain',
                        ],
                        'unit_amount' => $amount * 100,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => $this->generateUrl(
                'success',
                [],
                UrlGeneratorInterface::ABSOLUTE_URL
            ),
            'cancel_url' => $this->generateUrl(
                'error',
                [],
                UrlGeneratorInterface::ABSOLUTE_URL
            ),
        ]);
        return new JsonResponse([['id' => $session->url]]);
    }
}
