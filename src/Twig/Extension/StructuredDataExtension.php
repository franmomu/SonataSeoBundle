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

namespace Sonata\SeoBundle\Twig\Extension;

use Sonata\SeoBundle\Seo\PageWithStructuredData;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * @author Maximilian Berghoff <Maximilian.Berghoff@mayflower.de>
 */
final class StructuredDataExtension extends AbstractExtension
{
    /**
     * @var PageWithStructuredData
     */
    private $page;

    public function __construct(PageWithStructuredData $page)
    {
        $this->page = $page;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('sonata_seo_structured_data', [$this, 'getStructuredData'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * Creates a script tag with type 'json-ld' and the JSON-LD string stored in page object.
     */
    public function getStructuredData(): string
    {
        if (empty($this->page->getStructuredData())) {
            return '';
        }

        return sprintf("<script type=\"application/ld+json\">%s</script>\n", $this->page->getStructuredData());
    }
}
