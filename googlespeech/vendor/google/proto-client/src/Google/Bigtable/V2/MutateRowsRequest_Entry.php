<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/bigtable/v2/bigtable.proto

namespace Google\Bigtable\V2;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>google.bigtable.v2.MutateRowsRequest.Entry</code>
 */
class MutateRowsRequest_Entry extends \Google\Protobuf\Internal\Message
{
    /**
     * The key of the row to which the `mutations` should be applied.
     *
     * Generated from protobuf field <code>bytes row_key = 1;</code>
     */
    private $row_key = '';
    /**
     * Changes to be atomically applied to the specified row. Mutations are
     * applied in order, meaning that earlier mutations can be masked by
     * later ones.
     * You must specify at least one mutation.
     *
     * Generated from protobuf field <code>repeated .google.bigtable.v2.Mutation mutations = 2;</code>
     */
    private $mutations;

    public function __construct() {
        \GPBMetadata\Google\Bigtable\V2\Bigtable::initOnce();
        parent::__construct();
    }

    /**
     * The key of the row to which the `mutations` should be applied.
     *
     * Generated from protobuf field <code>bytes row_key = 1;</code>
     * @return string
     */
    public function getRowKey()
    {
        return $this->row_key;
    }

    /**
     * The key of the row to which the `mutations` should be applied.
     *
     * Generated from protobuf field <code>bytes row_key = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setRowKey($var)
    {
        GPBUtil::checkString($var, False);
        $this->row_key = $var;

        return $this;
    }

    /**
     * Changes to be atomically applied to the specified row. Mutations are
     * applied in order, meaning that earlier mutations can be masked by
     * later ones.
     * You must specify at least one mutation.
     *
     * Generated from protobuf field <code>repeated .google.bigtable.v2.Mutation mutations = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getMutations()
    {
        return $this->mutations;
    }

    /**
     * Changes to be atomically applied to the specified row. Mutations are
     * applied in order, meaning that earlier mutations can be masked by
     * later ones.
     * You must specify at least one mutation.
     *
     * Generated from protobuf field <code>repeated .google.bigtable.v2.Mutation mutations = 2;</code>
     * @param \Google\Bigtable\V2\Mutation[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setMutations($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Bigtable\V2\Mutation::class);
        $this->mutations = $arr;

        return $this;
    }

}

