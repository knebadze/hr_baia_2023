var candidateBtn =  document.getElementById('candidateEvent');
var employerBtn = document.getElementById('employerEvent');
var input = document.getElementById('user_type_id');

candidateBtn.addEventListener("click", candidate);
 function candidate() {
    candidateBtn.classList.add('active')
    input.value = 1
    if (employerBtn.classList.contains('active')) {
        employerBtn.classList.remove('active')
    }

 }


 employerBtn.addEventListener("click", employer)
 function employer() {
    input.value = 2
    employerBtn.classList.add('active')
    if (candidateBtn.classList.contains('active')) {
        candidateBtn.classList.remove('active')
    }
 }

