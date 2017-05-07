<?php

namespace TicketBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketOrderType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label' => 'ticket.name'])
            ->add('email', null, ['label' => 'ticket.email'])
            ->add('pesel', null, ['label' => 'ticket.pesel'])
            ->add('ticketsNumber', null, ['label' => 'ticket.numer', 'attr' => ['step' => 1, 'max' => 3, 'min' => 0, 'class' => 'tickets-number']]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TicketBundle\Entity\TicketOrder'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ticketbundle_ticketorder';
    }


}
