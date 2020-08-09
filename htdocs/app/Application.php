<?php


namespace App;

class Application extends \Illuminate\Foundation\Application
{

    /**
     * public_path()変更用
     * @return string
     */
    public function publicPath()
    {
        // return dirname($this->basePath);
        return dirname($this->basePath . 'public');
    }

}
