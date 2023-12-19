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
            <td class="rightText">123</td>
          </tr>
          <tr>
            <td>ეროვნება:</td>
            <td class="rightText">123</td>
          </tr>
          <tr>
            <td>სქესი:</td>
            <td class="rightText">123</td>
          </tr>        
    </table>
 
    <hr>

    <div class="footer margin-top">
        <div>პატივისცემით &copy; hrbaia.ge</div>
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
