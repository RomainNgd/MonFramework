<?php

namespace Tests\Framework\Twig;

use Framework\Twig\TextExtension;
use PHPUnit\Framework\TestCase;

class TextExtensionTest extends TestCase
{
    /**
     * @var TextExtension
     */
    private TextExtension $textExtension;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->textExtension = new TextExtension();
    }

    /**
     * @return void
     */
    public function testExcerptWithShortText()
    {
        $test = 'salut';
        $this->assertEquals($test, $this->textExtension->excerpt($test, 10));
    }

    public function testExcerptWithLongText()
    {
        $test = 'salut les gens je suis un texte beaucoup pus long ';
        $this->assertEquals('Salut les...', $this->textExtension->excerpt($test, 25));
    }
}
