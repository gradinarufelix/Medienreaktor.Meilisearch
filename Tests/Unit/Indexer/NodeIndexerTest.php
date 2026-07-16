<?php

declare(strict_types=1);

namespace Medienreaktor\Meilisearch\Tests\Unit\Indexer;

use Medienreaktor\Meilisearch\Domain\Service\IndexInterface;
use Medienreaktor\Meilisearch\Indexer\NodeIndexer;
use PHPUnit\Framework\TestCase;

class NodeIndexerTest extends TestCase
{
    public function testRemovesDocumentByItsImmutableIdentifier(): void
    {
        $indexClient = $this->createMock(IndexInterface::class);
        $indexClient->expects(self::once())
            ->method('deleteDocuments')
            ->with(['document-aggregate_language-de-hash']);

        $nodeIndexer = new NodeIndexer();
        $indexClientProperty = new \ReflectionProperty(NodeIndexer::class, 'indexClient');
        $indexClientProperty->setAccessible(true);
        $indexClientProperty->setValue($nodeIndexer, $indexClient);

        $nodeIndexer->removeDocumentByIdentifier('document-aggregate_language-de-hash');
    }
}
