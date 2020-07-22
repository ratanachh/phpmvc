<?php
declare(strict_types=1);

namespace Core;

class Config implements \ArrayAccess, \Countable
{

    const DEFAULT_PATH_DELIMITER = '.';

    static protected $_pathDelimiter;

    protected $_data = [];

    public function __construct(array $arrayConfig = null) {
        $this->_data = $arrayConfig;
    }


    public function offsetExists($index) {
        return isset($this->_data[$index]);
    }

    public function get($offset, $defaultValue = null) {
        if (array_key_exists($offset, $this->_data)) {
            return $this->_data[$offset];
        } else {
            foreach ($this->_data as $nested) {
                if (is_array($nested)){
                    return $this->get($nested, $defaultValue);
                }
            }
        }
        return $defaultValue;
    }

    public function offsetGet($index) {
        return isset($this->_data[$index]) ? $this->_data[$index] : null;
    }

    public function offsetSet($index, $value) {
        if (is_null($index)) {
            $this->_data[] = $value;
        } else {
            $this->_data[$index] = $value;
        }
    }

    public function offsetUnset($index) {
        unset($this->_data[$index]);
    }

    public function merge(Config $config) {}

    public function toArray() {
        return (array) $this->_data;
    }

    public function count() {
        return count($this->_data);
    }

    public static function __set_state(array $data) {
        return new Config($data);
    }

    /**
     * Sets the default path delimiter
     *
     * @param string $delimiter
     */
    public static function setPathDelimiter($delimiter = null) {
        self::$_pathDelimiter = $delimiter;
    }

    /**
     * Gets the default path delimiter
     *
     * @return string
     */
    public static function getPathDelimiter() {
        return self::$_pathDelimiter;
    }

    /**
     * Helper method for merge configs (forwarding nested config instance)
     *
     * @param Config instance = null
     *
     * @param Config $config
     * @param mixed $instance
     * @return Config
     */
    protected final function _merge(Config $config, $instance = null) {}

}
