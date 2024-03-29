<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReasonForCancelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reason_for_cancels')->delete();
        $data = array(
            array("name_ka"=>"სააგენტოდან აშკარად შეუსაბამო კადრების გაგზავნა","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"სააგენტოდან აშკარად შეუსაბამო კადრების ფოტოანკეტების გადაგზავნა","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"მიუხედავად შესაბამისი კადრებთან გასაუბრებისა, უბრალოდ მაინც შეიკავა თავი სააგენტოდან გამოგზავნილი კადრის აყვანაზე","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"სააგენტოდან გამოგზავნილი კადრები შემკვეთს ევაჭრებოდნენ ანაზღაურებაზე","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"შემკვეთის გადმოცემით სააგენტოდან გამოგზავნილი კადრები სცდილობდნენ სააგენტოს 'გადაგდებას'","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"შემკვეთთან სააგენტოდან საერთოდ არავინ არ გაუგზავნიათ","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"ოჯახის წევრმა/ახლობელმა შესთავაზა კადრი, რომელიც ამასობაში გატესტა კიდეც და მას იტოვებს","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"მიუხედავად შეთანხმებისა, შემკვეთი არ/ვერ იხდის დაპირებულ ანაზღაურებას სათანადო ფინანსური მდგომარეობის არ ქონის გამო","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"მიუხედავად შეთანხმებისა, შემკვეთი არ/ვერ იხდის სააგენტოს მომსახურეობის საკომისიოს","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"მიუხედავად არაერთი კანდიდატის გაგზავნისა შემკვეთი პირდება, მაგრამ არცერთს არ უკავშირდება","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"მიუხედავად არაერთი კანდიდატის ფოტოანკეტის გადაგზავნისა შემკვეთი არცერთი მათგანით არ ინტერესდება","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"შეკვეთის დატოვებიდან ზუსტად 1 თვეა რაც შემკვეთი არ პასუხობს ჩვენს არც სატელეფონო ზარებსა და არც SMS შეტყობინებებს, არ გამოდის კონტაქტზე","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"ჩვენგან შეთანხმებული კადრი არ მივიდა და ამასობაში თავისი მოძიებული აიყვანა","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"პაციენტი გარდაიცვალა","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"შემკვეთმა დაკარგა ის ფინანსური წყარო, რითიაც უნდა აეყვანა პერსონალი და აქედან გამომდინარე უარი განაცხადა პერსონალის აყვანაზე","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"შეცდომით განმეორდა, შემკვეთმა არ მომიმართავს განმეორებით აყვანის თაობაზეო","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"შემკვეთმა საკმაოდ წყრომით განაცხადა, რომ არ ესაჭიროება კადრი","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"შემკვეთის განცხადებით მან 1 თვის განმავლობაში უკვე 3-ჯერ განაცხადა უარი პერსონალის აყვანაზე, ხოლო არ აყვანის მიზეზს კი არ ასახელებს","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"ხელმძღვანელთან შეთანხმებით, გრაფიკთან ანაზღაურების აშკარა შეუსაბამობის გამო","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"შემკვეთმა ამასობაში სხვა სააგენტოდან აიყვანა კადრი","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"გადაიფიქრა კადრის აყვანა იმ მიზეზის გამო, რომ ოჯახის წევრი/ნათესავი/ახლობელი მიაქცევს ყურადღებას","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"ძველი კადრის დატოვება ამჯობინა","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"ამასობაში ძველი კადრი დაუბრუნდა","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"მოსავლელი სუბიექტი ვერ ეგუება ვერცერთ კადრს","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"მოსავლელი სუბიექტი კატეგორიულად უარს აცხადებს მომვლელის აყვანაზე","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"ბავშვი ვერ ეგუება უცხო ადამიანს","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"შემკვეთს გააჩნია იმდენად განსაკუთრებული მოთხოვნები, რომ მიუხედავად მისთვის არაერთი კადრის დაკავშირებისა არ მოსწონს არავინ, არადა მასთან გაგზავნილი კადრები ჩვენს მიერ სხვაგან უკვე თითქმის ყველა დასაქმდა","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"ხელმძღვანელთან შეთანხმებით","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"შემკვეთს სააგენტოს და მისი კადრების მიმართ გააჩნია უსაფუძვლო პრეტენზიები","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"ამჯობინეს პაციენტის თავშესაფარში გადაყვანა","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"ამჯობინეს ბავშვის ბაღში შეყვანა","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"შემკვეთმა არც კანდიდატს და არც სააგენტოს არ გადაუხადა მომსახურეობის საფასური","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"HR-ის მხრიდან ვერ მოხერხდა ვადებში სათანადო კადრის მოძიება","name_ru"=>"null","name_en"=>"null"),
            array("name_ka"=>"HR-ის მხრიდან არ განხორციელდა ვაკანსიაზე სტატუსის დროულად შეცვლა","name_ru"=>"null","name_en"=>"null"),
        );
        DB::table('reason_for_cancels')->insert($data);
    }
}
