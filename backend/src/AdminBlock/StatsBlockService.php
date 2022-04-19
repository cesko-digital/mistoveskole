<?php

declare(strict_types=1);

/*
 * code reused from SonataAdmin / AdminStatsService
 */

namespace App\AdminBlock;

use Sonata\AdminBundle\Admin\Pool;
use Sonata\AdminBundle\Datagrid\DatagridInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\Service\AbstractBlockService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Environment;
use App\Entity;

/**
 */
final class StatsBlockService extends AbstractBlockService
{
    /** @var EntityManagerInterface */
    protected $em;

    public function __construct(Environment $twig, ManagerRegistry $registry)
    {
        parent::__construct($twig);
        $this->em = $registry->getManager('default');
    }

    public function execute(BlockContextInterface $blockContext, ?Response $response = null): Response
    {
        $template = $blockContext->getTemplate();
        \assert(null !== $template);

        return $this->renderPrivateResponse($template, [
            'block' => $blockContext->getBlock(),
            'settings' => $blockContext->getSettings(),
            'data' => $this->getCount($blockContext->getSettings()['type']),
        ], $response);
    }

    public function configureSettings(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'icon' => 'fas fa-chart-line',
            'text' => 'Statistics',
            'translation_domain' => null,
            'color' => 'bg-aqua',
            'title' => 'title',
            'template' => 'block/stats.html.twig',
            'type' => null,
// TODO route to more detail?
        ]);
    }

    protected function getCount($type): ?int
    {
        switch ($type) {
            case 'sumFree':
                $query = $this->em->createQueryBuilder()
                    ->select('SUM(z.kapacitaUkVolnoCelkem) as count')
                    ->from(Entity\Zarizeni::class, 'z')
                    ->where('z.aktivni = true')
                ;
                break;
            case 'sumOccupied':
                $query = $this->em->createQueryBuilder()
                    ->select('SUM(z.kapacitaUkObsazenoCelkem) as count')
                    ->from(Entity\Zarizeni::class, 'z')
                    ->where('z.aktivni = true')
                ;
                break;
            default:
                return null;
                break;
        }

        $result = $query->getQuery()
            ->getSingleScalarResult()
        ;

        return $result;
    }
}
