<?php

$excluded_folders = [
    'public_html',
    'bootstrap',
    'node_modules',
    'storage',
    'vendor',
];

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude($excluded_folders)
    ->name('*.php')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR2'                             => true,
        '@Symfony'                          => true,
        'array_syntax'                      => ['syntax' => 'short'],
        'binary_operator_spaces'            => ['align_double_arrow' => true],
        'linebreak_after_opening_tag'       => true,
        'not_operator_with_successor_space' => true,
        'ordered_imports'                   => true,
        'phpdoc_order'                      => true,
        'yoda_style'                        => [
            'equal'     => false,
            'identical' => false,
        ],
        'phpdoc_var_without_name'       => false,
        'phpdoc_annotation_without_dot' => false, //conflict with ide-helper
        'phpdoc_separation'             => false, //conflict with ide-helper
        'phpdoc_align'                  => false, //conflict with ide-helper
        'phpdoc_to_comment'             => false,
        'no_alternative_syntax'         => true,
        'concat_space'                  => ['spacing' => 'one'],
    ])
    ->setLineEnding("\n")
    ->setFinder($finder);
