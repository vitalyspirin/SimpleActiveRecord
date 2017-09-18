<?php

$config = PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR2' => true,
        'no_whitespace_in_blank_line' => true,
        'single_quote' => true,
        'new_with_braces' => true,
        'binary_operator_spaces' => true,
        'phpdoc_summary' => true,
        'phpdoc_separation' => true,
        'blank_line_before_return' => true,
        'concat_space' => ['spacing' => 'one'],
        'no_singleline_whitespace_before_semicolons' => true,
        'no_multiline_whitespace_before_semicolons' => true,
        'no_unused_imports' => true,
        'ordered_imports' => true
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in(__DIR__)
    )
;
// special handling of fabbot.io service if it's using too old PHP CS Fixer version
try {
    PhpCsFixer\FixerFactory::create()
        ->registerBuiltInFixers()
        ->registerCustomFixers($config->getCustomFixers())
        ->useRuleSet(new PhpCsFixer\RuleSet($config->getRules()));
} catch (PhpCsFixer\ConfigurationException\InvalidConfigurationException $e) {
    $config->setRules([]);
}

return $config;
