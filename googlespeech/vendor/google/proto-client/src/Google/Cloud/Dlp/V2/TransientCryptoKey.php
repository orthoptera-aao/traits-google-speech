<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/privacy/dlp/v2/dlp.proto

namespace Google\Cloud\Dlp\V2;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Use this to have a random data crypto key generated.
 * It will be discarded after the request finishes.
 *
 * Generated from protobuf message <code>google.privacy.dlp.v2.TransientCryptoKey</code>
 */
class TransientCryptoKey extends \Google\Protobuf\Internal\Message
{
    /**
     * Name of the key. [required]
     * This is an arbitrary string used to differentiate different keys.
     * A unique key is generated per name: two separate `TransientCryptoKey`
     * protos share the same generated key if their names are the same.
     * When the data crypto key is generated, this name is not used in any way
     * (repeating the api call will result in a different key being generated).
     *
     * Generated from protobuf field <code>string name = 1;</code>
     */
    private $name = '';

    public function __construct() {
        \GPBMetadata\Google\Privacy\Dlp\V2\Dlp::initOnce();
        parent::__construct();
    }

    /**
     * Name of the key. [required]
     * This is an arbitrary string used to differentiate different keys.
     * A unique key is generated per name: two separate `TransientCryptoKey`
     * protos share the same generated key if their names are the same.
     * When the data crypto key is generated, this name is not used in any way
     * (repeating the api call will result in a different key being generated).
     *
     * Generated from protobuf field <code>string name = 1;</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Name of the key. [required]
     * This is an arbitrary string used to differentiate different keys.
     * A unique key is generated per name: two separate `TransientCryptoKey`
     * protos share the same generated key if their names are the same.
     * When the data crypto key is generated, this name is not used in any way
     * (repeating the api call will result in a different key being generated).
     *
     * Generated from protobuf field <code>string name = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;

        return $this;
    }

}

