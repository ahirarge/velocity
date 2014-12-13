<?php namespace Ahir\Velocity;

use Input, Request, Config;
use Ahir\Velocity\Models\Logs;

class Velocity {

    /**
     * Package activation status
     * 
     * @var boolean
     */
    private $active = false;

    /**
     * Starting time  
     * 
     * @var integer
     */
    private $start;

    /**
     * Request informations 
     *
     * @var array
     */
    private $informations = [];

    /**
     * Banned urls 
     *
     * @var array
     */
    private $bans = [];

    /**
     * Constructer 
     *
     * @return null
     */
    public function __construct()
    {
        $this->active = Config::get('velocity::active');
        $this->bans   = Config::get('velocity::ban_url_array');
    }

    /**
     * Start
     *
     * @return null
     */
    public function start()
    {
        if ($this->active) {
            $this->start = $this->getTime();
        }
    }

    /**
     * Handling to requests
     *
     */
    public function handle($data)
    {
        if ($this->active) {   
            $this->informations = (object) [
                    'url'        => Request::path(),
                    'method'     => Request::method(),
                    'controller' => get_class($data),
                    'post_data'  => json_encode(Input::all()),
                ];
        }
    }

    /**
     * Bench
     *
     * @return null
     */
    public function stop()
    {
        if ($this->active) {   
            if (!is_object($this->informations)) {
                return false;
            }
            $this->informations->response_time = $this->getResponseTime();
            $this->informations->memory_usage  = memory_get_usage();
            $this->insertToModel();
        }
    }

    /**
     * Size To Str
     *
     * @param  integer 
     * @return string
     */
    public function sizeToStr($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 0) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 0) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 0) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' Byte';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' Byte';
        } else {
            $bytes = '0 Byte';
        }
        return $bytes;
    }

    /**
     * Getting response time 
     *
     * @return string
     */
    private function getResponseTime()
    {
        return number_format(
                $this->getTime() - $this->start, 4
            );
    }

    /**
     * Insert To Model
     *
     * @return null
     */
    private function insertToModel()
    {
        $model = new Logs;
        foreach ($this->informations as $key => $value) {
            $model->{$key} = $value;
        }
        foreach ($this->bans as $key => $value) {
            if (strpos($model->url, $value) !== false) return;
        }
        $model->save();
    }

    /** 
     * Get Time 
     *
     * @return  float
     */
    private function getTime()
    {
        $mtime = explode(" ", microtime()); 
        return $mtime[1] + $mtime[0];
    }

}