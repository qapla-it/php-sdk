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

namespace Qapla;

class Qapla {

	const SDK_VERSION = '0.5-alpha';

	const AUTH_KEY = '';

	protected $config;

	protected $last_call_headers;

	public function __construct(array $config = []){

		$config = array_merge(
			[
				'auth' => static::AUTH_KEY
			],
			$config
		);

		if(empty($config['auth'])){
			throw new QaplaSDKException('A valid auth key has not specified in config');
		}

		$this->config = $config;

	}

	public function get($endpoint, $params = []){

		if(!empty($params)){
			return $this->api($endpoint.http_build_query($params), 'GET');
		}

		return $this->api($endpoint, 'GET');
	}

	public function post($endpoint, $params = []){

		return $this->api($endpoint, 'POST', $params);
	}

	private function api($endpoint, $method, $params = [], $callback = ''){

		$http_client = new HTTPClient();

		if($method == 'GET'){

			if( strpos('?', $endpoint) === false ){
				$endpoint .= '?auth='.$this->config['auth'];
			}else{
				$endpoint .= '&auth='.$this->config['auth'];
			}

		}elseif($method == 'POST'){
			$params['apiKey'] = $this->config['auth'];
		}

		$http_client->prepareConnection(
			$endpoint,
			$method,
			$params,
			[]
		);

		$http_client->execConnection();

		list($response_header, $response_body) = $http_client->getResponse();

		$http_client->closeConnection();

		$_response = new QaplaAPIResponse($response_header, $response_body);

		if($_response->getHttpCode() == "429"){
			throw new QaplaSDKException('You are doing to much connection to our system. You request has been throttled');
		}

		$this->last_call_headers = $_response->getHeaders();

		return $_response->response;

	}

	public function getLastCallHeaders(){
		return $this->last_call_headers;
	}
}
