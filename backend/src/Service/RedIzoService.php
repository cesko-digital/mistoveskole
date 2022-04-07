<?php 

namespace App\Service;

use Psr\Log\LoggerInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TransferException;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/* get list and detail of MŠMT school by RedIzo code */

class RedIzoService
{
    /** @var LoggerInterface */
    protected $logger;

    /** @var ClientInterface */
    protected $apiClient;

    /** @var EntityManagerInterface */
    protected $em;

    /** @var string */
    protected $filePath;

    /** @var array */
    protected $data = null;

    public function __construct(
        LoggerInterface $logger,
        ManagerRegistry $managerRegistry,
        string $file,
    ) {
        $this->logger = $logger;
        $this->filePath = $file;
        $this->em = $managerRegistry->getManager('default');
    }

    protected function loadData(): void
    {
        if (is_array($this->data)) {
            return;
        }
        if (is_file($this->filePath)) {
            $handle = fopen($this->filePath, "r");
            if ($handle) {
                while (($line = fgets($handle)) !== false) {
                    $array = json_decode($line, true);
                    if (is_array($array) && isset($array['redIzo'])) {
                        $this->data[$array['redIzo']] = $array;
                    } else {
                        $this->logger->error("file $this->filePath is not valid json, strlen:".strlen($line));
                    }
                }
                fclose($handle);
                return;
            }
        } else {
            // log error
            $this->logger->error("file $this->filePath is missing or not readable");
        }
    }

    public function getRedIzoList(): array
    {
        $this->loadData();
        return array_keys($this->data);
    }

    public function getRedIzoDetail($redIzoId): array
    {
        if (isset($this->data[$redIzoId])) {
            return $this->data[$redIzoId];
        } else {
            $this->logger->warning("redIzo $redIzoId is missing data");
            return array();
        }
    }

}
