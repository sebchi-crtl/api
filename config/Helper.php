<?php 

    class Helper{


        public function get_curl($url)
        {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array('Content-Type: application/json', 0)
            ));
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                return "cURL Error #:" . $err;
            } 
            else{
                $data = json_decode($response,true);
                return $data;
            }
        }
        public function get_ip()
        {

            foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
                if (array_key_exists($key, $_SERVER) === true){
                    foreach (explode(',', $_SERVER[$key]) as $ip){
                        $ip = trim($ip); // just to be safe
                        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                            return $ip;
                        }
                    }
                }
            }

            // $ipaddress = '';
            // if (getenv('HTTP_CLIENT_IP'))
            //     $ipaddress = getenv('HTTP_CLIENT_IP');
            // else if(getenv('HTTP_X_FORWARDED_FOR'))
            //     $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
            // else if(getenv('HTTP_X_FORWARDED'))
            //     $ipaddress = getenv('HTTP_X_FORWARDED');
            // else if(getenv('HTTP_FORWARDED_FOR'))
            //     $ipaddress = getenv('HTTP_FORWARDED_FOR');
            // else if(getenv('HTTP_FORWARDED'))
            // $ipaddress = getenv('HTTP_FORWARDED');
            // else if(getenv('REMOTE_ADDR'))
            //     $ipaddress = getenv('REMOTE_ADDR');
            // else
            //     $ipaddress = 'UNKNOWN';
            // return $ipaddress;
        }
        
    }