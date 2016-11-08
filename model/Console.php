<?php

class Console implements JsonSerializable
{
    //Propiedades
    private $id;
    private $name;
    private $dateRelase;
    private $logo;

    /**
     * Console constructor.
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDateRelase()
    {
        return $this->dateRelase;
    }

    /**
     * @param mixed $dateRelase
     */
    public function setDateRelase($dateRelase)
    {
        $this->dateRelase = $dateRelase;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param mixed $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
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
            'console_id' =>$this->id,
            'console_name' =>$this->name,
            'console_dateRelease' =>$this->dateRelase,
        ];
    }
}