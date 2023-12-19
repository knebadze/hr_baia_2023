<!DOCTYPE html>
<html>
<head>
    <title>კანდიდატის სრული მონაცემები</title>
</head>
<body>

    <table class="w-full">
        <tr>
            <td class="w-half">
                <h1 style="text-align: center;">კანდიდატის სრული CV</h1>
            </td>
        </tr>
    </table>

    <hr>
 
    <div class="margin-top">
        <table class="products">

            <tr>
                <th>სახელი:</th>
                <th>ქვეყანა:</th>
                <th>მოქალაქეობა:</th>
            </tr>
            <tr class="items">
                <td class="bigText">
                    {{ $user['name_ka'] }}
                </td>
                <td class="bigText">
                    {{ $user['nationality_ka'] }}
                </td>
                <td class="bigText">
                    {{ $user['name_ru'] }}
                </td>
            </tr>
            <tr>
                <th>ქალაქი:</th>
                <th>ეროვნება:</th>
                <th>სქესი:</th>
            </tr>
            <tr class="items">
                <td class="bigText">
                    {{ $user['name_ka'] }}
                </td>
                <td class="bigText">
                    {{ $user['name_en'] }}
                </td>
                <td class="bigText">
                    {{ $user['name_ru'] }}
                </td>
            </tr>

            <tr>
                <th>რელიგია:</th>
                <th>გამათლება:</th>
                <th>პროფესია:</th>
            </tr>
            <tr class="items">
                <td class="bigText">
                    {{ $user['name_ka'] }}
                </td>
                <td class="bigText">
                    {{ $user['name_en'] }}
                </td>
                <td class="bigText">
                    {{ $user['name_ru'] }}
                </td>
            </tr>

            <tr>
                <th>სპეციალობა:</th>
                <th>ზოგადი მახასიათებლები:</th>
                <th>ოჯახური მდგომარეობა:</th>
            </tr>
            <tr class="items">
                <td class="bigText">
                    {{ $user['name_ka'] }}
                </td>
                <td class="bigText">
                    {{ $user['name_en'] }}
                </td>
                <td class="bigText">
                    {{ $user['name_ru'] }}
                </td>
            </tr>

            <tr>
                <th>მართვის მოწმობა:</th>
                <th>ალერგია:</th>
                <th>ოპერაცია ან ქრონიკული დაავადება:</th>
            </tr>
            <tr class="items">
                <td class="bigText">
                    {{ $user['name_ka'] }}
                </td>
                <td class="bigText">
                    {{ $user['name_en'] }}
                </td>
                <td class="bigText">
                    {{ $user['name_ru'] }}
                </td>
            </tr>

            <tr>
                <th>დასახლების დასახელება (უბანი):</th>
                <th>უცხო ენა:</th>
                <th>სამუშაო გამოცდილება:</th>
            </tr>
            <tr class="items">
                <td class="bigText">
                    {{ $user['name_ka'] }}
                </td>
                <td class="bigText">
                    {{ $user['name_en'] }}
                </td>
                <td class="bigText">
                    {{ $user['name_ru'] }}
                </td>
            </tr>

            <tr>
                <th>კატეგორია და გრაფიკი:</th>
                <th>ოჯახში მუშაობის გამოცდილება:</th>
                <th>რეკომენდაცია:</th>
            </tr>
            <tr class="items">
                <td class="bigText">
                    {{ $user['name_ka'] }}
                </td>
                <td class="bigText">
                    {{ $user['name_en'] }}
                </td>
                <td class="bigText">
                    {{ $user['name_ru'] }}
                </td>
            </tr>

        </table>
    </div>
 
    <hr>

    <div class="footer margin-top">
        <div>პატივისცემით</div>
        <div>&copy; hrbaia.ge</div>
    </div>

{{-- ---------------- --}}



{{-- CSS --}}
<style>
    body { font-family: DejaVu Sans, sans-serif; }

    .name {
        text-align: center;
    }
    h4 {
    margin: 0;
}

.bigText {
    text-align: center;
}
.w-full {
    width: 100%;
}

.w-half {
    width: 50%;
}
.margin-top {
    margin-top: 1.25rem;
}
.footer {
    font-size: 0.875rem;
    padding: 1rem;
    background-color: rgb(241 245 249);
}
table {
    width: 100%;
    border-spacing: 0;
}
table.products {
    font-size: 0.875rem;
}
table.products tr {
    background-color: rgb(96 165 250);
}
table.products th {
    color: #ffffff;
    padding: 0.5rem;
}
table tr.items {
    background-color: rgb(241 245 249);
}
table tr.items td {
    padding: 0.5rem;
}
.total {
    text-align: right;
    margin-top: 1rem;
    font-size: 0.875rem;
}
</style>


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
