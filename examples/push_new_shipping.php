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

$sdk = new Qapla\Qapla(['auth' => '{YOUR-AUTH-KEY}']);

$my_shipping = [
	'pushTrack' => [
		[
			'trackingNumber' => '{your-tracking_numner}',
			'courier' => 'BRT',
			'shipDate' => 'YYYY-MM-DD',
			'reference' => '{YOUR-SHIPPING-ID}'
		]
	]
];


$_response = $sdk->post('/1.1/pushTrack/', $my_shipping);

var_dump($_response);
