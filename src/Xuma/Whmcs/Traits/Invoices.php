<?php namespace Xuma\Whmcs\Traits;

trait Invoices {

    /**
     * Get invoices.
     * @param $params
     * @return bool
     */
    public function getInvoices($params)
    {
        $response = $this->getJson('getinvoices',$params);

        return ($response->numreturned>0) ? $response->invoices['invoice'] :false;
    }

    /**
     * This is a custom api function that
     * i create for getting invoices with items.
     *
     * @param $params
     * @return bool
     */
    public function getCustomInvoices($params)
    {
        $response = $this->getJson('getinvoiceswithitems',$params);

        return ($response->numreturned>0) ? $response->invoices :false;
    }
}