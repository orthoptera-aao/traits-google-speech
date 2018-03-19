<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/privacy/dlp/v2beta1/dlp.proto

namespace Google\Cloud\Dlp\V2beta1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * The set of columns' values that share the same l-diversity value.
 *
 * Generated from protobuf message <code>google.privacy.dlp.v2beta1.RiskAnalysisOperationResult.LDiversityResult.LDiversityEquivalenceClass</code>
 */
class RiskAnalysisOperationResult_LDiversityResult_LDiversityEquivalenceClass extends \Google\Protobuf\Internal\Message
{
    /**
     * Quasi-identifier values defining the k-anonymity equivalence
     * class. The order is always the same as the original request.
     *
     * Generated from protobuf field <code>repeated .google.privacy.dlp.v2beta1.Value quasi_ids_values = 1;</code>
     */
    private $quasi_ids_values;
    /**
     * Size of the k-anonymity equivalence class.
     *
     * Generated from protobuf field <code>int64 equivalence_class_size = 2;</code>
     */
    private $equivalence_class_size = 0;
    /**
     * Number of distinct sensitive values in this equivalence class.
     *
     * Generated from protobuf field <code>int64 num_distinct_sensitive_values = 3;</code>
     */
    private $num_distinct_sensitive_values = 0;
    /**
     * Estimated frequencies of top sensitive values.
     *
     * Generated from protobuf field <code>repeated .google.privacy.dlp.v2beta1.ValueFrequency top_sensitive_values = 4;</code>
     */
    private $top_sensitive_values;

    public function __construct() {
        \GPBMetadata\Google\Privacy\Dlp\V2Beta1\Dlp::initOnce();
        parent::__construct();
    }

    /**
     * Quasi-identifier values defining the k-anonymity equivalence
     * class. The order is always the same as the original request.
     *
     * Generated from protobuf field <code>repeated .google.privacy.dlp.v2beta1.Value quasi_ids_values = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getQuasiIdsValues()
    {
        return $this->quasi_ids_values;
    }

    /**
     * Quasi-identifier values defining the k-anonymity equivalence
     * class. The order is always the same as the original request.
     *
     * Generated from protobuf field <code>repeated .google.privacy.dlp.v2beta1.Value quasi_ids_values = 1;</code>
     * @param \Google\Cloud\Dlp\V2beta1\Value[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setQuasiIdsValues($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Cloud\Dlp\V2beta1\Value::class);
        $this->quasi_ids_values = $arr;

        return $this;
    }

    /**
     * Size of the k-anonymity equivalence class.
     *
     * Generated from protobuf field <code>int64 equivalence_class_size = 2;</code>
     * @return int|string
     */
    public function getEquivalenceClassSize()
    {
        return $this->equivalence_class_size;
    }

    /**
     * Size of the k-anonymity equivalence class.
     *
     * Generated from protobuf field <code>int64 equivalence_class_size = 2;</code>
     * @param int|string $var
     * @return $this
     */
    public function setEquivalenceClassSize($var)
    {
        GPBUtil::checkInt64($var);
        $this->equivalence_class_size = $var;

        return $this;
    }

    /**
     * Number of distinct sensitive values in this equivalence class.
     *
     * Generated from protobuf field <code>int64 num_distinct_sensitive_values = 3;</code>
     * @return int|string
     */
    public function getNumDistinctSensitiveValues()
    {
        return $this->num_distinct_sensitive_values;
    }

    /**
     * Number of distinct sensitive values in this equivalence class.
     *
     * Generated from protobuf field <code>int64 num_distinct_sensitive_values = 3;</code>
     * @param int|string $var
     * @return $this
     */
    public function setNumDistinctSensitiveValues($var)
    {
        GPBUtil::checkInt64($var);
        $this->num_distinct_sensitive_values = $var;

        return $this;
    }

    /**
     * Estimated frequencies of top sensitive values.
     *
     * Generated from protobuf field <code>repeated .google.privacy.dlp.v2beta1.ValueFrequency top_sensitive_values = 4;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getTopSensitiveValues()
    {
        return $this->top_sensitive_values;
    }

    /**
     * Estimated frequencies of top sensitive values.
     *
     * Generated from protobuf field <code>repeated .google.privacy.dlp.v2beta1.ValueFrequency top_sensitive_values = 4;</code>
     * @param \Google\Cloud\Dlp\V2beta1\ValueFrequency[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setTopSensitiveValues($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Cloud\Dlp\V2beta1\ValueFrequency::class);
        $this->top_sensitive_values = $arr;

        return $this;
    }

}

