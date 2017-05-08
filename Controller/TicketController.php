<?php

namespace TicketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use TicketBundle\Form\TicketOrderType;
use TicketBundle\Entity\TicketOrder;

class TicketController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        //checking if tickets are sold out
        $all = $em->getRepository('TicketBundle:TicketOrder')->getAllUserInfo();
        return $this->render('TicketBundle:Ticket:index.html.twig', ['entities' => $all]);
    }

    public function placeOrderAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        //checking if tickets are sold out
        $canAdd = $em->getRepository('TicketBundle:TicketOrder')->canAddTickets(10, 0);
        if (!$canAdd) {
            return $this->render('TicketBundle:Ticket:soldout.html.twig');
        }

        $entity = new TicketOrder();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        if ($form->isValid()) {

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ticket_thanks'));
        }
        return $this->render('TicketBundle:Ticket:placeOrder.html.twig', ['form' => $form->createView()]);
    }

    /**
     * Creates a form to create a TicketOrder entity.
     *
     * @param TicketOrder $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TicketOrder $entity)
    {
        $form = $this->createForm(TicketOrderType::class, $entity, array(
            'action' => $this->generateUrl('ticket_homepage'),
            'method' => 'POST'
        ));

        $form->add('submit', SubmitType::class, array('label' => 'ticket.place-order'));

        return $form;
    }

    public function getTicketNumberAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $number = $request->get('number');
        $canAdd = $em->getRepository('TicketBundle:TicketOrder')->canAddTickets(10, $number);
        $response = new JsonResponse();

        return $response->setData(['status' => $canAdd]);
    }

    /**
     * showing thanks to user who buy tickets
     */
    public function thanksAction()
    {
        return $this->render('TicketBundle:Ticket:thanks.html.twig');
    }
}
