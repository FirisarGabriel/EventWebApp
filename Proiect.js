  function showEvents() {
    document.getElementById('events').style.display = 'flex';
    document.getElementById('eventDetails').style.display = 'none';

  }

  function showEventDetails(nume, descriere, data, loc, pret, idddd) {
    document.getElementById('events').style.display = 'none';
    document.getElementById('eventDetails').style.display = 'block';
    
    document.getElementById('eventTitle').innerText = nume;
    document.getElementById('eventDescription').innerText = descriere;
    document.getElementById('eventDateTime').innerText = data;
    document.getElementById('eventLoc').innerText = loc;
    document.getElementById('eventPrice').innerText = (pret+" Lei");
    document.getElementById("addToCartForm").action = "../cart/cos.php?action=add&id_eveniment=" + idddd;

  }
  