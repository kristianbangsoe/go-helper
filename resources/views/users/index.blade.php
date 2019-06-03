@extends('layouts.app')

@section('content')
<?php
function sign($params, $api_key) {
    $flattened_params = flatten_params($params);
    ksort($flattened_params);
    $base = implode(" ", $flattened_params);

    return hash_hmac("sha256", $base, $api_key);
}

function flatten_params($obj, $result = array(), $path = array()) {
    if (is_array($obj)) {
        foreach ($obj as $k => $v) {
            $result = array_merge($result, flatten_params($v, $result, array_merge($path, array($k))));
        }
    } else {
        $result[implode("", array_map(function($p) { return "[{$p}]"; }, $path))] = $obj;
    }

    return $result;
}

$params = array(
  "version"      => "v10",
  "merchant_id"  => 74307,
  "agreement_id" => 263977,
  "order_id"     => "0008",
  "amount"       => 1000,
  "currency"     => "DKK",
  "continueurl" => "http://shop.domain.tld/continue",
  "cancelurl"   => "http://shop.domain.tld/cancel",
  "callbackurl" => "http://shop.domain.tld/callback",
  "payment_methods" => "creditcard, !jcb, visa-us"
);

$params["checksum"] = sign($params, "729609f3b288903f9c09b7fc3fe552903c2a09ce919e679012a3fd30b79f8bb7");
 
?>
    <div id="app">
            <form method="POST" action="https://payment.coolpay.com/framed">
                <input name="version" type="hidden" value="v10" />
                <input name="merchant_id" type="hidden" value="74307" />
                <input name="agreement_id" type="hidden" value="263977" />
                <input name="order_id" type="hidden" value="0008" />
                <input name="amount" type="hidden" value="1000" />
                <input name="currency" type="hidden" value="DKK" />
                <input name="continueurl" type="hidden" value="http://shop.domain.tld/continue" />
                <input name="cancelurl" type="hidden" value="http://shop.domain.tld/cancel" />
                <input name="callbackurl" type="hidden" value="http://shop.domain.tld/callback" />
                <input name="checksum" type="hidden" value="<?php echo $params["checksum"]; ?>" />
                <input type="hidden" name="payment_methods" value="creditcard, !jcb, visa-us">
                <input type="submit" value="Continue to payment…" /></form>
        
        @if (Auth::check())
            <users-list m-user="{{ Auth::user()->id}}"></users-list> 
        @else 
            <users-list m-user="0"></users-list> 
        @endif 
    </div>
@endsection 

