<?php

declare(strict_types=1);

namespace App\Behat;

use App\Domain\User\Controller\VerifyAccount;
use App\Infrastructure\Test\Mail\FakeTransport;
use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\AfterScenarioScope;
use Behat\Symfony2Extension\Context\KernelAwareContext;
use Behat\Symfony2Extension\Context\KernelDictionary;
use Nekland\Tools\StringTools;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\KernelInterface;
use Zend\Json\Json;

class AccountContext implements Context, KernelAwareContext
{
    use KernelDictionary;

    /** @var string|null */
    private $username;

    /** @var string|null */
    private $password;

    /** @var KernelBrowser */
    protected $client;

    /** @var Crawler|null */
    protected $crawler;

    /**
     * @When I send a login request with :username and :password
     */
    public function iSendALoginRequestForThisUser()
    {
        $this->getClient()->request(
            'POST',
            '/api/login',
            [],
            [],
            [],
            Json::encode([
                'username' => $this->username,
                'password' => $this->password,
            ])
        );
    }

    /**
     * @When I send a register request with :username and :password
     */
    public function iSendARegisterRequestWithAnd(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->getClient()->request(
            'POST',
            '/api/register',
            [],
            [],
            [],
            Json::encode([
                'email' => $this->username,
                'plainPassword' => $this->password,
            ])
        );
    }

    /**
     * @Then I should receive a valid response
     */
    public function iShouldReceiveAValidResponse()
    {
        $response = $this->getResponse();
        \expect($response->getStatusCode())->toBe(200);
    }

    /**
     * @Then I should received a response containing a jwt
     */
    public function iShouldReceivedAResponseContainingAJwt()
    {
        $response = $this->getResponse();
        \expect($response->getStatusCode())->toBe(200);
        $contentDecoded = $this->getDataFromJSONResponse(false);
        \expect(array_key_exists('token', $contentDecoded))->toBe(true);
        \expect(is_string($contentDecoded['token']))->toBe(true);
    }

    /**
     * @Then I click on the link containing ":url" in the email
     */
    public function IClickOnTheLinkContainingUrlInTheEmail(string $url)
    {
        /** @var FakeTransport $transport */
        $transport = $this->getContainer()->get(FakeTransport::class);
        if (null === $mail = $transport->getLastFlushed()) {
            throw new \Exception('No previous mail send');
        }

        $mailContent = $mail->getContent();
        $links       = [];
        // Magie noireee bouhhhhhh :D
        preg_match_all("/<a\s[^>]*href=\"([^\"]*)\"[^>]*>(.*)<\/a>/siU", $mailContent, $links);
        foreach ($links[1] as $link) {
            if (StringTools::contains($link, $url)) { // We found the complete registration link, let's call it.
                $link          = StringTools::removeStart($link, 'http://localhost');
                $this->crawler = $this->getClient()->request('GET', $link);

                return;
            }
        }

        throw new \Exception(sprintf('Impossible to find the link "%s"', $url));
    }

    /**
     * @Then I'm redirect to welcome page
     */
    public function imRedirectToWelcomePage()
    {
        $response = $this->client->getResponse();
        \expect($response instanceof RedirectResponse)->toBe(true);
        /** @var RedirectResponse $response */
        \expect($response->getTargetUrl())->toBe(VerifyAccount::REDIRECT_AFTER_VERIFY);
    }

    /**
     * @Then I can login with my new created and verified account
     */
    public function iCanLoginWithMyNewCreatedAndVerifiedAccount()
    {
        $this->iSendALoginRequestForThisUser($this->username, $this->password);
        $this->iShouldReceivedAResponseContainingAJwt();
    }

    /**
     * @Then I can't register to my account
     */
    public function iCantRegisterToMyAccount()
    {
        $this->iSendALoginRequestForThisUser();
        $response = $this->client->getResponse();
        \expect($response->getStatusCode())->toBe(401);
    }

    private function getDataFromJSONResponse(): array
    {
        $response = $this->getResponse();
        if (!StringTools::contains($response->headers->get('content-type'), 'application/json')) {
            throw new \Exception('The given response isnt in JSON format in ' . __CLASS__);
        }

        $content = $response->getContent();
        return Json::decode($content, Json::TYPE_ARRAY);
    }


    private function getClient(): KernelBrowser
    {
        $client = $this->getContainer()->get('test.client');
        $client->setServerParameter('CONTENT_TYPE', 'application/json');

        return $this->client = $client;
    }

    private function getResponse()
    {
        return $this->client->getResponse();
    }

    /**
     * @AfterScenario
     */
    public function saveLastBodyOnFailure(AfterScenarioScope $scope)
    {
        if (!$scope->getTestResult()->isPassed() && null !== $this->client) {
            \file_put_contents(__DIR__ . '/../../var/foo.html', $this->getResponse()->getContent());
            echo 'Last response saved in var folder' . PHP_EOL;
        }
    }
}
