<?php

namespace Tests;

use TightenCo\Jigsaw\Handlers\MarkdownHandler;
use TightenCo\Jigsaw\IterableObject;
use TightenCo\Jigsaw\PageData;

class PhpOpenTagInMarkdown extends TestCase
{
    public function test_md_files_containing_php_open_tag_are_processed()
    {
        $inputFile = $this->getInputFile('php-tag/php-tag-markdown.md');
        $handler = $this->app->make(MarkdownHandler::class);
        $outputFile = $handler->handle($inputFile, $this->getPageDataDummy());

        $this->assertTrue($handler->shouldHandle($inputFile));
        $this->assertEquals('php-tag-markdown', $outputFile[0]->name());
        $this->assertEquals('Testing <?php tag', $outputFile[0]->data()->page->title);
        $this->assertContains('<code>&lt;?php', $outputFile[0]->contents());
    }

    public function test_blade_md_hybrid_files_containing_php_open_tag_are_processed()
    {
        $inputFile = $this->getInputFile('php-tag/php-tag-blade-markdown.blade.md');
        $handler = $this->app->make(MarkdownHandler::class);
        $outputFile = $handler->handle($inputFile, $this->getPageDataDummy());

        $this->assertTrue($handler->shouldHandle($inputFile));
        $this->assertEquals('php-tag-blade-markdown', $outputFile[0]->name());
        $this->assertEquals('Testing <?php tag', $outputFile[0]->data()->page->title);
        $this->assertContains('<code>&lt;?php', $outputFile[0]->contents());
        $this->assertContains('<p>Title: Testing &lt;?php tag</p>', $outputFile[0]->contents());
    }

    protected function getPageDataDummy()
    {
        return PageData::withPageMetaData(new IterableObject(), []);
    }
}
