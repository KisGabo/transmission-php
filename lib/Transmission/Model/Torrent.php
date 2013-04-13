<?php
namespace Transmission\Model;

use Transmission\Client;

/**
 * Represents a torrent in Transmissions download queue
 *
 * @author Ramon Kleiss <ramon@cubilon.nl>
 */
class Torrent extends AbstractModel
{
    /**
     * @var integer
     */
    const STATUS_STOPPED = 0;

    /**
     * @var integer
     */
    const STATUS_CHECK = 2;

    /**
     * @var integer
     */
    const STATUS_DOWNLOAD = 4;

    /**
     * @var integer
     */
    const STATUS_SEED = 6;

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var integer
     */
    protected $status;

    /**
     * @var boolean
     */
    protected $finished;

    /**
     * @var array
     */
    protected $files;

    /**
     * @var array
     */
    protected $trackers;

    /**
     * @var array
     */
    protected $peers;

    /**
     * Constructor
     *
     * @param Transmission\Client $client
     */
    public function __construct(Client $client = null)
    {
        parent::__construct($client);

        $this->peers = array();
        $this->files = array();
        $this->tracker = array();
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = (integer) $id;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = (string) $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @var integer
     */
    public function setStatus($status)
    {
        $this->status = (integer) $status;
    }

    /**
     * @var integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return boolean
     */
    public function isStopped()
    {
        return $this->getStatus() === self::STATUS_STOPPED;
    }

    /**
     * @return boolean
     */
    public function isChecking()
    {
        return $this->getStatus() === self::STATUS_CHECK;
    }

    /**
     * @return boolean
     */
    public function isDownloading()
    {
        return $this->getStatus() === self::STATUS_DOWNLOAD;
    }

    /**
     * @return boolean
     */
    public function isSeeding()
    {
        return $this->getStatus() === self::STATUS_SEED;
    }

    /**
     * @param Transmission\Model\File $file
     */
    public function addFile(File $file)
    {
        $this->files[] = $file;
    }

    /**
     * @param boolean $finished
     */
    public function setFinished($finished)
    {
        $this->finished = (boolean) $finished;
    }

    /**
     * @return boolean
     */
    public function isFinished()
    {
        return $this->finished;
    }

    /**
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param Transmission\Model\Tracker $tracker
     */
    public function addTracker(Tracker $tracker)
    {
        $this->trackers[] = $tracker;
    }

    /**
     * @return array
     */
    public function getTrackers()
    {
        return $this->trackers;
    }

    /**
     * @param Transmission\Model\Peer $peer
     */
    public function addPeer(Peer $peer)
    {
        $this->peers[] = $peer;
    }

    /**
     * @return array
     */
    public function getPeers()
    {
        return $this->peers;
    }

    /**
     * @return array
     */
    protected static function getMapping()
    {
        return array(
            'id' => 'id',
            'name' => 'name',
            'status' => 'status',
            'finished' => 'finished',
            'files' => null,
            'trackers' => null
        );
    }
}