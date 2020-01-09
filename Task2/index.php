<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insurance Policy Calculator</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="./assets/css/style.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.7.8/angular.min.js"></script>
    
</head>
<body ng-app="myApp" >
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal">Insurance Policy Calculator</h5>
    </div>  
    <div class="container">

    <?
        include_once( dirname(__FILE__) . '/handlePost.php');
        if ( !empty($theError))
            echo '<div class="alert alert-block alert-danger">'.$theError.'</div>';

    ?>
        <div class="row">
            <div class="col-md-12">
                <div class="p-3 border border-muted" ng-controller="formCtrl">
                    <form action="" class="row" name="policyCalculator" method="post" >
                        <input type="hidden" name="the_day" readonly value="{{dayOfWeek}}">
                        <input type="hidden" name="the_hour" readonly value="{{theHour}}">
                        <div class="col-md-4">
                            <label for="car_value">Enter Car Value</label>
                            <input type="number" name="car_value" class="form-control mb-4" minlenght="3" maxlength="6" rule-min="100" ng-required="true" rule-max="100000" placeholder="Enter amount between 100 to 100 000">
                        </div>
                        <div class="col-md-4">
                            <label for="tax_percantage">Enter Tax Percantage</label>
                            <input type="number" name="tax_percantage" class="form-control mb-4" minlenght="1" maxlength="3" rule-min="0" required rule-max="100" placeholder="Enter amount between 0 to 100" value="0">
                        </div>
                        <div class="col-md-4">
                            <label for="instalments">Instalments</label>
                            <select class="form-control mb-4" name="instalments">
                                <option ng-repeat="index in [1,2,3,4,5,6,7,8,9,10,11,12]" value="{{$index+1}}">{{$index+1}}</option>
                            </select>
                        </div>
                        <div class="col-md-4"> <button type="submit" class="btn btn-primary">Calculate</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12">
                <div class="pt-3">
                <?
                    if ( !empty($finalResTable))
                    {
                        echo 'Based on your car price ('.$_POST['car_value'].' EUR) and entered TAX value ('.$_POST['tax_percantage'].'%) here are result:<br><br>';
                        echo $finalResTable;
                    }    
                ?>
                    
                </div>
            </div>
        </div>
    </div>
    
    
    
    <script  src="https://code.jquery.com/jquery-3.4.1.min.js"  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
   
    <script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
   
    
    <script src="./assets/js/jquery-validate.bootstrap-tooltip.js"></script>
    <script  src="./assets/js/app.js"></script>

    
  </body>
</html>