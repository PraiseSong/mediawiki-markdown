<?php
#
# mediawiki-markdown  允许在mediawiki页面使用markdown语法
# version 0.0.1
#
#

include_once "markdown.php";

if ( !defined( 'MEDIAWIKI' ) ) {
    die( 'This is not a valid entry point to MediaWiki.' );
}

$wgExtensionCredits['parserhook'][] = array(
    'name' => 'markdown',
    'author' => 'Praise Song',
    'version' => '0.1',
    'url' => 'http://www.mediawiki.org/wiki/Extension:markdown',
    'description' => '允许在mediawiki页面使用markdown语法.',
);

$wgHooks['ParserFirstCallInit'][] = 'registerEmbedMarkdownHandler';

// 注册  <markdown> 标签
function registerEmbedMarkdownHandler( &$parser ) {
    $parser->setHook( 'markdown', 'embedMarkdownHandler' );
    return true;
}

function makeHTMLforMarkdown( $input, $argv ) {
    return Markdown($input);
}

function embedMarkdownHandler( $input, $argv ) {
    $input = trim($input);

    if ( !$input ) {
        return '';
    }

    return makeHTMLforMarkdown( $input, $argv );
}
?>