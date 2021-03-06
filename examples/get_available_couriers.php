<?php

/**
 * @author Massimo Vincenzi <massimo.vincenzi@storeden.com> 4 Qapla
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/** get all available couriers **/

require '../src/autoload.php';

try{
    $sdk = new Qapla\Qapla(['auth' => '{YOUR-AUTH-KEY}']);
}
catch(Qapla\QaplaSDKException $e){
    exit($e->getMessage());
}

$_response = $sdk->get('/1.1/getCouriers/');

var_dump($_response);

/** get italian couriers **/

$_response = $sdk->get('/1.1/getCouriers/', ['country' => 'it']);

/** checking for errors */
if($_response->getCouriers->result == 'KO'){

    echo $_response->getCouriers->error;
}
else{
    /** looping couriers */

    foreach($_response->getCouriers->courier as $courier){

        echo $courier->code.', '.$courier->name.', '.$courier->country.'<br/>';

    }
}