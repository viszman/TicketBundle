# TicketBundle
to make it work these steps need to be done

edit app/config.yml
  add
  imports:
    ...
    - { resource: "@TicketBundle/Resources/config/services.yml" }

second add this line in AppKernel.php
  new TicketBundle\TicketBundle(),
  
build database with doctrine command console doctrine:schema:update --force

to add tickets visit
localhost/ticket
to check what was added visit
localhost/ticket/index
