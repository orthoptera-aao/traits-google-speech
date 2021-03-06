<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/devtools/cloudtrace/v1/trace.proto

namespace Google\Devtools\Cloudtrace\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * The request message for the `GetTrace` method.
 *
 * Generated from protobuf message <code>google.devtools.cloudtrace.v1.GetTraceRequest</code>
 */
class GetTraceRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * ID of the Cloud project where the trace data is stored.
     *
     * Generated from protobuf field <code>string project_id = 1;</code>
     */
    private $project_id = '';
    /**
     * ID of the trace to return.
     *
     * Generated from protobuf field <code>string trace_id = 2;</code>
     */
    private $trace_id = '';

    public function __construct() {
        \GPBMetadata\Google\Devtools\Cloudtrace\V1\Trace::initOnce();
        parent::__construct();
    }

    /**
     * ID of the Cloud project where the trace data is stored.
     *
     * Generated from protobuf field <code>string project_id = 1;</code>
     * @return string
     */
    public function getProjectId()
    {
        return $this->project_id;
    }

    /**
     * ID of the Cloud project where the trace data is stored.
     *
     * Generated from protobuf field <code>string project_id = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setProjectId($var)
    {
        GPBUtil::checkString($var, True);
        $this->project_id = $var;

        return $this;
    }

    /**
     * ID of the trace to return.
     *
     * Generated from protobuf field <code>string trace_id = 2;</code>
     * @return string
     */
    public function getTraceId()
    {
        return $this->trace_id;
    }

    /**
     * ID of the trace to return.
     *
     * Generated from protobuf field <code>string trace_id = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setTraceId($var)
    {
        GPBUtil::checkString($var, True);
        $this->trace_id = $var;

        return $this;
    }

}

