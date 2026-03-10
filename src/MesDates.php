<?php

namespace UPJV;

use DateTime;

class MesDates
{
    /**
     * Renvoie la date de demain au format JSON.
     *
     * @return string
     */
    public function demain(): string
    {
        $date = new DateTime('tomorrow');
        return json_encode([
            'demain' => $date->format('d-m-Y')
        ]);
    }
}
