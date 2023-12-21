<!DOCTYPE html>
<html>
<head>
    <title>კანდიდატის სრული მონაცემები</title>
</head>
<body>

    <table class="w-full">
        <tr>
            <td class="w-half">
                <h2 style="text-align: center;">კანდიდატის სრული მონაცემები</h2>
            </td>
            <td class="w-half">
              <img src="{{ public_path('images/user-avatar/' . $user['avatar']) }}" alt="" width="200">
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td>სახელი</td>
            <td class="rightText">
                {{ $user['name_ka'] }}
            </td>
        </tr>
        <tr>
            <td>ტელეფონი</td>
            <td class="rightText">
                {{ $user['number'] }}
            </td>
        </tr>
        <tr>
            <td>იმეილ მისამართ</td>
            <td class="rightText">
                {{ $user['email'] }}
            </td>
        </tr>
        <tr>
            <td>დაბადების თარიღი</td>
            <td class="rightText">
                {{ $user['date_of_birth'] }}
            </td>
          </tr>
          <tr>
            <td>სქესი</td>
            <td class="rightText">{{ $user['gender']['name_ka'] }} </td>
          </tr>
          <tr>
            <td>პირადი ნომერი</td>
            <td class="rightText">{{ $personal_number }} </td>
          </tr>
          <tr>
            <td>მოქალაქეობა</td>
            <td class="rightText">
              {{ implode(', ', array_column($citizenship, 'name_ka')) }}
            </td>
          </tr>
          <tr>
            <td>ეროვნება</td>
            <td class="rightText">{{ $nationality['name_ka'] }}</td>
          </tr>
        <tr>
          <td>რელიგია</td>
          <td class="rightText">
              {{ $religion['name_ka'] }}
          </td>
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
          @if ($marital_status['id'] != 1 )
            <tr>
              <td>შვილების რაოდენობა</td>
              <td class="rightText">
                  {{ $children }}
              </td>
            </tr>
            @if ($children && $children != 0)
            <tr>
              <td>შვილების ასაკი</td>
              <td class="rightText">
                  {{ $children_age }}
              </td>
            </tr>
            @endif
  
          @endif
  
          <tr>
            <td>მართვის მოწმობა</td>
            @if ($driving_license)
              <td class="rightText">
                  @foreach ($driving_license as $item)
                      <span>{{ $item['name'] }}</span>
                  @endforeach
  
              </td>
            @else
              <td class="rightText">
                  {{ __('არ აქვს') }}
              </td>
            @endif
  
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
            <td>სოციალური ქსელი</td>
            <td class="rightText">
                facebook: {{ $fb_link }}  <br>
                YouTube: {{ $youtube_link }} 
            </td>
          </tr>
          <tr>
            <td>მისამართი</td>
            <td class="rightText">
                {{ $address_ka }} <br>
                {{ $street_ka }}
            </td>
          </tr>
        <tr>
          <td>უცხო ენები</td>
          <td class="rightText">
            @foreach ($get_language as $item)
                <p>{{ $item['language']['name_ka'].' - '.$item['level']['name_ka'] }}</p>
            @endforeach
          </td>
        </tr>
        {{-- <tr>
          <td>დამატებითი ნომრები</td>
          <td class="rightText">
              NaN
          </td>
        </tr> --}}
        <tr>
          <td>ზოგადი სამუშაო გამოცდილება</td>
          <td class="rightText">
            @foreach ($general_work_experience as $item)
              <p>სამუშაო გამოცდილება: {{ $item['name_ka'] }} <br>
                პოზიცია: {{ $item['pivot']['position_ka'] }} <br>
                ობიექტი: {{ $item['pivot']['object_ka'] }}</p>
            @endforeach
          </td>
        </tr>
        <tr>
          <td>კატეგორია და გრაფიკი</td>
          <td class="rightText">
            @foreach ($get_work_information as $item)
              კატეგორია: {{ $item['category']['name_ka'] }} <br>
              სამუშაო გრაფიკი: {{ $item['get_work_schedule'][0]['work_schedule']['name_ka'] }} <br>
              ანაზღაურება: {{ $item['payment'] }} <br>
              ვალიუტა: {{ $item['currency']['name_ka']}}      
            @endforeach

          </td>
        </tr>
        <td>ოჯახში მუშაობის გამოცდილება</td>
        @if ($family_work_experience && $family_work_experience['experience'] == 1)
          <td class="rightText">
              მიმუშავია {{ $family_work_experience['families_worked_count'] }} ოჯახში <br>
              სტაჟი (ჯამში): {{ $family_work_experience['work_experience']['name_ka'] }} <br>
              ყველაზე ხანგრძლივად: {{ $family_work_experience['longest']['name_ka'] }} <br>

              მეევალებოდა: {{ implode(', ', array_column($family_work_experience['family_work_duty'], 'name_ka')) }}
          </td>
        @else
          <td>
              არ აქვს
          </td>
        @endif

      </tr>
        <tr>
          <td>რეკომენდაცია</td>
          <td class="rightText">
            @foreach ($recommendation as $item)
                რეკომენდაცია: {{ $item['name_ka'] }} <br>
                რეკომენდატორი: {{ $item['pivot']['name_ka'] }} <br>
                                {{ $item['pivot']['number'] }} <br>
                                {{-- {{ $item['pivot']['file_path'] }} --}}
            @endforeach
          </td>
        </tr>
    </table>

    <hr>

    <div class="footer margin-top">
        <div>პატივისცემით &copy; hrbaia.ge <a class="interested" href="https://hrbaia.ge/ka">დავინტერესდი</a></div>
    </div> 


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
