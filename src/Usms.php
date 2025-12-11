<?php

namespace Urhitech\Usmsgh;

class Usms
{
    private static $curl_handle = null;
    /**
     * @param $request_method
     * @param $url
     * @param $api_token
     * @param $post_fields
     * @return mixed
     * 
     * Send Request to server and get sms status
     */

    private function send_server_response(string $endpoint, string $api_token, string $sender_id, string $recipient, string $message, ?string $request_method = null): mixed
    {
        // Initialize the curl handle if it is not initialized yet
        if (!isset(self::$curl_handle)) {
            self::$curl_handle = curl_init();
        }

        $data = json_encode([
            'recipient' => $recipient,
            'sender_id' => $sender_id,
            'message' => $message,
        ]);

        curl_setopt(self::$curl_handle, CURLOPT_URL, $endpoint);
        if ($request_method === 'post') {
            curl_setopt(self::$curl_handle, CURLOPT_POST, true);
            curl_setopt(self::$curl_handle, CURLOPT_POSTFIELDS, $data);
        }

        // request_method == PUT
        if ($request_method === 'put') {
            curl_setopt(self::$curl_handle, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt(self::$curl_handle, CURLOPT_POSTFIELDS, $data);
        }

        // request_method == PATCH
        if ($request_method === 'patch') {
            curl_setopt(self::$curl_handle, CURLOPT_CUSTOMREQUEST, 'PATCH');
            curl_setopt(self::$curl_handle, CURLOPT_POSTFIELDS, $data);
        }

        // request_method == DELETE
        if ($request_method === 'delete') {
            curl_setopt(self::$curl_handle, CURLOPT_CUSTOMREQUEST, 'DELETE');
        }

        curl_setopt(self::$curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(self::$curl_handle, CURLOPT_HTTPHEADER, [
            "accept: application/json",
            "authorization: Bearer ".$api_token
        ]);

        // Allow cURL function to execute 20sec
        curl_setopt(self::$curl_handle, CURLOPT_TIMEOUT, 20);

        // waiting 20 secs while waiting to connect
        curl_setopt(self::$curl_handle, CURLOPT_CONNECTTIMEOUT, 20);

        if ($e = curl_error(self::$curl_handle)) {
            return ['error' => $e];
        }
        
        $response = curl_exec(self::$curl_handle);
        return json_decode($response, true) ?? ['error' => 'Invalid response'];

    }


    /**
     * @param $url
     * @param $api_token
     * @param $post_fields
     * @return mixed
     * 
     * Send single / group SMS
     */
    public function sendSms(string $endpoint, string $api_token, string $sender_id, string $phones, string $message): array
    {
        $phoneNumbers = explode(',', $phones);
        $responses = [];
        
        foreach ($phoneNumbers as $phone) {
            $phone = trim($phone);
            $responses[] = $this->send_server_response($endpoint, $api_token, $sender_id, $phone, $message, 'post');
        }
        
        return count($responses) === 1 ? $responses[0] : $responses;
    }


    /**
     * @param $endpoint
     * @param $api_token
     * @param $sender_id
     * @param $phone
     * @param $message
     * @return mixed
     *
     * Send single
     */
    public function sendSingle(string $endpoint, string $api_token, string $sender_id, string $phone, string $message): mixed
    {
        return $this->send_server_response($endpoint, $api_token, $sender_id, $phone, $message, 'post');
    }


    /**
     * @param $url
     * @param $api_token
     * @return mixed
     * 
     * View an SMS
     */
    public function view_sms(string $url, string $api_token): mixed
    {
        return $this->send_server_response($url, $api_token, '', '', '', null);
    }


    /**
     * @param $url
     * @param $api_token
     * @return mixed
     * 
     * View profile
     */
    public function profile(string $url, string $api_token): mixed
    {
        return $this->send_server_response($url, $api_token, '', '', '', null);
    }


    /**
     * @param $url
     * @param $api_token
     * @return mixed
     * 
     * View sms credit balance
     */
    public function check_balance(string $url, string $api_token): mixed
    {
        return $this->send_server_response($url, $api_token, '', '', '', null);
    }



    /**
     * @param $url
     * @param $api_token
     * @param $post_fields => ['name' => 'your group name']
     * @return mixed
     * 
     * Create a new Contact Group
     */
    public function create_contact_group(string $endpoint, string $api_token, string $sender_id, string $phones, string $message): mixed
    {
        return $this->send_server_response($endpoint, $api_token, $sender_id, $phones, $message, 'post');
    }



    /**
     * @param $url
     * @param $api_token
     * @return mixed
     * 
     * View Contact Group
     */
    public function view_contact_group(string $url, string $api_token): mixed
    {
        return $this->send_server_response($url, $api_token, '', '', '', null);
    }



    /**
     * @param $url
     * @param $api_token
     * @param $post_fields
     * @return mixed
     * 
     * Update Contact Group
     */
    public function update_contact_group(string $endpoint, string $api_token, string $sender_id, string $phones, string $message): mixed
    {
        return $this->send_server_response($endpoint, $api_token, $sender_id, $phones, $message, 'patch');
    }



    /**
     * @param $url
     * @param $api_token
     * @return mixed
     * 
     * Delete Contact Group
     */
    public function delete_contact_group(string $url, string $api_token): mixed
    {
        return $this->send_server_response($url, $api_token, '', '', '', 'delete');
    }



    /**
     * @param $url
     * @param $api_token
     * @return mixed
     * 
     * View all Contact Groups
     */
    public function all_contact_groups(string $url, string $api_token): mixed
    {
        return $this->send_server_response($url, $api_token, '', '', '', null);
    }


    
    /**
     * @param $url
     * @param $api_token
     * @param $post_fields
     * @return mixed
     * 
     * Creates a new contact object
     */
    public function create_contact(string $endpoint, string $api_token, string $sender_id, string $phones, string $message): mixed
    {
        return $this->send_server_response($endpoint, $api_token, $sender_id, $phones, $message, 'post');
    }


    /**
     * @param $url
     * @param $api_token
     * @return mixed
     * 
     * Retrieves the information of an existing contact
     */
    public function view_contact(string $url, string $api_token): mixed
    {
        return $this->send_server_response($url, $api_token, '', '', '', null);
    }



    /**
     * @param $url
     * @param $api_token
     * @param $post_fields
     * @return mixed
     * 
     * Update an existing contact.
     */
    public function update_contact(string $endpoint, string $api_token, string $sender_id, string $phones, string $message): mixed
    {
        return $this->send_server_response($endpoint, $api_token, $sender_id, $phones, $message, 'patch');
    }



    /**
     * @param $url
     * @param $api_token
     * @return mixed
     * 
     * Delete an existing contact
     */
    public function delete_contact(string $url, string $api_token): mixed
    {
        return $this->send_server_response($url, $api_token, '', '', '', 'delete');
    }



    /**
     * @param $url
     * @param $api_token
     * @return mixed
     * 
     * View all contacts in group
     */
    public function all_contacts_in_group(string $url, string $api_token): mixed
    {
        return $this->send_server_response($url, $api_token, '', '', '', null);
    }

}