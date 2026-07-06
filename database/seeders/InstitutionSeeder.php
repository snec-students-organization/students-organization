<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Institution;

class InstitutionSeeder extends Seeder
{
    public function run()
    {
        // sharea colleges (14)
        Institution::updateOrCreate(
            ['email' => 'shamsululamasnecalp@gmail.com'],
            [
                'name' => 'SHAMSUL ULAMA ISLAMIC & ARTS COLLEGE, PATHIYANKARA',
                'password' => bcrypt('shamsululamasnecalp4621'),
                'membership_number' => 'SSOSNEC390',
                'stream' => 'sharia'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'akmmsnec@gmail.com'],
            [
                'name' => 'AHMED KUTTY MUSLIYAR MEMORIAL COLLEGE OF ISLAMIC AND ARTS, KAINIKKARA',
                'password' => bcrypt('akmmsnec4651'),
                'membership_number' => 'SSOSNEC352',
                'stream' => 'sharia'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'gvicforboys@gmail.com'],
            [
                'name' => 'GRACE VALLEY ISLAMIC COLLEGE FOR BOYS, MARAVATTOM',
                'password' => bcrypt('gvicforboys4658'),
                'membership_number' => 'SSOSNEC346',
                'stream' => 'sharia'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'liwaulhudasnec@gmail.com'],
            [
                'name' => 'LIWA – UL HUDA ISLAMIC COMPLEX, KEEZHUPARAMBA',
                'password' => bcrypt('liwaulhudasnec4562'),
                'membership_number' => 'SSOSNEC852',
                'stream' => 'sharia'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'miacsnec@gmail.com'],
            [
                'name' => 'KHASI MUHAMMED MUSLIYAR EDUCATIONAL & CULTURAL COMPLEX, MARAYAMANGALAM',
                'password' => bcrypt('miacsnec4521'),
                'membership_number' => 'SSOSNEC486',
                'stream' => 'sharia'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'shamsululama@gmail.com'],
            [
                'name' => 'SHAMSUL ULAMA ISLAMIC ACADEMY, VENGAPPALLY',
                'password' => bcrypt('shamsululama8465'),
                'membership_number' => 'SSOSNEC954',
                'stream' => 'sharia'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'kickumbra@gmail.com'],
            [
                'name' => 'KARNATAKA ISLAMIC ACADEMY',
                'password' => bcrypt('kickumbra4621'),
                'membership_number' => 'SSOSNEC483',
                'stream' => 'sharia'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'diacademy31@gmail.com'],
            [
                'name' => 'DARUL IHSAN, CHUNGATHARA, NILAMBUR',
                'password' => bcrypt('diacademy3146'),
                'membership_number' => 'SSOSNEC002',
                'stream' => 'sharia'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'Imamshafieducationalboard316@gmail.com'],
            [
                'name' => 'IMAM SHAFI ISLAMIC ACADEMY, KUMBALA',
                'password' => bcrypt('Imamshafieducationalboard3163'),
                'membership_number' => 'SSOSNEC960',
                'stream' => 'sharia'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'daruswalah99@gmail.com'],
            [
                'name' => 'DARUSWALAH ISLAMIC ACADEMY, Karamoola',
                'password' => bcrypt('daruswalah9982'),
                'membership_number' => 'SSOSNEC050',
                'stream' => 'sharia'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'darulbirracademy@gmail.com'],
            [
                'name' => 'DARUL BIRR ISLAMIC ACADEMY, Payyannur',
                'password' => bcrypt('darulbirracademy4397'),
                'membership_number' => 'SSOSNEC404',
                'stream' => 'sharia'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'thanveeriac@gmail.com'],
            [
                'name' => 'THANVEER ISLAMIC AND ARTS COLLEGE, Kumminiparambu',
                'password' => bcrypt('thanveeriac3648'),
                'membership_number' => 'SSOSNEC840',
                'stream' => 'sharia'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'snecmuthawwalcampus@gmail.com'],
            [
                'name' => 'SNEC VARAKKAL MUTHAWWAL CAMPUS',
                'password' => bcrypt('snecmuthawwalcampus4639'),
                'membership_number' => 'SSOSNEC813',
                'stream' => 'sharia'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'nattukalmakhamcollege@gmail.com'],
            [
                'name' => 'NATTUKAL MAKHAM ISLAMIC & ARTS COLLEGE',
                'password' => bcrypt('nattukalmakhamcollege33'),
                'membership_number' => 'SSOSNEC865',
                'stream' => 'sharia'
            ]
        );

        // sharea plus colleges (15)
        Institution::updateOrCreate(
            ['email' => 'micforboys@gmail.com'],
            [
                'name' => 'MARKAZ ISLAMIC & ARTS COLLEGE, KALAMASSERY',
                'password' => bcrypt('micforboys4697'),
                'membership_number' => 'SSOSNEC963',
                'stream' => 'sharia plus'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'nhocheruthuruthy@gmail.com'],
            [
                'name' => 'NOORUL HUDA EDUCATION CENTER, CHERUTHURUTHY',
                'password' => bcrypt('nhocheruthuruthy4121'),
                'membership_number' => 'SSOSNEC802',
                'stream' => 'sharia plus'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'Imamshafieducationalboard3161@gmail.com'],
            [
                'name' => 'IMAM SHAFI ISLAMIC ACADEMY, Badriya Nagar, Kumbala, Kasaragod',
                'password' => bcrypt('Imamshafieducationalboard3145'),
                'membership_number' => 'SSOSNEC741',
                'stream' => 'sharia plus'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'pmicsnec@gmail.com'],
            [
                'name' => "ANWARUL HUDA SHARI'A COLLEGE, Vadakkangara, Mankada",
                'password' => bcrypt('pmicsnec4632'),
                'membership_number' => 'SSOSNEC147',
                'stream' => 'sharia plus'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'Cumvadihuda@gmail.com'],
            [
                'name' => 'VADI HUDA SHAREEATH COLLEGE, Omassery, Kozhikode',
                'password' => bcrypt('Cumvadihuda4892'),
                'membership_number' => 'SSOSNEC258',
                'stream' => 'sharia plus'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'cbmsislamicacademy@gmail.com'],
            [
                'name' => 'CBMS ISLAMIC ACADEMY, Vilayil Parappoor, Malappuram',
                'password' => bcrypt('cbmsislamicacademy0345'),
                'membership_number' => 'SSOSNEC369',
                'stream' => 'sharia plus'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'sda2k24@gmail.com'],
            [
                'name' => 'SHAMSUL ULAMA DARUSSALAM ACADEMY, WADITHWAIBA, Mangaluru',
                'password' => bcrypt('sda2k2402'),
                'membership_number' => 'SSOSNEC064',
                'stream' => 'sharia plus'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'bavaliacademy@gmail.com'],
            [
                'name' => 'SAYYID BAVA ALI ISLAMIC AND ARTS COLLEGE, Bavali, Wayanad',
                'password' => bcrypt('bavaliacademy0066'),
                'membership_number' => 'SSOSNEC030',
                'stream' => 'sharia plus'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'micaudcollege@gmail.com'],
            [
                'name' => "MIC ARSHADUL ULOOM DA'WA COLLEGE, Mahinabad, Chattanchal",
                'password' => bcrypt('micaudcollege4623'),
                'membership_number' => 'SSOSNEC904',
                'stream' => 'sharia plus'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'shamsululamasnec2025@gmail.com'],
            [
                'name' => 'SHAMSUL ULAMA ACADEMY, KUTHUPARAMB, KANNUR',
                'password' => bcrypt('shamsululamasnec2085'),
                'membership_number' => 'SSOSNEC664',
                'stream' => 'sharia plus'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'nic.snec@gmail.com'],
            [
                'name' => "NUSRATHUL ISLAM SHAEE'A COLLEGE, KUTTILAKADVU",
                'password' => bcrypt('nicsnec0869'),
                'membership_number' => 'SSOSNEC403',
                'stream' => 'sharia plus'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'darurahmakuzhalmannam@gmail.com'],
            [
                'name' => 'DARUL RAHMA COLLEGE, KUZHALMANNAM, PALAKKAD',
                'password' => bcrypt('darurahmakuzhalmannam8962'),
                'membership_number' => 'SSOSNEC930',
                'stream' => 'sharia plus'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'Jalaliyyaislamiccomplex@gmail.com'],
            [
                'name' => 'CHEMBULANGAD USTHAD JALALIYYA ISLAMIC COMPLEX, WEST KODUMUNDA',
                'password' => bcrypt('Jalaliyyaislamiccomplex652'),
                'membership_number' => 'SSOSNEC933',
                'stream' => 'sharia plus'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'gazalitrustimam@gmail.com'],
            [
                'name' => 'IMAM GAZZALI EDUCATION CENTRE, ARANTHODE',
                'password' => bcrypt('gazalitrustimam652'),
                'membership_number' => 'SSOSNEC023',
                'stream' => 'sharia plus'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'darulhasaniya89@gmail.com'],
            [
                'name' => 'DARUL HASANIYA ACADEMY, SALMARA, PUTTUR, CHIKAMUNDOOR, KARNATAKA',
                'password' => bcrypt('darulhasaniya89'),
                'membership_number' => 'SSOSNEC919',
                'stream' => 'sharia plus'
            ]
        );

        // she colleges (14)
        Institution::updateOrCreate(
            ['email' => 'snecmannar@gmail.com'],
            [
                'name' => 'NAFEESATHUL MISRIYYA ISLAMIC AND ARTS COLLEGE , MANNAR',
                'password' => bcrypt('snecmannar6956'),
                'membership_number' => 'SSOSNEC101',
                'stream' => 'she'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'shehidaya@gmail.com'],
            [
                'name' => 'DARUL HIDAYA WOMENS ACADEMY, EDAPPAL, MALAPPURAM',
                'password' => bcrypt('shehidaya6456'),
                'membership_number' => 'SSOSNEC102',
                'stream' => 'she'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'gvicforgirls@gmail.com'],
            [
                'name' => 'GRACE VALLEY ISLAMIC COLLEGE FOR GIRLS, MARAVATTOM',
                'password' => bcrypt('gvicforgirls1239'),
                'membership_number' => 'SSOSNEC105',
                'stream' => 'she'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'shecampusimamshafi@gmail.com'],
            [
                'name' => 'IMAM SHAFI SHE CAMPUS, KUMBALA',
                'password' => bcrypt('shecampusimamshafi4562'),
                'membership_number' => 'SSOSNEC106',
                'stream' => 'she'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'niorphanage1968@gmail.com'],
            [
                'name' => 'NOORUL ISLAM WOMENS COLLEGE, ALAMBADY',
                'password' => bcrypt('niorphanage1903'),
                'membership_number' => 'SSOSNEC109',
                'stream' => 'she'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'vadinoorcollege@gmail.com'],
            [
                'name' => 'VADI NOOR ISLAMIC AND ARTS COLLEGE FOR GIRLS , VANIMEL',
                'password' => bcrypt('vadinoorcollege6496'),
                'membership_number' => 'SSOSNEC201',
                'stream' => 'she'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'khidmathwomenscollege@gmail.com'],
            [
                'name' => 'KHIDMATHUL ISLAM WOMENS COLLEGE, EDAKKULAM',
                'password' => bcrypt('khidmathwomenscollege3694'),
                'membership_number' => 'SSOSNEC203',
                'stream' => 'she'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'mickaipamangalam@gmail.com'],
            [
                'name' => "MIC WOMEN'S COLLEGE, KAIPPAMANGALM",
                'password' => bcrypt('mickaipamangalam4368'),
                'membership_number' => 'SSOSNEC208',
                'stream' => 'she'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'kmmwomenscollegekmm@gmail.com'],
            [
                'name' => 'KOYYOD MUHIYIDHEENKUTTY MUSLIYAR MEMORIAL WOMENS ACADEMY, VENGAD',
                'password' => bcrypt('kmmwomenscollegekmm0973'),
                'membership_number' => 'SSOSNEC280',
                'stream' => 'she'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'ummulqurasnec@gmail.com'],
            [
                'name' => 'UMMUL QURA ISLAMIC AND ARTS COLLEGE FOR WOMEN, KALOOR',
                'password' => bcrypt('ummulqurasnec0589'),
                'membership_number' => 'SSOSNEC100',
                'stream' => 'she'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'kbbvellarakkad@gmail.com'],
            [
                'name' => 'KHADIJA BINTH BUKHARI (KBB), VELLARKKAD',
                'password' => bcrypt('kbbvellarakkad1463'),
                'membership_number' => 'SSOSNEC999',
                'stream' => 'she'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'crescentshecampus@gmail.com'],
            [
                'name' => 'CRESCENT SNEC SHE CAMPUS, VELIMUKK',
                'password' => bcrypt('crescentshecampus7891'),
                'membership_number' => 'SSOSNEC666',
                'stream' => 'she'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'ajumshecampus@gmail.com'],
            [
                'name' => 'AJUM SHE CAMPUS (DAY COLLEGE)',
                'password' => bcrypt('ajumshecampus6874'),
                'membership_number' => 'SSOSNEC333',
                'stream' => 'she'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'jaliyyachelari@gmail.com'],
            [
                'name' => 'JALIYYA GIRLS CAMPUS, CHELARI',
                'password' => bcrypt('jaliyyachelari3647'),
                'membership_number' => 'SSOSNEC444',
                'stream' => 'she'
            ]
        );

        // she plus colleges (7)
        Institution::updateOrCreate(
            ['email' => 'micforgirls@gmail.com'],
            [
                'name' => 'MARKAZ ISLAMIC & ARTS VANITHA COLLEGE, CHANGAPUZHA, ERNAKULAM',
                'password' => bcrypt('micforgirls4731'),
                'membership_number' => 'SSOSNEC555',
                'stream' => 'she plus'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'nafeesatulmisriyyawomens@gmail.com'],
            [
                'name' => 'NAFEESATHUL MISRIYA MOOTHEDAM, EDAKKARA',
                'password' => bcrypt('nafeesatulmisriyyawomens4600'),
                'membership_number' => 'SSOSNEC660',
                'stream' => 'she plus'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'sneckuttikkattoor@gmail.com'],
            [
                'name' => "SHAMSUL ULAMA WOMEN'S ACADEMY KUTTIKKATTOOR",
                'password' => bcrypt('sneckuttikkattoor5412'),
                'membership_number' => 'SSOSNEC770',
                'stream' => 'she plus'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'alameengirlsorphanage@gmail.com'],
            [
                'name' => 'AL AMEEN WOMENS COLLEGE ,KOTTAYI, PALAKKAD',
                'password' => bcrypt('alameengirlsorphanage6941'),
                'membership_number' => 'SSOSNEC466',
                'stream' => 'she plus'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'iqrathrikaripur@gmail.com'],
            [
                'name' => "IQRA'A ISLAMIC COLLEGE FOR GIRLS, MANIYANODY, TRIKARIPUR, KASARAGOD",
                'password' => bcrypt('iqrathrikaripur9431'),
                'membership_number' => 'SSOSNEC488',
                'stream' => 'she plus'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'micsnecsheplus@gmail.com'],
            [
                'name' => 'MIC WOMENS ACADEMY KOTTOPADAM, MANNARKKAD, PALAKKAD',
                'password' => bcrypt('micsnecsheplus9542'),
                'membership_number' => 'SSOSNEC422',
                'stream' => 'she plus'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'najathkvk@gmail.com'],
            [
                'name' => 'SYED HYDER ALI SHIHAB THANGAL COLLEGE OF ARTS & ISLAMIC STUDIES (GIRLS)',
                'password' => bcrypt('najathkvk89'),
                'membership_number' => 'SSOSNEC412',
                'stream' => 'she plus'
            ]
        );

        // life colleges (2)
        Institution::updateOrCreate(
            ['email' => 'thoobacampus@gmail.com'],
            [
                'name' => 'THOOBA RESIDENTIAL CAMPUS , Madavoor, KOZHIKODE',
                'password' => bcrypt('thoobacampus4623'),
                'membership_number' => 'SSOSNEC433',
                'stream' => 'life'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'gpasnec@gmail.com'],
            [
                'name' => 'GRACE VALLEY LIFE INSTITUTE Maravattom, MALAPPURAM',
                'password' => bcrypt('gpasnec6852'),
                'membership_number' => 'SSOSNEC499',
                'stream' => 'life'
            ]
        );

        // life plus colleges (2)
        Institution::updateOrCreate(
            ['email' => 'daruthaqwasnecalr@gmail.com'],
            [
                'name' => 'DARU THAQWA ISLAMIC ACADEMY, ALANALLUR, PALAKKAD',
                'password' => bcrypt('daruthaqwa3695'),
                'membership_number' => 'SSOSNEC467',
                'stream' => 'life plus'
            ]
        );

        Institution::updateOrCreate(
            ['email' => 'rashadiyya3@gmail.com'],
            [
                'name' => 'RASHADIYA SHE CAMPUS, MANJESHWWARAM, KASARGOD',
                'password' => bcrypt('rashadiyya3'),
                'membership_number' => 'SSOSNEC854',
                'stream' => 'life plus'
            ]
        );

        // bayyinath colleges (1)
        Institution::updateOrCreate(
            ['email' => 'quranicvillagektni@gmail.com'],
            [
                'name' => 'QURANIC VILLAGE (BOY), Karinkallathani',
                'password' => bcrypt('quranic4623'),
                'membership_number' => 'SSOSNEC700',
                'stream' => 'bayyinath'
            ]
        );
    }
}
