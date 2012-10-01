<?php
namespace ZendServerAPI\DataTypes;

class CodetracingList
{
    /**
     * Internal codetracing storage
     * @var array
     */
    protected $codetracing = array();
    
    /**
     * Add codetracing to container
     *
     * @param \ZendServerAPI\DataTypes\CodeTrace $codetrace
     */
    public function addCodeTrace(\ZendServerAPI\DataTypes\CodeTrace $codetrace)
    {
        $this->codetracing[] = $codetrace;
    }
    
    /**
     * Get codetrace array
     *
     * @return array
     */
    public function getCodetracing()
    {
        return $this->codetracing;
    }
}

?>