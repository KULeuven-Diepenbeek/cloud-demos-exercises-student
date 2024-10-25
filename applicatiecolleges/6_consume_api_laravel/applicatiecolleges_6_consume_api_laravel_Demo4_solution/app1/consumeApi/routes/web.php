<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/soap', function () {
    return view('soap');
});

Route::get('/soapAdd', function () {
    $num1 = request('num1');
    $num2 = request('num2');
    try {
        // URL of the SOAP service
        $wsdl = "http://www.dneonline.com/calculator.asmx?wsdl";
        
        // Create a new SoapClient instance
        $client = new SoapClient($wsdl);
    
        // Call the 'Add' method with parameters
        $params = [
            'intA' => 1,
            'intB' => 2,
        ];
        
        // Perform the SOAP request
        $response = $client->__soapCall('Add', [$params]);
        
        // Display the response
        $result = $response->AddResult;
         return response()->json(['result' => $result]);
    } catch (SoapFault $e) {
        return response()->json(['SOAP Error:' => $e->getMessage()]);
    }  
});

