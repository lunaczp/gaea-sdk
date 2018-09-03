<?php
namespace Gaea\Storage\Kafka\Protocol\Fetch\Helper;

/**
 * Description of Consumer
 *
 * @author daniel
 */
class Consumer extends HelperAbstract
{
    protected $consumer;

    protected $offsetStrategy;

    /**
     * Consumer constructor.
     * @param \Gaea\Storage\Kafka\Consumer $consumer
     */
    public function __construct(\Gaea\Storage\Kafka\Consumer $consumer)
    {
        $this->consumer = $consumer;
    }

    /**
     * @param \Gaea\Storage\Kafka\Protocol\Fetch\Partition $partition
     */
    public function onPartitionEof($partition)
    {
        $partitionId = $partition->key();
        $topicName = $partition->getTopicName();
        $offset    = $partition->getMessageOffset();
        $this->consumer->setFromOffset(true);
        $this->consumer->setPartition($topicName, $partitionId, ($offset +1));
    }

    /**
     * @param string $streamKey
     */
    public function onStreamEof($streamKey)
    {
    }

    /**
     * @param string $topicName
     */
    public function onTopicEof($topicName)
    {
    }
}
