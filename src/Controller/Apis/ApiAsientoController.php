<?php
namespace App\Controller\Apis;
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\Types\Types;
use App\Entity\Asiento;
use App\Controller\Json;
use App\Repository\AsientoRepository;



#[IsGranted('ROLE_ADMIN')]
#[Route('/admin/apiasiento', name: 'apiasiento')]
class ApiAsientoController extends AbstractController
{

    private $ar;

    public function __construct(private ManagerRegistry $doctrine,AsientoRepository $ar)
    {
        $this->ar=$ar;
      
    }

     
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/dameasiento', name: 'dameasiento',methods:"GET")]
    public function dameasiento(int $idasiento)
    {
        $asiento = $this->ar->find($idasiento);
    
        $data = [
            'id' => $asiento->getId(),
            'avion' => $asiento->getAvion()->getModelo(),
            'fila' => $asiento->getFila(),
            'columna' => $asiento->getColumna(),
            'clase' => $asiento->getClase(),
            'ocupado' => $asiento->isOcupado(),
            'vuelo' => $asiento->getVuelo()->getId(),     
        ];
     
   
     $response = new JsonResponse();

    if ($data===[]) {

        $response->setContent(json_encode(array(
            'success' => false,
        )));
        $response->setStatusCode('202');
        return $response;
    }
    else
    {
        $response->setContent(json_encode(array(
            'success' => true,
            'data' => $data,
        )));
        $response->setStatusCode('200');
        return $response;
    }        
    }


    #[IsGranted('ROLE_ADMIN')]
    #[Route('/dameasientos/{idvuelo}', name: '/admin/dameasientos',methods:"GET")]
    public function dameasientosDelVuelo(int $idvuelo)
    {
                $asientos = $this->ar->createQueryBuilder('c')
                ->andWhere('c.vuelo = :vueloId')
                ->setParameter('vueloId', $idvuelo)
                ->getQuery()
                ->getResult()
            ;
            $data=[];
    
            foreach ($asientos as $asiento) {
               
                $data[] = [
                    'id' => $asiento->getId(),
                    'avion' => $asiento->getAvion()->getId(),
                    'fila' => $asiento->getFila(),
                    'columna' => $asiento->getColumna(),
                    'clase' => $asiento->getClase(),
                    'ocupado' => $asiento->isOcupado(),
                    'vuelo' => $asiento->getVuelo()->getId(), 
                ];
             }
           
             $response = new JsonResponse();
    
            if ($data===[]) {
     
                $response->setContent(json_encode(array(
                    'success' => false,
                )));
                $response->setStatusCode('202');
                return $response;
            }
            else
            {
                $response->setContent(json_encode(array(
                    'success' => true,
                    'data' => $data,
                )));
                $response->setStatusCode('200');
                return $response;
            }         
    }
    
}
?>