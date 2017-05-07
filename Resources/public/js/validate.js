
var ticketNumberInput = document.querySelector('.tickets-number');
ticketNumberInput.addEventListener('change', function() {
    var tickets = ticketNumberInput.value;
    $.ajax({
      url: document.querySelector('#settings').dataset.url,
      type: 'POST',
      data: {
          number: tickets,
      },
      success: function(data){
          document.querySelector('button').disabled = !data.status;
          document.querySelector('.info').innerHTML = data.status ?
            'Można złożyć zamówienie' :
            'Nie można złożyć zamówienia, nie ma tyle wolnych biletów';
      },
  });
});
