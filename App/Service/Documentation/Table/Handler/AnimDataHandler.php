<?php declare(strict_types=1);

namespace App\Service\Documentation\Table\Handler;

use App\Entity\Documentation\Row\AnimData;
use App\Collection\RowCollection;

final class AnimDataHandler
{
    public function addRowToCollection(RowCollection $rowCollection, array $row): void
    {
        $characterCode = substr($row['CofName'], 0, 2) ?: ''; // PHP 8, remove:  ?: '' 
        $attackMode = substr($row['CofName'], 2, 2) ?: '';
        $wclass = substr($row['CofName'], 4, 3) ?: '';

        // AnimData validator here

        $rowCollection->add((new AnimData)
            ->setCharacterCode($characterCode)
            ->setAttackMode($attackMode)
            ->setWclass($wclass)
            ->setFramesPerDirection((int)$row['FramesPerDirection'])
            ->setAnimationSpeed((int)$row['AnimationSpeed'])
        );
    }
}