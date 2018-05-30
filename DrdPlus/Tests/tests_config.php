<?php
global $testsConfiguration;
$testsConfiguration = new \DrdPlus\Tests\RulesSkeleton\TestsConfiguration();
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
