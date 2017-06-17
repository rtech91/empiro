<?php defined('SYSPATH') or die('No direct script access.');

class MessageHandler {

    /**
    * Used to hold bits for administrator access level
    * @var const ACCESS_ADMIN
    */
    const ACCESS_ADMIN = (1 << 0);

    /**
    * Used to hold bits for user access level
    * @var const ACCESS_USER
    */
    const ACCESS_USER = (1 << 1);

    /**
    * Used to hold bits for error message type
    * (Non-critical system error)
    * @var const MH_ERROR
    */
    const MH_ERROR = (1 << 2);

    /**
    * Used to hold bits for failure message type
    * (Critical system error)
    * @var const MH_FAILURE
    */
    const MH_FAILURE = (1 << 3);

    /**
    * Used to hold bits for standart message type
    * (For notifications)
    * @var const MH_MESSAGE
    */
    const MH_MESSAGE = (1 << 4);

    /**
    * Used to store stack of objects with messages
    * and bits in them
    * @var array $errorstack
    */
    private $errorstack;

    /**
    * Used to hold only one instance of object
    * according to Singleton pattern.
    * @var Storage $instance
    */
    private static $instance = null;

    private function __construct() {
        $this->errorstack = array();
    }

    /**
    * Get singleton instance of Storage object.
    * @return Storage instance
    */
    public static function getInstance() {
        if(null === self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
    * Collects messages and bits, then writes the data to an object
    * and puts it into the array for future using
    */
    public function registerMessage($message, $bits) {
        $new_message = new stdClass;
        $new_message->message = $message;
        $new_message->bits = $bits;

        array_push($this->errorstack, $new_message);
        unset($new_message);
    }

    /**
    * @return array list of objects with messages and bits or empty array()
    */
    public function getMessages() {
        return $this->errorstack;
    }
}