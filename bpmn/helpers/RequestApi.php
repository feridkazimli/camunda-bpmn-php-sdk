<?php
declare(strict_types=1);

namespace App\Bpmn\Helpers;

class RequestApi {
    protected $ch;
    protected $set;

    protected function __construct()
    {
        $this->ch = curl_init();
    }

    public static function post(string $url, array $data, array $header_body = [], array $set_options = [])
    {
        $reqeustapi = new RequestApi();

        $reqeustapi->co_url($url)
                ->co_ssl_verifyhost(0)
                ->co_ssl_verifypeer(0)
                ->co_post(1)
                ->co_postfields($data, 'json')
                ->co_setarray($set_options)
                ->co_returntransfer(true)
                ->co_followlocation(1)
                ->co_httpheader($header_body);

            
        $response = $reqeustapi->run();
        return $response;
    }

    public static function get(string $url, array $body = array(), array $header_body = array(), array $set_options = array())
    {
        $reqeustapi = new RequestApi();
        $reqeustapi->co_url($url, $body)
                ->co_ssl_verifyhost(0)
                ->co_ssl_verifypeer(0)
                ->co_setarray($set_options)
                ->co_returntransfer(true)
                ->co_followlocation(1)
                ->co_httpheader($header_body);

        $response = $reqeustapi->run($body);
        return $response;
    }

    protected function run()
    {
        $response = curl_exec($this->ch);
        $code = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        curl_close($this->ch);
        
        $result = [
            'code' => $code,
            'body' => json_decode($response, TRUE)
        ];

        return $result;
    }

    protected function co_setarray(array $set_options)
    {
        if (count($set_options) > 0) {
            $this->set = curl_setopt_array($this->ch, $set_options);
        }
        else
        {
            $this->set = '';
        }

        return $this;
    }

    protected function co_url($url, array $body = array())
    {
        if(!is_null($body))
        {
            $body = $this->parsedata($body, 'link');
        }
        $this->set = curl_setopt($this->ch, CURLOPT_URL, $url . $body);
        return $this;
    }

    protected function co_ssl_verifyhost($bool)
    {
        $this->set = curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, $bool);
        return $this;
    }

    protected function co_ssl_verifypeer($bool)
    {
        $this->set = curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, $bool);
        return $this;
    }

    protected function co_post($bool)
    {
        $this->set = curl_setopt($this->ch, CURLOPT_POST, $bool);
        return $this;
    }

    protected function co_nobody($bool)
    {
        $this->set = curl_setopt($this->ch, CURLOPT_NOBODY, $bool);
        return $this;
    }

    protected function co_headerfunc()
    {
        $this->set = curl_setopt($this->ch, CURLOPT_HEADERFUNCTION, function($ch, $header) {
            return $header;
        });

        return $this;
    }

    protected function co_postfields(array $data, $type = 'json')
    {
        $this->set = curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->parsedata($data, $type));
        return $this;
    }

    protected function co_returntransfer($bool)
    {
        $this->set = curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, $bool);
        return $this;
    }

    protected function co_followlocation($bool)
    {
        $this->set = curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, $bool);
        return $this;
    }

    protected function co_responeheader($bool)
    {
        $this->set = curl_setopt($this->ch, CURLOPT_HEADER, $bool);
        return $this;
    }

    protected function co_httpheader(array $header_body = [])
    {
        if(count($header_body) > 1)
        {
            $this->set = curl_setopt($this->ch, CURLOPT_HTTPHEADER, $header_body);
        }
        else
        {
            $this->set = '';
        }

        return $this;
    }

    protected function parsedata(array $data, $type = 'json') 
    {
        if($type == 'json')
        {
            return json_encode($data);
        }
        elseif($type == 'link')
        {
            return http_build_query($data);
        }
    }
}
?>