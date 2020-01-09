<?
class policyCalculator
{

    function __construct(float $carPrice,int $theDay, int $theHour, int $instalment = 1, float $taxValue = 0)
    {
        $this->carPrice     = $this->trimArg($carPrice);
        $this->instalment   = $this->trimArg($instalment);
        $this->taxValue     = $this->trimArg($taxValue);

        $this->theDay       = $this->trimArg($theDay);
        $this->theHour      = $this->trimArg($theHour);

        $this->lastError = "";

        if ( !is_numeric( $this->theDay ) ||  !is_numeric( $this->theHour ))
        {
            $this->lastError = 'You need to ensure Javascript is enabled in your browser';
            return false;
        }  
  

        if ( !is_numeric( $this->carPrice ) || $this->carPrice < 100 ||  $this->carPrice > 100000 )
        {
            $this->lastError = 'Your car price must be numeric and between 100 and up tp 100,000 EUR';
            return false;
        }

        if ( !is_numeric( $this->taxValue ) || $this->taxValue < 0 ||  $this->taxValue > 100 )
        {
            $this->lastError = 'Tax value must be numeric and between 0 to 100';
            return false;
        }  

        if ( !is_numeric( $this->instalment ) || $this->instalment < 1 ||  $this->instalment > 12 )
        {
            $this->lastError = 'Tax installment must be numeric and between 1 to 12';
            return false;
        }   


        $this->config = include( dirname(__FILE__) . '/config.php');        

    }

    private function getBasePrice()
    {
        if ($this->theDay == 5 && $this->theHour >= 15 && $this->theHour >= 20 )
        {
            $this->theBasePricePcntg = $this->getConfig('POLICY_FRIDAY');
        }
        else
            $this->theBasePricePcntg = $this->getConfig('POLICY_REGULAR');
        #else
        $this->getBasePrice = ($this->theBasePricePcntg * $this->carPrice) / 100;      
        
        return; 
    }

    private function getCommissionValue()
    {
        return ($this->getConfig('COMMISSION_FEE') * $this->getBasePrice) / 100;      
    }

    private function getTaxPrice()
    {
        return ($this->taxValue * $this->getBasePrice) / 100;      
    }


    /**
    * Print out REQUEST arguments without special characters 
    *
    * @return String
    */	
	private function trimArg( string $arg )
	{
		$clearStr = preg_replace('/[^a-zA-Z0-9\s]/', '', $arg);
		return trim($clearStr);
	}

    private function getInstalmentAmounts()
    {
        
        $this->instalmentAmounts = array(
            'base_price_pm'    => number_format(($this->totalAmounts['base_price'] / $this->instalment) , 2),
            'commission_pm'    => number_format(($this->totalAmounts['commission'] / $this->instalment) , 2),
            'tax_price_pm'     => number_format(($this->totalAmounts['tax_price'] / $this->instalment) , 2)
        );
        
        return;
    }


    private function getTotalAmounts()
    {
        
        $this->getBasePrice();

        $this->totalAmounts = array(
            'base_price'    => $this->getBasePrice,
            'commission'    => $this->getCommissionValue(),
            'tax_price'     => $this->getTaxPrice()
        );
        
        return;
    }

    
    /**
    * This function will give access to configuration values
    *
    * @return String
    */    
    private function getConfig($theKey)
    {
        return $this->config[$theKey];
    }


    /**
    * Print out latest error happened in this app
    *
    * @return String
    */
    public function getError()
    {
        return $this->lastError;
    }


    /**
    * Print out final result table contains all calculations
    *
    * @return LongText
    */
    
    public function getFinalAmounts()
    {
        $this->getTotalAmounts();

        $this->getInstalmentAmounts();

        $this->printableAmounts = array(
            'instalmentsAmounts'   => $this->instalmentAmounts,
            'totalsAmounts'        => $this->totalAmounts,
            'instalmentsCount'     => $this->instalment,
            'basePricePcntg'       => $this->theBasePricePcntg,
            'commissionPcntg'      => $this->getConfig('COMMISSION_FEE'),
            'taxPcntg'             => $this->taxValue,
        );

        return;
    }

    
    /**
    * Print out final result table contains all calculations
    *
    * @return Array
    */
    public function printTable()
    {
        
        /*
        first app needs to calculate amounts
        */
        $this->getFinalAmounts();
        
        $thContent  = '<th></th><th>Policy</th>';
        $cmsContent = '<th>Commission ('.$this->printableAmounts['commissionPcntg'].'%)</th>
        <th>'.number_format($this->printableAmounts['totalsAmounts']['commission'],2).'</th>';

        $taxContent = '<th>Tax ('.$this->printableAmounts['taxPcntg'].'%)</th>
        <th>'.number_format($this->printableAmounts['totalsAmounts']['tax_price'] , 2).'</th>';

        $baseContent = '<th>Base Premium ('.$this->printableAmounts['basePricePcntg'].'%)</th>
        <th>'.number_format($this->printableAmounts['totalsAmounts']['base_price'] ,2).'</th>';
        
        $totalContent = '<th>Total cost</th><th>'.number_format($this->printableAmounts['totalsAmounts']['base_price']+$this->printableAmounts['totalsAmounts']['tax_price']+$this->printableAmounts['totalsAmounts']['commission'] , 2).'</th>';


        $totalPerMonth = number_format($this->printableAmounts['instalmentsAmounts']['base_price_pm'] + $this->printableAmounts['instalmentsAmounts']['tax_price_pm'] + $this->printableAmounts['instalmentsAmounts']['commission_pm'] , 2);

        for( $inst=1; $inst<= $this->printableAmounts['instalmentsCount'] ; $inst++)
        {
            $thContent   .= '<th>'.$inst.' installment</th>';
            $cmsContent  .= '<td>'.$this->printableAmounts['instalmentsAmounts']['commission_pm'].'</td>';
            $taxContent  .= '<td>'.$this->printableAmounts['instalmentsAmounts']['tax_price_pm'].'</td>';
            $baseContent .= '<td>'.$this->printableAmounts['instalmentsAmounts']['base_price_pm'].'</td>';

            $totalContent .= '<td>'. $totalPerMonth .'</td>';

        }


        $theTable = '<table class="table table-sm table-border table-stripped">
        <thead>
        <tr>' . $thContent . '</tr></thead>
        <tbody>
        <tr><th>Value</th><td>'.number_format($this->carPrice ,2).'</td></tr>
        <tr>' . $baseContent . '</tr>
        <tr>' . $cmsContent . '</tr>
        <tr>' . $taxContent . '</tr>
        <tr>' . $totalContent .'</tr>
        </tbody></table>';

        return $theTable;



    }


}




   