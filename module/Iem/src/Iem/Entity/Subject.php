<?php

namespace Iem\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


use Zend\InputFilter\Factory as InputFactory;     // <-- Add this import
use Zend\InputFilter\InputFilter;                 // <-- Add this import
use Zend\InputFilter\InputFilterAwareInterface;   // <-- Add this import
use Zend\InputFilter\InputFilterInterface;        // <-- Add this import
/**
 * An example of how to implement a role aware user entity.
 *
 * @ORM\Entity
 * @ORM\Table(name="subject")
 *
 * @author Cristian Incarnato
 */
class Subject extends \Iem\Entity\ExtendedEntity implements InputFilterAwareInterface {

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=50, unique=false, nullable=true)
     */
    protected $name;
 

       /**
     * @var string
     * @ORM\Column(type="string",  length=250,unique=false, nullable=true)
     */
    protected $subject;
    
   
     
     /**
     * 
     * @ORM\ManyToOne(targetEntity="Iem\Entity\Grouping")
     * 
     */
    protected $grouping;
 


    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

   

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function setSubject($subject) {
        $this->subject = $subject;
    }

    
    public function getGrouping() {
        return $this->grouping;
    }

    public function setGrouping($grouping) {
        $this->grouping = $grouping;
    }

        
     public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();


            $inputFilter->add($factory->createInput(array(
                        'name' => 'name',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 1,
                                    'max' => 40,
                                ),
                            ),
                        ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        return null;
    }
    
    public function __toString() {
        return $this->name;
    }



}

