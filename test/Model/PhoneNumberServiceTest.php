<?php
/**
 * PhoneNumberServiceTest
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
 * Karix API lets you interact with the Karix platform using an omnichannel messaging API. It also allows you to query your account, set up webhooks and buy phone numbers.
 *
 * OpenAPI spec version: 2.0
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
 * PhoneNumberServiceTest Class Doc Comment
 *
 * @category    Class
 * @description Services available on this number
 * @package     Karix
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class PhoneNumberServiceTest extends \PHPUnit_Framework_TestCase
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
     * Test "PhoneNumberService"
     */
    public function testPhoneNumberService()
    {
    }

    /**
     * Test attribute "sms"
     */
    public function testPropertySms()
    {
        $phone_number_service = new \Karix\Model\PhoneNumberService();
        $sms = true;
        
        $phone_number_service->setSms($sms);
        $this->assertEquals($sms, $phone_number_service->getSms());

    }

    /**
    * Helper to create a good example of model
    */
    public function getGoodExample()
    {
        $sms = true;
        
        return array(
            "sms" => $sms,
        );
    }

    /**
    * Test PhoneNumberService validation
    */
    public function testValidation()
    {
        $example = $this->getGoodExample();
        $phone_number_service = new \Karix\Model\PhoneNumberService($example);
        $this->assertTrue($phone_number_service->valid());
    }

}
