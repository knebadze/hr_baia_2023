<!DOCTYPE html>
<html>
<head>
    <title>123</title>
</head>
<body>
<style>
    body { font-family: DejaVu Sans, sans-serif; }

    .name {
        text-align: center;
    }
</style>

                <h1 style="text-align: center;">კანდიდატის სრული CV</h1>
                <hr>

                <table>

                    <thead>
                        <tr>
                            <th><h3>სახელი</h3></th>
                            <th><h3>Name</h3></th>
                            <th><h3>имя</h3></th>
                        </tr>
                    </thead>

                    <tbody class="name">
                        <tr>
                            <td>{{ $user['name_ka'] }}</td>
                            <td>{{ $user['name_en'] }}</td>
                            <td>{{ $user['name_ru'] }}</td>
                        </tr>
  
                    </tbody>
                </table>

                <p>Birth Date</p>

                <p>Sex</p>

                <p>Nationality</p>

                <p>Cityzenship</p>

                <p>Education</p>

                <p>Profession</p>

                <p>Specialty</p>

                <p>General characteristics</p>

                <p>Marital status</p>

                <p>Driving license</p>

                <p>აAllergy</p>

            <div class="col-md-6">
                <p>Surgery or chronic illness</p>
            </div>

            <div class="col-md-6">
                <p>City</p>
            </div>

            <div class="col-md-6">
                <p>District</p>
            </div>

            <div class="col-md-6">
                <p>Foreign languages</p>
            </div>

            <div class="col-md-6">
                <p>General work experience</p>
                <p>work experience</p>
                <p>Seniority</p> {{-- სტაჟი --}}
                <p>Position</p>
            </div>

            <div class="col-md-6">
                <p>Family work experience</p>
                <p>How many families have you worked with?</p>
                <p>Seniority</p> {{-- სტაჟი --}}
                <p>for the longest time</p>
            </div>

            <div class="col-md-6">
                <p>Recommendation</p>
            </div>




</body>
</html>

{{-- 
როგორც კანდიდატის ასევე ᲨემკვეᲗის: 
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
