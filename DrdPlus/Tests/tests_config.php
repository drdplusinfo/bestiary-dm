<?php
global $testsConfiguration;
$testsConfiguration = new \DrdPlus\Tests\RulesSkeleton\TestsConfiguration();
$testsConfiguration->setHasLinkToSingleJournal(false);
$testsConfiguration->setHasLinksToJournals(false);
$testsConfiguration->setHasLinkToSingleJournal(false);
$testsConfiguration->setSomeExpectedTableIds(['tabulka_druhu_pohybu_nestvur']);
$testsConfiguration->setBlockNamesToExpectedContent([]);
$testsConfiguration->setHasProtectedAccess(false);
$testsConfiguration->setHasCharacterSheet(false);