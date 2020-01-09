<?

    include_once( dirname(__FILE__) . '/policyCalculatorClass.php');

    if (!empty($_POST['car_value']) && !empty($_POST['the_day']) && !empty($_POST['the_hour']))
    {
        $policyCalculator = new policyCalculator( 
            $_POST['car_value'],
            $_POST['the_day'],
            $_POST['the_hour'],
            $_POST['instalments'],
            $_POST['tax_percantage'],
        );
        
        $theError = $policyCalculator->getError();

        if ( empty($theError)  )
        {
            $finalResTable = $policyCalculator->printTable();
        }   

        #else need to handle the error

    }

?>