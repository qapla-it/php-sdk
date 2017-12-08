<?

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

/** Push a new array of shipping to track **/

require '../src/autoload.php';
try{
    $sdk = new Qapla\Qapla(['auth' => '{YOUR-AUTH-KEY}']);
}
catch(Qapla\QaplaSDKException $e){
    exit($e->getMessage());
}

$my_shipping = [
	'pushTrack' => [
		[
			'trackingNumber' => '{your-tracking_numner}',
			'courier' => 'BRT',
			'shipDate' => 'YYYY-MM-DD',
			'reference' => '{YOUR-SHIPPING-ID}'
		],
        [
            "trackingNumber" => "1Z0V5V416840696736",
            "courier" => "UPS",
            "shipDate" => "2014-08-02",
            "reference" => "ord. # 1674",
            "orderDate" => "2014-07-30",
            "name" => "Pepito Sbazzeguti",
            "street" => "Via Aieie, 99",
            "city" => "Parnazza",
            "ZIP" => "12345",
            "state" => "MQ",
            "country" => "IT",
            "email" => "name@domain.ext",
            "telephone" => "02342522",
            "agent" => "007@company.ext",
            "amount" => "150,00",
            "pod" => "1",
            "shipping" => "8,00",
            "custom1" => "valore custom 1",
            "custom2" => "valore custom 2",
            "custom3" => "valore custom 3",
            "note" => "This is a note",
            "deliveryDate" => "2014-07-31",
            "tag" => "customer1",
            "isTrackingNumber" => 1
        ]
	]
];

$_response = $sdk->post('/1.1/pushTrack/', $my_shipping);

var_dump($_response);

/** print imported shipments */
echo $_response->pushTrack->imported;
