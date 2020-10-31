<?php


namespace App\Payment;



class PayseraPayment
{
    private $internalId;
    private $country;
    private $status;
    private $finaccNum;
    private $custnum;
    private $serviceId;
    private $referenceNumber;
    private $normalAmount;
    private $currency;
    private $bank;

    public function __construct()
    {
        $this->setStatus();
        $this->setServiceId();
        $this->setReferenceNumber();
        $this->setCurrency();
    }

    /**
     * @return mixed
     */
    public function getInternalId()
    {
        return $this->internalId;
    }

    /**
     * @param mixed $internalId
     */
    public function setInternalId($internalId): void
    {
        $this->internalId = $internalId;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country): void
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status = PaymentStatus::NEW): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getFinaccNum()
    {
        return $this->finaccNum;
    }

    /**
     * @param mixed $finaccNum
     */
    public function setFinaccNum($finaccNum): void
    {
        $this->finaccNum = $finaccNum;
    }

    /**
     * @return mixed
     */
    public function getCustnum()
    {
        return $this->custnum;
    }

    /**
     * @param mixed $custnum
     */
    public function setCustnum($custnum): void
    {
        $this->custnum = $custnum;
    }

    /**
     * @return mixed
     */
    public function getServiceId()
    {
        return $this->serviceId;
    }

    /**
     * @param mixed $serviceId
     */
    public function setServiceId($serviceId = 'Paysera'): void
    {
        $this->serviceId = $serviceId;
    }

    /**
     * @return mixed
     */
    public function getReferenceNumber()
    {
        return $this->referenceNumber;
    }

    /**
     * @param mixed $referenceNumber
     */
    public function setReferenceNumber($referenceNumber = 'OTT_SELFSERVICE'): void
    {
        $this->referenceNumber = $referenceNumber;
    }

    /**
     * @return mixed
     */
    public function getNormalAmount()
    {
        return $this->normalAmount;
    }

    /**
     * @param mixed $normalAmount
     */
    public function setNormalAmount($normalAmount): void
    {
        $this->normalAmount = $normalAmount;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency = 'EUR'): void
    {
        $this->currency = $currency;
    }

    /**
     * @return mixed
     */
    public function getBank()
    {
        return $this->bank;
    }

    /**
     * @param mixed $bank
     */
    public function setBank($bank): void
    {
        $this->bank = $bank;
    }

    public function getDescriptionForCustomer() : string
    {
        return vsprintf('%s', [
            'desc for customer'
        ]);
    }


}