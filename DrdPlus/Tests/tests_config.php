<?php
global $testsConfiguration;
$testsConfiguration = new \DrdPlus\Tests\RulesSkeleton\TestsConfiguration('http://bestiar.ppj.drdplus.loc', 'https://bestiar.ppj.drdplus.info');
$testsConfiguration->disableHasLinkToSingleJournal();
$testsConfiguration->disableHasLinksToJournals();
$testsConfiguration->disableHasLinkToSingleJournal();
$testsConfiguration->disableHasProtectedAccess();
$testsConfiguration->disableHasCharacterSheet();
$testsConfiguration->disableCanBeBoughtOnEshop();
$testsConfiguration->disableHasIntroduction();
$testsConfiguration->disableHasCustomBodyContent();
$testsConfiguration->setSomeExpectedTableIds(['tabulka_druhu_pohybu_nestvur']);
$testsConfiguration->setBlockNamesToExpectedContent([]);
$testsConfiguration->setExpectedWebName('DrD+ PJ bestiář');
$testsConfiguration->setExpectedPageTitle('🐀 DrD+ PJ bestiář');
$testsConfiguration->setExpectedGoogleAnalyticsId('UA-121206931-5');
$testsConfiguration->disableHasMoreVersions();