<!DOCTYPE html>
<html>
<head>
    <title>კანდიდატის არასრული მონაცემები</title>
</head>
<body>
    <table class="w-full">
        <tr>
            <td class="w-half">
                <h2 style="text-align: center;">კანდიდატის არასრული მონაცემები</h2>
            </td>
            <td class="w-half">
                {{-- <img src="{{ asset('images/background/test.png') }}" alt="" width="200" /> --}}
                <img src="images/background/test.png" alt="" width="200" />
            </td>
        </tr>
    </table>

    <hr>
    
    <table>
        <tr>
            <td>სახელი</td>
            <td class="rightText">
                {{ $user['name_ka'] }} 
            </td>
        </tr>
        <tr>
          <td>დაბადების თარიღი</td>
          <td class="rightText">
              {{ $user['date_of_birth'] }} 
          </td>
        </tr>
        <tr>
          <td>ქვეყანა</td>
          <td class="rightText">
              @foreach ($citizenship as $item)
                  {{ $citizenship[0]['name_ka'] }}
              @endforeach   
          </td>
        </tr>
        <tr>
          <td>მოქალაქეობა:</td>
          <td class="rightText">
              @foreach ($citizenship as $item)
                  {{ $citizenship[0]['name_ka'] }}
              @endforeach   
          </td>
        </tr>
        <tr>
          <td>ქალაქი:</td>
          <td class="rightText">
              {{ $address_ka }}
          </td>
        </tr>
        <tr>
          <td>ეროვნება:</td>
          <td class="rightText">{{ $nationality['name_ka'] }}</td>
        </tr>
        <tr>
          <td>რელიგია</td>
          <td class="rightText">
              {{ $religion['name_ka'] }} 
          </td>
        </tr>
        <tr>
          <td>სქესი:</td>
          <td class="rightText">{{ $user['gender']['name_ka'] }} </td>
        </tr>  
        <tr>
          <td>განათლება</td>
          <td class="rightText">
              {{ $education['name_ka'] }}
          </td>
        </tr>    
        <tr>
          <td>პროფესია</td>
          <td class="rightText">
              {{ $professions[0]['name_ka'] }}
          </td>
        </tr> 
        <tr>
          <td>სპეციალობა</td>
          <td class="rightText">
              {{ $specialty[0]['name_ka'] }}
          </td>
        </tr>
        <tr>
          <td>ზოგადი მახასიათებლები</td>
          <td class="rightText">
              {{ $characteristic[0]['name_ka'] }}
          </td>
        </tr> 
        <tr>
          <td>ოჯახური მდგომარეობა</td>
          <td class="rightText">
              {{ $marital_status['name_ka'] }}
          </td>
        </tr>
        <tr>
          <td>შვილების რაოდენობა</td>
          <td class="rightText">
              {{ $children }}
          </td>
        </tr>
        <tr>
          <td>შვილების ასაკი</td>
          <td class="rightText">
              {{ $children_age }}
          </td>
        </tr>
        <tr>
          <td>მართვის მოწმობა</td>
          <td class="rightText">
              {{-- {{ $driving_license[] }} --}}NaN
          </td>
        </tr>
        <tr>
          <td>ალერგია</td>
          <td class="rightText">
              {{ $allergy[0]['name_ka'] }}
          </td>
        </tr>
        <tr>
          <td>ოპერაცია ან ქრონიკული დაავადება</td>
          <td class="rightText">
              {{ $medical_info_ka }} 
          </td>
        </tr>
        <tr>
          <td>დამატებითი მონაცემები</td>
          <td class="rightText">
              სიმაღლე: {{ $height }} სმ<br>
              წონა: {{ $weight }} კგ
          </td>
        </tr>
        <tr>
          <td>უცხო ენები</td>
          <td class="rightText">
            {{ $get_language[0]['language']['name_ka'] }}<br>
            {{ $get_language[0]['level']['name_ka'] }}
          </td>
        </tr>
        <tr>
          <td>ზოგადი სამუშაო გამოცდილება</td>
          <td class="rightText">
            სამუშაო გამოცდილება: {{ $general_work_experience[0]['name_ka'] }} <br>
            პოზიცია: {{ $general_work_experience[0]['pivot']['position_ka'] }} <br>
            ობიექტი: {{ $general_work_experience[0]['pivot']['object_ka'] }}
          </td>
        </tr>
        <tr>
          <td>კატეგორია და გრაფიკი</td>
          <td class="rightText">
              კატეგორია: {{ $get_work_information[0]['category']['name_ka'] }} <br>
              სამუშაო გრაფიკი: {{ $get_work_information[0]['get_work_schedule'][0]['work_schedule']['name_ka'] }} <br>
              ანაზღაურება: {{ $get_work_information[0]['payment'] }} <br>
              ვალიუტა: {{ $get_work_information[0]['currency']['name_ka']}}
          </td>
        </tr>
        <tr>
            <td>ოჯახში მუშაობის გამოცდილება</td>
            <td class="rightText">
                {{-- {{  }} <br> --}}
                მიმუშავია {{ $family_work_experience['families_worked_count'] }} ოჯახში <br>
                სტაჟი (ჯამში): {{ $family_work_experience['work_experience']['name_ka'] }} <br>
                ყველაზე ხანგრძლივად: {{ $family_work_experience['longest']['name_ka'] }} <br>
                {{-- ოჯახში ვმუშაობდი:  <br> --}}
                მეევალებოდა: {{ $family_work_experience['family_work_duty'][0]['name_ka'] }}
            </td>
        </tr>
        <tr>
          <td>რეკომენდაცია</td>
          <td class="rightText">
              {{ $recommendation[0]['name_ka'] }}
          </td>
        </tr>
    </table>
 
    <hr>

    <div class="footer margin-top">
        <div>პატივისცემით &copy; hrbaia.ge <a class="interested" href="https://hrbaia.ge/ka">დავინტერესდი</a></div>
    </div>

{{-- ---------------- --}}



{{-- CSS --}}
<style>
    body { font-family: DejaVu Sans, sans-serif; }

    table {
	  /* font-family: arial, sans-serif; */
	  border-collapse: collapse;
	  width: 100%;
	}
	
	td, th {
	  border: 1px solid #dddddd;
	  text-align: left;
	  padding: 8px;
	}

    .rightText {
        text-align: right;
    }
	
	tr:nth-child(even) {
	  background-color: #dddddd;
	}

    .footer {
        background-color: #dddddd;
        padding: 3%;
    }

    .interested {
        border: solid 1px #1967d2;
        border-radius: 10px;
        text-decoration: none;
        color: white;
        padding: 1%;
        background-color: #1967d2;
        float: right;
    }
</style>
</body>
</html>

{{-- 
არ უნდა იყოს: 
1) სახელი გვარი
2) ტელეფონი
3) ელ-ფოსტა
4) ფეისბუქ გვერდის ბმული
5) ზუსტი მისამარᲗი ( მაგ. Ჩანდეს მხოლოდ: ქალაქი და უბანი)
6) რეკომენდაცია წარმოდგენილია Თუ არა Ჩანდეს მხოლოდ დიახ/არას ნაწილᲨი, მაგრამ არავიᲗარ ᲨემᲗხვევაᲨი მიბმული ფაილი.
7) 11 ნიᲨნა პირადი ნომერი
ვაგრᲫელებ...
დავაზუსტებ: 1 - პუნქტᲨი სახელი Ჩანდეს და გვარი არა მხოლოდ და ასევე დაბადების ᲗარიᲦიც არ Ჩანდეს.
--}}
