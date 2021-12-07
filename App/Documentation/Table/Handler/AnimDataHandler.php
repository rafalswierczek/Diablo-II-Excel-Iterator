<?php

declare(strict_types=1);

namespace App\Documentation\Table\Handler;

use App\Documentation\Table\Model\AnimData;
use App\Collection\AnimDataCollectionInterface;

final class AnimDataHandler implements AnimDataHandlerInterface
{
    public function addRowDataToCollection(AnimDataCollectionInterface $animDataCollection, array $row): void
    {
        $characterCode = substr($row['CofName'], 0, 2) ?: '';
        $attackMode = substr($row['CofName'], 2, 2) ?: '';
        $wclass = substr($row['CofName'], 4, 3) ?: '';

        $animDataCollection->add((new AnimData)
            ->setCharacterCode($characterCode)
            ->setAttackMode($attackMode)
            ->setWclass($wclass)
            ->setFramesPerDirection((int)$row['FramesPerDirection'])
            ->setAnimationSpeed((int)$row['AnimationSpeed'])
        );
    }
}
