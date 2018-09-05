<?php
declare(strict_types=1);

namespace DrdPlus\RulesSkeleton;

use DrdPlus\FrontendSkeleton\CookiesService;
use Granam\Strict\Object\StrictObject;

class UsagePolicy extends StrictObject
{
    public const TRIAL_EXPIRED_AT = 'trialExpiredAt';
    public const OWNERSHIP_COOKIE_NAME = 'ownershipCookieName';
    public const TRIAL_COOKIE_NAME = 'trialCookieName';
    public const TRIAL_EXPIRED_AT_NAME = 'trialExpiredAtName';

    /** @var string */
    private $articleName;
    /** @var Request */
    private $request;
    /** @var CookiesService */
    private $cookiesService;

    /**
     * @param string $articleName
     * @param \DrdPlus\FrontendSkeleton\Request $request
     * @param CookiesService $cookiesService
     * @throws \DrdPlus\RulesSkeleton\Exceptions\ArticleNameCanNotBeEmptyForUsagePolicy
     * @throws \DrdPlus\RulesSkeleton\Exceptions\ArticleNameShouldBeValidName
     * @throws \DrdPlus\FrontendSkeleton\Exceptions\CookieCanNotBeSet
     */
    public function __construct(
        string $articleName,
        \DrdPlus\FrontendSkeleton\Request $request,
        CookiesService $cookiesService
    )
    {
        $articleName = \trim($articleName);
        if ($articleName === '') {
            throw new Exceptions\ArticleNameCanNotBeEmptyForUsagePolicy('Name of the article to confirm ownership can not be empty');
        }
        if (!\preg_match('~\w~u', $articleName)) {
            throw new Exceptions\ArticleNameShouldBeValidName(
                "Name of the article to confirm ownership should contain some meaningful name, got '$articleName'"
            );
        }
        $this->articleName = $articleName;
        $this->request = $request;
        $this->cookiesService = $cookiesService;
        $this->setCookie(static::OWNERSHIP_COOKIE_NAME, $this->getOwnershipName(), null /* expire on session end*/);
        $this->setCookie(static::TRIAL_COOKIE_NAME, $this->getTrialName(), null /* expire on session end*/);
        $this->setCookie(static::TRIAL_EXPIRED_AT_NAME, $this->getTrialExpiredAtName(), null /* expire on session end*/);
    }

    /**
     * @param string $cookieName
     * @param string $value
     * @param \DateTime|null $expiresAt
     * @return bool
     * @throws \DrdPlus\FrontendSkeleton\Exceptions\CookieCanNotBeSet
     */
    private function setCookie(string $cookieName, string $value, ?\DateTime $expiresAt): bool
    {
        return $this->cookiesService->setCookie($cookieName, $value, false /* accessible also via JS */, $expiresAt);
    }

    public function hasVisitorConfirmedOwnership(): bool
    {
        return $this->cookiesService->getCookie($this->getOwnershipName()) !== null;
    }

    private function getOwnershipName(): string
    {
        return \str_replace('.', '_', 'confirmedOwnershipOf' . \ucfirst($this->articleName));
    }

    /**
     * @param \DateTime $expiresAt
     * @return bool
     * @throws \RuntimeException
     */
    public function confirmOwnershipOfVisitor(\DateTime $expiresAt): bool
    {
        return $this->setCookie($this->getOwnershipName(), (string)$expiresAt->getTimestamp(), $expiresAt);
    }

    public function isVisitorBot(): bool
    {
        return $this->request->isVisitorBot();
    }

    public function isVisitorUsingValidTrial(): bool
    {
        return $this->cookiesService->getCookie($this->getTrialName()) !== null && !$this->trialJustExpired();
    }

    public function getTrialName(): string
    {
        return \str_replace('.', '_', 'trialOf' . \ucfirst($this->articleName));
    }

    public function getTrialExpiredAtName(): string
    {
        return static::TRIAL_EXPIRED_AT;
    }

    /**
     * @param \DateTime $expiresAt
     * @return bool
     * @throws \RuntimeException
     */
    public function activateTrial(\DateTime $expiresAt): bool
    {
        return $this->setCookie($this->getTrialName(), (string)$expiresAt->getTimestamp(), $expiresAt);
    }

    public function trialJustExpired(): bool
    {
        return !empty($_GET[static::TRIAL_EXPIRED_AT]) && ((int)$_GET[static::TRIAL_EXPIRED_AT]) <= \time();
    }
}