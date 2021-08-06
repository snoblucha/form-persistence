<?php
declare(strict_types=1);

namespace PunktDe\Form\Persistence\Domain\FormDataCleanup;

/*
 *  (c) 2021 punkt.de GmbH - Karlsruhe, Germany - https://punkt.de
 *  All rights reserved.
 */

use Doctrine\ORM\ORMException;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\Exception\IllegalObjectTypeException;
use Neos\Flow\Persistence\Exception\InvalidQueryException;
use PunktDe\Form\Persistence\Domain\Model\FormData;
use PunktDe\Form\Persistence\Domain\Repository\FormDataRepository;

class FormDataCleanupService
{

    /**
     * @Flow\Inject
     * @var FormDataRepository
     */
    protected $formDatarepsoitroy;

    /**
     * @Flow\InjectConfiguration(package="PunktDe.Form.Persistence", path="formDataCleanup.retentionPeriod")
     * @var string
     */
    protected $dateInterval;

    /**
     * @throws ORMException
     * @throws \Exception
     */
    public function cleanupOldFormData(): int
    {
        $date = (new \DateTime())->sub(new \DateInterval($this->dateInterval));
        return $this->formDatarepsoitroy->deleteAllOlderThan($date);
    }
}
