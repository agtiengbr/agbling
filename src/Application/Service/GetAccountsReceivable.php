<?php

namespace AGTI\Bling\Application\Service;

use AGTI\Bling\Entity\AgblingAccountsReceivable;
use AGTI\Bling\Entity\AgblingOrder;
use AGTI\Bling\Infrastructure\Service\Api\Bling\AccountsReceivable\GetAccountsReceivableService;
use AGTI\Bling\Infrastructure\Service\Api\Bling\DataModels\AccountsReceivableArgs;
use AGTI\Bling\ValueObject\ApiToken;
use Doctrine\ORM\EntityManagerInterface;

class GetAccountsReceivable
{
    use ApiApplicationTrait;

    private $apiService;
    private $em;

    public function __construct(GetAccountsReceivableService $apiService, EntityManagerInterface $em)
    {
        $this->apiService = $apiService;
        $this->em = $em;
    }

    /**
     * Fetch accounts receivable from the Bling API and store/update them in the database.
     *
     * @param \DateTime $dataInicial The start date from which to fetch accounts receivable.
     * @param ApiToken $token The API token for authentication.
     */
    public function exec(\DateTime $dataInicial, ApiToken $token)
    {
        $pagina = 1;
        do {
            // Set up the arguments for the API request
            $args = (new AccountsReceivableArgs())
                ->setPagina($pagina)
                ->setLimite(100)
                ->setSituacoes([1, 2, 3, 4, 5])
                ->setTipoFiltroData('E')
                ->setDataInicial($dataInicial)
                ->setDataFinal(new \DateTime());

            // Execute the API request
            $this->apiService->setToken($token);
            $response = $this->apiService->exec($args);
            $this->postApiRequest($this->apiService->getRequest(), $this->em);

            // Process the response data
            $data = $response->getData();
            foreach ($data as $accountReceivable) {
                // Check if the account receivable already exists in the database
                $entity = $this->em->getRepository(AgblingAccountsReceivable::class)->findOneBy(['blingId' => $accountReceivable->getId()]);

                if (!$entity) {
                    // Create a new entity if it doesn't exist
                    $entity = new AgblingAccountsReceivable();
                    $entity->setBlingId($accountReceivable->getId());
                }

                // Update the entity with the new data
                $entity->setDataEmissao($accountReceivable->getDataEmissao())
                    ->setValor($accountReceivable->getValor())
                    ->setDataVencimento($accountReceivable->getVencimento())
                    ->setSituacao($accountReceivable->getSituacao());

                // Set the associated Bling order if applicable
                if ($accountReceivable->getOrigem() && $accountReceivable->getOrigem()->getTipoOrigem() === 'venda') {
                    $blingOrder = $this->em->getRepository(AgblingOrder::class)->findOneBy(['idRemote' => $accountReceivable->getOrigem()->getId()]);
                    if ($blingOrder) {
                        $entity->setBlingOrder($blingOrder);
                    }
                }

                // Persist the entity to the database
                $this->em->persist($entity);
            }

            // Flush the changes to the database
            $this->em->flush();

            $pagina++;
        } while (!empty($data));
    }
}
