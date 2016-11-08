<?php


class Games implements JsonSerializable
{
    //Propiedades
    private $id;
    private $title;
    private $cover;
    private $buyprice;
    private $buydate;
    private $console;

    /**
     * Games constructor.
     */
    public function __construct()
    {
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * @param mixed $cover
     */
    public function setCover($cover)
    {
        $this->cover = $cover;
    }

    /**
     * @return mixed
     */
    public function getBuyprice()
    {
        return $this->buyprice;
    }

    /**
     * @param mixed $buyprice
     */
    public function setBuyprice($buyprice)
    {
        $this->buyprice = $buyprice;
    }

    /**
     * @return mixed
     */
    public function getBuydate()
    {
        return $this->buydate;
    }

    /**
     * @param mixed $buydate
     */
    public function setBuydate($buydate)
    {
        $this->buydate = $buydate;
    }

    /**
     * @return mixed
     */
    public function getConsole()
    {
        return $this->console;
    }

    /**
     * @param mixed $console
     */
    public function setConsole($console)
    {
        $this->console = $console;
    }


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return [
            'game_id' =>$this->id,
            'game_title' =>$this->title,
            'game_buyPrice' =>$this->buyprice,
            'game_buyDate' =>$this->buydate,
            'game_console' =>$this->console,
        ];
    }
}