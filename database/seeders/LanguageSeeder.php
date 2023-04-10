<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->delete();
        $language = array(
            array("name_ru"=>"грузинский","name_ka"=>"ქართული","name_en"=>"Georgian"),
            array("name_ru"=>"русский","name_ka"=>"რუსული","name_en"=>"Russian"),
            array("name_ru"=>"английский","name_ka"=>"ინგლისური","name_en"=>"English"),
            array("name_ru"=>"французский","name_ka"=>"ფრანგული","name_en"=>"French"),
            array("name_ru"=>"немецкий","name_ka"=>"გერმანული","name_en"=>"German"),
            array("name_ru"=>"итальянский","name_ka"=>"იტალიური","name_en"=>"Italian"),
            array("name_ru"=>"турецкий","name_ka"=>"თურქული","name_en"=>"Turkish"),
            array("name_ru"=>"греческий","name_ka"=>"ბერძნული","name_en"=>"Greek"),
            array("name_ru"=>"армянский","name_ka"=>"სომხური","name_en"=>"Armenian"),
            array("name_ru"=>"азербайджанский","name_ka"=>"აზერბაიჯანული","name_en"=>"Azerbaijani"),
            array("name_ru"=>"аймара","name_ka"=>"აიმარული","name_en"=>"Aymara"),
            array("name_ru"=>"албанский","name_ka"=>"ალბანური","name_en"=>"Albanian"),
            array("name_ru"=>"амхарский","name_ka"=>"ამჰარული","name_en"=>"Amharic"),
            array("name_ru"=>"арабский","name_ka"=>"არაბული","name_en"=>"Arab"),
            array("name_ru"=>"африкаанс","name_ka"=>"აფრიკანული","name_en"=>"Afrikaans"),
            array("name_ru"=>"белорусский","name_ka"=>"ბელორუსული","name_en"=>"Belorussian"),
            array("name_ru"=>"бенгальский","name_ka"=>"ბენგალური","name_en"=>"Bengal"),
            array("name_ru"=>"бирманский","name_ka"=>"ბირმანული","name_en"=>"Burmese"),
            array("name_ru"=>"бислама","name_ka"=>"ბისლამური","name_en"=>"Bislama"),
            array("name_ru"=>"болгарский","name_ka"=>"ბულგარული","name_en"=>"Bulgarian"),
            array("name_ru"=>"боснийский","name_ka"=>"ბოსნიური","name_en"=>"Bosnian"),
            array("name_ru"=>"венгерский","name_ka"=>"უნგრული","name_en"=>"Hungarian"),
            array("name_ru"=>"вьетнамский","name_ka"=>"ვიეტნამური","name_en"=>"Vietnamese"),
            array("name_ru"=>"гуарани","name_ka"=>"გუარანული","name_en"=>"guarani"),
            array("name_ru"=>"дари","name_ka"=>"დარიული","name_en"=>"give"),
            array("name_ru"=>"датский","name_ka"=>"დანიური","name_en"=>"Danish"),
            array("name_ru"=>"иврит","name_ka"=>"ებრაული","name_en"=>"Hebrew"),
            array("name_ru"=>"индонезийский","name_ka"=>"ინდონეზიური","name_en"=>"Indonesian"),
            array("name_ru"=>"ирландский","name_ka"=>"ირლანდიური","name_en"=>"Irish"),
            array("name_ru"=>"исландский","name_ka"=>"ისლანდიური","name_en"=>"Icelandic"),
            array("name_ru"=>"испанский","name_ka"=>"ესპანური","name_en"=>"Spanish"),
            array("name_ru"=>"казахский","name_ka"=>"ყაზახური","name_en"=>"Kazakh"),
            array("name_ru"=>"каталанский","name_ka"=>"კატალონიური","name_en"=>"Catalan"),
            array("name_ru"=>"кечуа","name_ka"=>"კეჩუა","name_en"=>"Quechua"),
            array("name_ru"=>"киргизский","name_ka"=>"ყირგიზული","name_en"=>"Kyrgyz"),
            array("name_ru"=>"кирунди","name_ka"=>"კირუნდული","name_en"=>"kirundi"),
            array("name_ru"=>"китайский","name_ka"=>"ჩინური","name_en"=>"Chinese"),
            array("name_ru"=>"корейский","name_ka"=>"კორეული","name_en"=>"Korean"),
            array("name_ru"=>"креольский","name_ka"=>"კრეოლური","name_en"=>"Creole"),
            array("name_ru"=>"курдский","name_ka"=>"ქურთული","name_en"=>"Kurdish"),
            array("name_ru"=>"кхмерский","name_ka"=>"ქმერული","name_en"=>"Khmer"),
            array("name_ru"=>"лаосский","name_ka"=>"ლაოსური","name_en"=>"Laotian"),
            array("name_ru"=>"латинский","name_ka"=>"ლათინური","name_en"=>"Latin"),
            array("name_ru"=>"латышский","name_ka"=>"ლატვიური","name_en"=>"Latvian"),
            array("name_ru"=>"литовский","name_ka"=>"ლიტვური","name_en"=>"Lithuanian"),
            array("name_ru"=>"люксембургский диалект","name_ka"=>"ლუქსემბურგული დიალექტი","name_en"=>"Luxembourgish"),
            array("name_ru"=>"македонский","name_ka"=>"მაკედონიური","name_en"=>"Macedonian"),
            array("name_ru"=>"малагасийский","name_ka"=>"მალაგური","name_en"=>"Malagasy"),
            array("name_ru"=>"малазийский","name_ka"=>"მალაიზიური","name_en"=>"Malaysian"),
            array("name_ru"=>"малайский","name_ka"=>"მალაიზიური","name_en"=>"Malay"),
            array("name_ru"=>"мальдивский (дивехи),","name_ka"=>"მალდივური","name_en"=>"Maldivian (Dhivehi),"),
            array("name_ru"=>"мальтийский","name_ka"=>"მალტური","name_en"=>"Maltese"),
            array("name_ru"=>"молдавский","name_ka"=>"მოლდავური","name_en"=>"Moldavian"),
            array("name_ru"=>"монгольский","name_ka"=>"მონღოლური","name_en"=>"Mongolian"),
            array("name_ru"=>"науруанский","name_ka"=>"ნაურუანსკი","name_en"=>"nauruan"),
            array("name_ru"=>"непали","name_ka"=>"ნეპალური","name_en"=>"nepali"),
            array("name_ru"=>"нидерландский","name_ka"=>"ნიდერლანდური","name_en"=>"Dutch"),
            array("name_ru"=>"норвежский","name_ka"=>"ნორვეგიული","name_en"=>"Norwegian"),
            array("name_ru"=>"персидский","name_ka"=>"სპარსული","name_en"=>"Persian"),
            array("name_ru"=>"польский","name_ka"=>"პოლონური","name_en"=>"Polish"),
            array("name_ru"=>"португальский","name_ka"=>"პორტუგალიური","name_en"=>"Portuguese"),
            array("name_ru"=>"ретороманский","name_ka"=>"რეტორომანული","name_en"=>"Romansh"),
            array("name_ru"=>"румынский","name_ka"=>"რუმინული","name_en"=>"Romanian"),
            array("name_ru"=>"самоанский","name_ka"=>"სამოანური","name_en"=>"samoan"),
            array("name_ru"=>"свази","name_ka"=>"სვაზური","name_en"=>"swazi"),
            array("name_ru"=>"сербский","name_ka"=>"სერბული","name_en"=>"Serbian"),
            array("name_ru"=>"сесото","name_ka"=>"სესოტური","name_en"=>"sesotho"),
            array("name_ru"=>"сингальский","name_ka"=>"სინჰალური","name_en"=>"Sinhalese"),
            array("name_ru"=>"словацкий","name_ka"=>"სლოვაკური","name_en"=>"Slovak"),
            array("name_ru"=>"словенский","name_ka"=>"სლოვენური","name_en"=>"Slovenian"),
            array("name_ru"=>"сомалийский","name_ka"=>"სომალიური","name_en"=>"Somali"),
            array("name_ru"=>"суахили","name_ka"=>"სუაჰილი","name_en"=>"Swahili"),
            array("name_ru"=>"тагальский","name_ka"=>"ტაგალური","name_en"=>"Tagalog"),
            array("name_ru"=>"таджикский","name_ka"=>"ტაჯიკური","name_en"=>"Tajik"),
            array("name_ru"=>"тайский","name_ka"=>"ტაილანდური","name_en"=>"Thai"),
            array("name_ru"=>"тамильский","name_ka"=>"ტამილური","name_en"=>"Tamil"),
            array("name_ru"=>"тетун","name_ka"=>"ტეტუნური","name_en"=>"tetun"),
            array("name_ru"=>"тонганский","name_ka"=>"ტონგანური","name_en"=>"Tongan"),
            array("name_ru"=>"туркменский","name_ka"=>"თურქმენული","name_en"=>"Turkmen"),
            array("name_ru"=>"узбекский","name_ka"=>"უზბეკური","name_en"=>"Uzbek"),
            array("name_ru"=>"украинский","name_ka"=>"უკრაინული","name_en"=>"Ukrainian"),
            array("name_ru"=>"урду","name_ka"=>"ურდუული","name_en"=>"urdu"),
            array("name_ru"=>"финский","name_ka"=>"ფინური","name_en"=>"Finnish"),
            array("name_ru"=>"хинди","name_ka"=>"ჰინდური","name_en"=>"Hindi"),
            array("name_ru"=>"хорватский","name_ka"=>"ხორვატული","name_en"=>"Croatian"),
            array("name_ru"=>"чешский","name_ka"=>"ჩეხური","name_en"=>"Czech"),
            array("name_ru"=>"шведский","name_ka"=>"შვედური","name_en"=>"Swedish"),
            array("name_ru"=>"эстонский","name_ka"=>"ესტონური","name_en"=>"Estonian"),
            array("name_ru"=>"японский","name_ka"=>"იაპონური","name_en"=>"Japanese"),
        );

        DB::table('languages')->insert($language);
    }
}
