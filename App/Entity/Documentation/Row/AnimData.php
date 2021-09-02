<?php declare(strict_types=1);

namespace App\Entity\Documentation\Row;

use App\Service\Documentation\Enum\AnimDataEnum;

class AnimData implements AnimDataEnum, RowInterface
{
    private string $characterCode;
    private string $attackMode;
    private string $wclass;
    private int $framesPerDirection;
    private int $animationSpeed;

    public function getUniqueKey(): array
    {
        return ['character_code' => $this->getCharacterCode(), 'attack_mode' => $this->getAttackMode(), 'wclass' => $this->getWclass()];
    }

    public function getCofName(): string
    {
        return $this->getCharacterCode().$this->getAttackMode().$this->getWclass();
    }
    
    public function setCharacterCode(string $characterCode): self
    {
        $this->characterCode = $characterCode;
        return $this;
    }
    public function getCharacterCode(): string
    {
        return $this->characterCode;
    }

    public function setAttackMode(string $attackMode): self
    {
        $this->attackMode = $attackMode;
        return $this;
    }
    public function getAttackMode(): string
    {
        return $this->attackMode;
    }

    public function setWclass(string $wclass): self
    {
        $this->wclass = $wclass;
        return $this;
    }
    public function getWclass(): string
    {
        return $this->wclass;
    }

    public function setFramesPerDirection(int $framesPerDirection): self
    {
        $this->framesPerDirection = $framesPerDirection;
        return $this;
    }
    public function getFramesPerDirection(): int
    {
        return $this->framesPerDirection;
    }

    public function setAnimationSpeed(int $animationSpeed): self
    {
        $this->animationSpeed = $animationSpeed;
        return $this;
    }
    public function getAnimationSpeed(): int
    {
        return $this->animationSpeed;
    }
}