<?php

declare(strict_types=1);

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\SeoBundle\Tests\Request;

use PHPUnit\Framework\TestCase;
use Sonata\SeoBundle\Seo\PageWithStructuredData;
use Sonata\SeoBundle\Twig\Extension\StructuredDataExtension;

/**
 * @author Maximilian Berghoff <Maximilian.Berghoff@gmx.de>
 */
final class StructuredDataExtensionTest extends TestCase
{
    public function testStructuredData(): void
    {
        $page = $this->createMock(PageWithStructuredData::class);

        $page
            ->method('getStructuredData')
            ->willReturn(file_get_contents(__DIR__ . '/../../Fixtures/structured_data.jsonld'));

        $extension = new StructuredDataExtension($page);

        $this->assertEquals(
'<script type="application/ld+json">{
  "@context": "http://schema.org",
  "@type": "Organization",
  "url": "http://www.example.com",
  "name": "Unlimited Ball Bearings Corp.",
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+1-401-555-1212",
    "contactType": "Customer service"
  }
}
</script>
',
            $extension->getStructuredData()
        );
    }
}
