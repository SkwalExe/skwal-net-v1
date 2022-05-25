<?php

namespace bandwidthThrottle\tokenBucket\storage;

use bandwidthThrottle\tokenBucket\storage\scope\GlobalScope;
use bandwidthThrottle\tokenBucket\converter\DoubleToStringConverter;
use bandwidthThrottle\tokenBucket\converter\StringToDoubleConverter;
use Predis\Client;
use Predis\PredisException;
use malkusch\lock\mutex\PredisMutex;
use malkusch\lock\mutex\Mutex;

/**
 * Redis based storage which uses the Predis API.
 *
 * This storage is in the global scope.
 *
 * @author Markus Malkusch <markus@malkusch.de>
 * @link bitcoin:1335STSwu9hST4vcMRppEPgENMHD2r1REK Donations
 * @license WTFPL
 */
class PredisStorage implements Storage, GlobalScope
{
    
    /**
     * @var Mutex The mutex.
     */
    private $mutex;
    
    /**
     * @var Client The redis API.
     */
    private $redis;
    
    /**
     * @var string The key.
     */
    private $key;
    
    /**
     * Sets the Redis API.
     *
     * @param string $name  The resource name.
     * @param Client $redis The Redis API.
     */
    public function __construct($name, Client $redis)
    {
        $this->key   = $name;
        $this->redis = $redis;
        $this->mutex = new PredisMutex([$redis], $name);
    }
    
    public function bootstrap($microtime)
    {
        $this->setMicrotime($microtime);
    }
    
    public function isBootstrapped()
    {
        try {
            return $this->redis->exists($this->key);

        } catch (PredisException $e) {
            throw new StorageException("Failed to check for key existence", 0, $e);
        }
    }
    
    public function remove()
    {
        try {
            if (!$this->redis->del($this->key)) {
                throw new StorageException("Failed to delete key");
                
            }
        } catch (PredisException $e) {
            throw new StorageException("Failed to delete key", 0, $e);
        }
    }
    
    public function setMicrotime($microtime)
    {
        try {
            $converter = new DoubleToStringConverter();
            $data      = $converter->convert($microtime);
            
            if (!$this->redis->set($this->key, $data)) {
                throw new StorageException("Failed to store microtime");
                
            }
        } catch (PredisException $e) {
            throw new StorageException("Failed to store microtime", 0, $e);
        }
    }

    public function getMicrotime()
    {
        try {
            $data = $this->redis->get($this->key);
            if ($data === false) {
                throw new StorageException("Failed to get microtime");
                
            }
            $converter = new StringToDoubleConverter();
            return $converter->convert($data);
            
        } catch (PredisException $e) {
            throw new StorageException("Failed to get microtime", 0, $e);
        }
    }

    public function getMutex()
    {
        return $this->mutex;
    }
}
