var candidateBtn =  document.getElementById('candidateEvent');
var employerBtn = document.getElementById('employerEvent');
var input = document.getElementById('user_type_id');
var choice = document.getElementById('employerTypeChoice');
var personalEmployer = document.getElementById('personalEmployer');
var companyEmployer = document.getElementById('companyEmployer');
var dateGenderDiv = document.getElementById('date_gender');
candidateBtn.addEventListener("click", candidate);
 function candidate() {
    candidateBtn.classList.add('active')
    input.value = 1
    if (employerBtn.classList.contains('active')) {
        employerBtn.classList.remove('active')
    }
    if (!choice.classList.contains('visually-hidden')) {
        choice.classList.add('visually-hidden')
    }

    if (dateGenderDiv.classList.contains('visually-hidden')) {
        dateGenderDiv.classList.remove('visually-hidden')
    }
    if (companyEmployer.classList.contains('active')) {
        companyEmployer.classList.remove('active')
    }
    if (personalEmployer.classList.contains('active')) {
        personalEmployer.classList.remove('active')
    }
 }


 employerBtn.addEventListener("click", employer)

 function employer() {
    // input.value = 2
    employerBtn.classList.add('active')
    choice.classList.remove('visually-hidden')
    if (candidateBtn.classList.contains('active')) {
        candidateBtn.classList.remove('active')
    }

 }

 personalEmployer.addEventListener('click', personalEvent)
 function personalEvent() {
    input.value = 2
    personalEmployer.classList.add('active')
    if (companyEmployer.classList.contains('active')) {
        companyEmployer.classList.remove('active')
    }
    if (dateGenderDiv.classList.contains('visually-hidden')) {
        dateGenderDiv.classList.remove('visually-hidden')
    }
 }

 companyEmployer.addEventListener('click', companyEvent)

 function companyEvent(){
    input.value = 3
    companyEmployer.classList.add('active')
    if (personalEmployer.classList.contains('active')) {
        personalEmployer.classList.remove('active')
    }
    dateGenderDiv.classList.add('visually-hidden')
 }

 if (input.value == 1) {
    candidateBtn.classList.add('active')
 } else if(input.value == 2){
    employerBtn.classList.add('active')
    choice.classList.remove('visually-hidden')
    personalEmployer.classList.add('active')
 }else if(input.value == 3) {
    employerBtn.classList.add('active')
    choice.classList.remove('visually-hidden')
    companyEmployer.classList.add('active')
    dateGenderDiv.classList.add('visually-hidden')
}
