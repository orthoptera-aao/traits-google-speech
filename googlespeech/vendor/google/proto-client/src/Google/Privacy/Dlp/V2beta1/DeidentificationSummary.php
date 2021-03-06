<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/privacy/dlp/v2beta1/dlp.proto

namespace Google\Privacy\Dlp\V2beta1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * High level summary of deidentification.
 *
 * Generated from protobuf message <code>google.privacy.dlp.v2beta1.DeidentificationSummary</code>
 */
class DeidentificationSummary extends \Google\Protobuf\Internal\Message
{
    /**
     * Total size in bytes that were transformed in some way.
     *
     * Generated from protobuf field <code>int64 transformed_bytes = 2;</code>
     */
    private $transformed_bytes = 0;
    /**
     * Transformations applied to the dataset.
     *
     * Generated from protobuf field <code>repeated .google.privacy.dlp.v2beta1.TransformationSummary transformation_summaries = 3;</code>
     */
    private $transformation_summaries;

    public function __construct() {
        \GPBMetadata\Google\Privacy\Dlp\V2Beta1\Dlp::initOnce();
        parent::__construct();
    }

    /**
     * Total size in bytes that were transformed in some way.
     *
     * Generated from protobuf field <code>int64 transformed_bytes = 2;</code>
     * @return int|string
     */
    public function getTransformedBytes()
    {
        return $this->transformed_bytes;
    }

    /**
     * Total size in bytes that were transformed in some way.
     *
     * Generated from protobuf field <code>int64 transformed_bytes = 2;</code>
     * @param int|string $var
     * @return $this
     */
    public function setTransformedBytes($var)
    {
        GPBUtil::checkInt64($var);
        $this->transformed_bytes = $var;

        return $this;
    }

    /**
     * Transformations applied to the dataset.
     *
     * Generated from protobuf field <code>repeated .google.privacy.dlp.v2beta1.TransformationSummary transformation_summaries = 3;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getTransformationSummaries()
    {
        return $this->transformation_summaries;
    }

    /**
     * Transformations applied to the dataset.
     *
     * Generated from protobuf field <code>repeated .google.privacy.dlp.v2beta1.TransformationSummary transformation_summaries = 3;</code>
     * @param \Google\Privacy\Dlp\V2beta1\TransformationSummary[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setTransformationSummaries($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Privacy\Dlp\V2beta1\TransformationSummary::class);
        $this->transformation_summaries = $arr;

        return $this;
    }

}

