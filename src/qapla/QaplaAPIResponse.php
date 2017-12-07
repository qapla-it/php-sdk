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

 namespace Qapla;

 class QaplaAPIResponse {


	/**
	 * @type {Array} The connection response headers. Associative Array
	 */
	protected $headers;
	/**
	* @type {Array} The connection raw body. Use ->response to get object
	*/
	protected $body;
	/**
	* @type {Int} The HTTP response status code.
	*/
	protected $http_code;
	/**
	* @type {Object|Null} The connection response body.
	*/
	public $response = NULL;
	/**
	 * Create a new  entity
	 * @param       {String} $headers Raw connection response headers
	 * @param       {String} $body    Raw connection response body
	 * @constructor
	 */
	public function __construct($headers, $body){
		$this->getHeadersFromString($headers);
		$this->body = $body;
		$this->populateResponse();
	}

	/**
	 * Parse headers as string and create an associative array.
	 *
	 *	Set also connection http status code
	 *
	 * @param  {String} $headers Raw connection response headers
	 */
	private function getHeadersFromString($headers){
		$headers = str_replace("\r\n", "\n", $headers);
		$headers_locations = explode("\n\n", trim($headers));
		$_last_header = array_pop($headers_locations);
		$elements = explode("\n", $_last_header);
		foreach($elements as $header_line){
			if (strpos($header_line, ': ') === false) {
				$this->extractHttpCode($header_line);
			} else {
				list($key, $value) = explode(': ', $header_line, 2);
				$this->headers[$key] = $value;
			}
		}
	}
	
	/**
	 * Parse headers line to extract http status code
	 * @param  {String} $http_code_line Connection response header (Raw)
	 */
	private function extractHttpCode($http_code_line){
		$match = NULL;
		preg_match('|HTTP/\d\.\d\s+(\d+)\s+.*|', $http_code_line, $match);
		return $this->http_code = (int)$match[1];
	}

	/**
	 * Set "response" object from decodind json response from connection response body
	 */
	private function populateResponse(){
		$this->response = json_decode($this->body);
	}

	/**
	 * Return connection HTTP status code
	 * @return {Int} Connection HTTP status code
	 */
	public function getHttpCode(){
		return $this->http_code;
	}

	/**
	* Return connection headers as associative array
	* @return {Array} Connection Headers
	*/
	public function getHeaders(){
		return $this->headers;
	}

	/**
	* Return connection raw body
	* @return {String} Connection body
	*/
	public function getBody(){
		return $this->body;
	}


 }
