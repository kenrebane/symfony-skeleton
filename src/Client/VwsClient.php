<?php


namespace App\Client;

use App\Payment\PayseraPayment;
use SoapClient;
use SoapFault;

/*
 save payment -- savePaymentOrder($countryID,$data,$orderID,$status)
         $payment->getCountry(),
        [
          "reference_number" => 'OTT_SELFSERVICE_PAYMENT',
          "customer_id" => $payment->getCustnum(),
          "finaccnum" => $payment->getFinancialAccountNumber(),
          "currency" => $payment->getCurrency(),
          "amount" => $payment->getNormalAmount(),
          "description" => $payment->getDescriptionForCustomer(),
          "bank" => $payment->getChannel(),
          "service_id" => $payment->getServiceProvider(),
          "country_id" => $payment->getCountry(),
        ],
        $payment->getInternalId(),
        $payment->getStatus(),
 update payment -- savePaymentOrder($countryID,$data,$orderID,$status)
         $payment->getCountry(),
        [
          "bank" => $payment->getChannel(),
          "account_number" => $payment->getPayseraAccountNumber(),
        ],
        $payment->getInternalId(),
        $payment->getStatus(),
 get payment -- getPayments($this->countryID,null,null,null,null,$paymentID);
 create payment order -- doOrder($countryID,$data,$orderID)
				array('crm_orders'=>
					array('offer_id'=>$_SESSION['ORDER']['META']['OFFER_ID'],
					'created_user_id'=>$_SESSION['USER']['DATA']['USER_ID'],
					'customer_id'=>$_SESSION['USER']['DATA']['CUSTOMER_ID'],
					'order_type'=>$_SESSION['ORDER']['META']['ORDER_TYPE'],
					'from_channel'=>$_SESSION['ORDER']['META']['FROM_CHANNEL'],
					'to_channel'=>$_SESSION['ORDER']['META']['TO_CHANNEL'],
					'target_function'=>$_SESSION['ORDER']['META']['TARGET_FUNCTION']
					),
					'crm_orders_data'=>$orderData,
					'crm_orders_statuses'=>
						array(
						'status_id'=>(($_SESSION['ORDER']['META']['INITIAL_STATUS'])?$_SESSION['ORDER']['META']['INITIAL_STATUS']:4),
						'remote_ip'=>$_SERVER['REMOTE_ADDR'],
						'user_fullname'=>$_SESSION['CUSTOMER']['DATA']['DATA']['FORENAME'].' '.$_SESSION['CUSTOMER']['DATA']['DATA']['SURNAME'],
						'user_id'=>$_SESSION['USER']['DATA']['USER_ID']),
					'crm_orders_meta'=>
						array(
							'process_immediately'=>$_SESSION['ORDER']['META']['PROCESS_IMMEDIATELY'],
							'voucher_config_id'=>$_SESSION['ORDER']['META']['VOUCHER_CONFIG_ID']
						)
					)
*/

class VwsClient extends SoapClient
{
    private $payment;
    private $error;

    public function __construct(string $wsdl)
    {
        parent::__construct($wsdl, [
            "trace" => true,
            "compression" => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP
        ]);
    }
/*
save payment -- savePaymentOrder($countryID,$data,$orderID,$status)
$payment->getCountry(),
[
"reference_number" => 'OTT_SELFSERVICE_PAYMENT',
"customer_id" => $payment->getCustnum(),
"finaccnum" => $payment->getFinancialAccountNumber(),
"currency" => $payment->getCurrency(),
"amount" => $payment->getNormalAmount(),
"description" => $payment->getDescriptionForCustomer(),
"bank" => $payment->getChannel(),
"service_id" => $payment->getServiceProvider(),
"country_id" => $payment->getCountry(),
],
$payment->getInternalId(),
$payment->getStatus(),
*/
    public function setPayment(PayseraPayment $payment)
    {
        $this->payment = $payment;
    }

    public function savePayment() : bool
    {
        try {
            $result = $this->savePaymentOrder(
                $this->payment->getCountry(), 'a',
                [
                    "reference_number" => $this->payment->getReferenceNumber(),
                    "customer_id" => $this->payment->getCustnum(),
                    "finaccnum" => $this->payment->getFinaccNum(),
                    "currency" => $this->payment->getCurrency(),
                    "amount" => $this->payment->getNormalAmount(),
                    "description" => $this->payment->getDescriptionForCustomer(),
                    "bank" => $this->payment->getBank(),
                    "service_id" => $this->payment->getServiceId(),
                    "country_id" => $this->payment->getCountry(),
                ],
                $this->payment->getInternalId(),
                $this->payment->getStatus()
            );

            if (is_int($result))
            {
                $this->payment->setInternalId($result);
                return true;
            }
            else
            {
                $this->error = 'VWS did not return a payment id';
                return false;
            }
        }
        catch(\ErrorException $exception)
        {
            $this->error = $exception->getMessage();
            return false;
        }
    }
}