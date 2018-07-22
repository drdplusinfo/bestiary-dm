<?php
$masterDocumentRoot = $masterDocumentRoot ?? (PHP_SAPI !== 'cli' ? \rtrim(\dirname($_SERVER['SCRIPT_FILENAME']), '\/') : \getcwd());
$documentRoot = $documentRoot ?? $masterDocumentRoot;
$latestVersion = $latestVersion ?? '1.0';

require_once __DIR__ . '/vendor/autoload.php';

$dirs = new \DrdPlus\RulesSkeleton\Dirs($masterDocumentRoot, $documentRoot);

$controller = $controller ?? new \DrdPlus\RulesSkeleton\RulesController(
        'UA-121206931-5',
        \DrdPlus\RulesSkeleton\HtmlHelper::createFromGlobals($dirs),
        $dirs
    );
$controller->setFreeAccess();

require __DIR__ . '/vendor/drd-plus/rules-skeleton/index.php';
