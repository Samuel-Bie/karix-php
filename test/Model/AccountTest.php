<?php
/**
 * AccountTest
 *
 * PHP version 5
 *
 * @category Class
 * @package  Karix
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * karix api
 *
 * Karix API lets you interact with the Karix platform. It allows you to query your account, set up webhooks, send messages and buy phone numbers.
 *
 * OpenAPI spec version: 1.0
 * Contact: support@karix.io
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: unset
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Please update the test case below to test the model.
 */

namespace Karix;

/**
 * AccountTest Class Doc Comment
 *
 * @category    Class
 * @description Account
 * @package     Karix
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class AccountTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Setup before running any test case
     */
    public static function setUpBeforeClass()
    {
    }

    /**
     * Setup before running each test case
     */
    public function setUp()
    {
    }

    /**
     * Clean up after running each test case
     */
    public function tearDown()
    {
    }

    /**
     * Clean up after running all test cases
     */
    public static function tearDownAfterClass()
    {
    }

    /**
     * Test "Account"
     */
    public function testAccount()
    {
    }

    /**
     * Test attribute "name"
     */
    public function testPropertyName()
    {
        $account = new \Karix\Model\Account();
        $name = "Beth Smith";
        
        $account->setName($name);
        $this->assertEquals($name, $account->getName());

        // Check for validations
        // Check for maxLength 200
        $account->setName(str_repeat("a", 200));
        try
        {
            $account->setName(str_repeat("a", 200)."a");
            $this->fail("$account->setName accepted input greater than 200");
        }
        catch(\InvalidArgumentException $e){}

    }

    /**
     * Test attribute "status"
     */
    public function testPropertyStatus()
    {
        $account = new \Karix\Model\Account();
        $status = "enabled";
        
        $account->setStatus($status);
        $this->assertEquals($status, $account->getStatus());

        // Check for enum
        $account->setStatus("enabled");
        $account->setStatus("suspended");
        $account->setStatus("disabled");
        try
        {
            $account->setStatus("Invalid Edwfere");
            $this->fail("$account->setStatus accepted input outside of enum");
        }
        catch(\InvalidArgumentException $e){}

    }

    /**
     * Test attribute "uid"
     */
    public function testPropertyUid()
    {
        $account = new \Karix\Model\Account();
        $uid = "7fea9708-ea28-42e9-871f-a07fe7cef72f";
        
        $account->setUid($uid);
        $this->assertEquals($uid, $account->getUid());

    }

    /**
     * Test attribute "token"
     */
    public function testPropertyToken()
    {
        $account = new \Karix\Model\Account();
        $token = "e664221d-4aed-415b-929b-7edf887e4680";
        
        $account->setToken($token);
        $this->assertEquals($token, $account->getToken());

    }

    /**
     * Test attribute "is_parent"
     */
    public function testPropertyIsParent()
    {
        $account = new \Karix\Model\Account();
        $is_parent = false;
        
        $account->setIsParent($is_parent);
        $this->assertEquals($is_parent, $account->getIsParent());

    }

    /**
     * Test attribute "created_time"
     */
    public function testPropertyCreatedTime()
    {
        $account = new \Karix\Model\Account();
        $datetime = \DateTime::createFromFormat(\DateTime::ISO8601, '2017-08-04T09:59:29.660Z');
        $created_time = $datetime;
        
        $account->setCreatedTime($created_time);
        $this->assertEquals($created_time, $account->getCreatedTime());

    }

    /**
     * Test attribute "updated_time"
     */
    public function testPropertyUpdatedTime()
    {
        $account = new \Karix\Model\Account();
        $datetime = \DateTime::createFromFormat(\DateTime::ISO8601, '2017-08-05T09:59:29.660Z');
        $updated_time = $datetime;
        
        $account->setUpdatedTime($updated_time);
        $this->assertEquals($updated_time, $account->getUpdatedTime());

    }

    /**
     * Test attribute "account_type"
     */
    public function testPropertyAccountType()
    {
        $account = new \Karix\Model\Account();
        $account_type = "prepaid";
        
        $account->setAccountType($account_type);
        $this->assertEquals($account_type, $account->getAccountType());

        // Check for enum
        $account->setAccountType("prepaid");
        $account->setAccountType("postpaid");
        $account->setAccountType("trial");
        try
        {
            $account->setAccountType("Invalid Edwfere");
            $this->fail("$account->setAccountType accepted input outside of enum");
        }
        catch(\InvalidArgumentException $e){}

    }

    /**
     * Test attribute "credit_balance"
     */
    public function testPropertyCreditBalance()
    {
        $account = new \Karix\Model\Account();
        $credit_balance = "127.33";
        
        $account->setCreditBalance($credit_balance);
        $this->assertEquals($credit_balance, $account->getCreditBalance());

    }

    /**
     * Test attribute "auto_recharge"
     */
    public function testPropertyAutoRecharge()
    {
        $account = new \Karix\Model\Account();
        $auto_recharge = false;
        
        $account->setAutoRecharge($auto_recharge);
        $this->assertEquals($auto_recharge, $account->getAutoRecharge());

    }

    /**
    * Helper to create a good example of model
    */
    public function getGoodExample()
    {
        $name = "Beth Smith";
        
        $status = "enabled";
        
        $uid = "7fea9708-ea28-42e9-871f-a07fe7cef72f";
        
        $token = "e664221d-4aed-415b-929b-7edf887e4680";
        
        $is_parent = false;
        
        $datetime = \DateTime::createFromFormat(\DateTime::ISO8601, '2017-08-04T09:59:29.660Z');
        $created_time = $datetime;
        
        $datetime = \DateTime::createFromFormat(\DateTime::ISO8601, '2017-08-05T09:59:29.660Z');
        $updated_time = $datetime;
        
        $account_type = "prepaid";
        
        $credit_balance = "127.33";
        
        $auto_recharge = false;
        
        return array(
            "name" => $name,
            "status" => $status,
            "uid" => $uid,
            "token" => $token,
            "is_parent" => $is_parent,
            "created_time" => $created_time,
            "updated_time" => $updated_time,
            "account_type" => $account_type,
            "credit_balance" => $credit_balance,
            "auto_recharge" => $auto_recharge,
        );
    }

    /**
    * Test Account validation
    */
    public function testValidation()
    {
        $example = $this->getGoodExample();
        $account = new \Karix\Model\Account($example);
        $this->assertTrue($account->valid());
    }

    /**
    *
    */
    public function testMaxLengthPropertyName()
    {
        $example = $this->getGoodExample();

        $example['name'] = str_repeat("a", 200)."a";

        $account = new \Karix\Model\Account($example);
        $this->assertFalse($account->valid());

        $invalidProperties = $account->listInvalidProperties();
        $this->assertContains("invalid value for 'name', the character length must be smaller than or equal to 200.", $invalidProperties);
    }

    /**
    *
    */
    public function testEnumPropertyStatus()
    {
        $example = $this->getGoodExample();
        $example['status'] = "Invalid Edwfere";
        $account = new \Karix\Model\Account($example);
        $this->assertFalse($account->valid());

        $allowedValues = $account->getStatusAllowableValues();
        $err_msg = sprintf(
            "invalid value for 'status', must be one of '%s'",
            implode("', '", $allowedValues)
        );
        $invalidProperties = $account->listInvalidProperties();
        $this->assertContains($err_msg, $invalidProperties);
    }

    /**
    *
    */
    public function testEnumPropertyAccountType()
    {
        $example = $this->getGoodExample();
        $example['account_type'] = "Invalid Edwfere";
        $account = new \Karix\Model\Account($example);
        $this->assertFalse($account->valid());

        $allowedValues = $account->getAccountTypeAllowableValues();
        $err_msg = sprintf(
            "invalid value for 'account_type', must be one of '%s'",
            implode("', '", $allowedValues)
        );
        $invalidProperties = $account->listInvalidProperties();
        $this->assertContains($err_msg, $invalidProperties);
    }

}
