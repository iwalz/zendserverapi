<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright      Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @package        Zend_Service
 */

namespace ZendService\ZendServerAPI\DataTypes;

/**
 * RuleInfo model implementation.
 *
 * @license        http://framework.zend.com/license/new-bsd New BSD License
 * @link           http://github.com/zendframework/zf2 for the canonical source repository
 * @author         Ingo Walz <ingo.walz@googlemail.com>
 * @category       Zend
 * @package        Zend_Service
 * @subpackage     ZendServerAPI
 */
class RuleInfo extends DataType
{
    /**
     * @var Rule
     */
    protected $rule = null;
    /**
     * @var RuleDetails
     */
    protected $ruleDetails = null;

    /**
     * @param Rule $rule
     */
    public function setRule(Rule $rule)
    {
        $this->rule = $rule;
    }

    /**
     * @return Rule
     */
    public function getRule()
    {
        return $this->rule;
    }

    /**
     * @param RuleDetails $ruleDetails
     */
    public function setRuleDetails(RuleDetails $ruleDetails)
    {
        $this->ruleDetails = $ruleDetails;
    }

    /**
     * @return \ZendService\ZendServerAPI\DataTypes\RuleDetails
     */
    public function getRuleDetails()
    {
        return $this->ruleDetails;
    }
}
