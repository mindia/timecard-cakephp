<?php
/**
 * Ruffnote strategy for Opauth
 */

/**
 * Ruffnote strategy for Opauth
 *
 * @package			Opauth.Ruffnote
 */
class RuffnoteStrategy extends OpauthStrategy {

	/**
	 * Compulsory config keys, listed as unassociative arrays
	 */
	public $expects = array('client_id', 'client_secret');

	/**
	 * Optional config keys, without predefining any default values.
	 */
	public $optionals = array('redirect_uri', 'scope', 'state');

	/**
	 * Optional config keys with respective default values, listed as associative arrays
	 * eg. array('scope' => 'email');
	 */
	public $defaults = array(
		'redirect_uri' => '{complete_url_to_strategy}oauth2callback'
	);

	/**
	 * Auth request
	 */
	public function request() {
		$url = 'https://ruffnote.com/oauth/authorize';
		$params = array(
			'response_type' => 'code',
			'client_id' => $this->strategy['client_id'],
			'redirect_uri' => $this->strategy['redirect_uri'],
 			'state' => bin2hex(openssl_random_pseudo_bytes(24)),
		);

		foreach ($this->optionals as $key) {
			if (!empty($this->strategy[$key])) $params[$key] = $this->strategy[$key];
		}

		$this->clientGet($url, $params);
	}

	/**
	 * Internal callback, after OAuth
	 */
	public function oauth2callback() {
		if (array_key_exists('code', $_GET) && !empty($_GET['code'])) {
			$code = $_GET['code'];
			$url = 'https://ruffnote.com/oauth/token';

			$params = array(
 				'grant_type' => 'authorization_code',
				'code' => $code,
				'client_id' => $this->strategy['client_id'],
				'client_secret' => $this->strategy['client_secret'],
				'redirect_uri' => $this->strategy['redirect_uri'],
			);
			if (!empty($this->strategy['state'])) $params['state'] = $this->strategy['state'];

			$response = $this->serverPost($url, $params, null, $headers);
			$results = $this->recursiveGetObjectVars(json_decode($response));
			if (!empty($results) && !empty($results['access_token'])) {
				$user = $this->user($results['access_token']);
				$this->auth = array(
					'uid' => $user['id'],
					'info' => array(),
					'credentials' => array(
						'token' => $results['access_token']
					),
					'raw' => $user
				);

				$this->mapProfile($user, 'email', 'info.email');
				$this->mapProfile($user, 'username', 'info.name');
				$this->mapProfile($user, 'fullname', 'info.nickname');
				$this->mapProfile($user, 'description', 'info.description');
				$this->mapProfile($user, 'avatar_url', 'info.image');
				$this->mapProfile($user, 'html_url', 'info.urls.ruffnote');
				$this->mapProfile($user, 'url', 'info.url.ruffnote_api');

				$this->callback();
			}
			else {
				$error = array(
					'code' => 'access_token_error',
					'message' => 'Failed when attempting to obtain access token',
					'raw' => array(
						'response' => $response,
						'headers' => $headers
					)
				);

				$this->errorCallback($error);
			}
		}
		else {
			$error = array(
				'code' => 'oauth2callback_error',
				'raw' => $_GET
			);

			$this->errorCallback($error);
		}
	}

	/**
	 * Queries Ruffnote API for user info
	 *
	 * @param string $access_token
	 * @return array Parsed JSON results
	 */
	private function user($access_token) {
		$user = $this->serverGet('https://ruffnote.com/api/v1/me.json', array('access_token' => $access_token), null, $headers);

		if (!empty($user)) {
			return $this->recursiveGetObjectVars(json_decode($user));
		}
		else {
			$error = array(
				'code' => 'userinfo_error',
				'message' => 'Failed when attempting to query Ruffnote API for user information',
				'raw' => array(
					'response' => $user,
					'headers' => $headers
				)
			);

			$this->errorCallback($error);
		}
	}
}