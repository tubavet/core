<?php

namespace App\Exceptions\VisitTransfer\Application;

class AttemptingToTransferToNonTrainingFacilityException extends \Exception
{
    private $facility;

    public function __construct($facility)
    {
        $this->facility = $facility;

        $this->message = "It isn't possible to transfer to a facility that isn't open to training.";
    }

    public function __toString()
    {
        return $this->message;
    }
}
