<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
 use App\Models\Institution;
class InstitutionSeeder extends Seeder
{
  

public function run()
{   
         //sharea colleges

        Institution::firstOrCreate(
            ['email' => 'shamsululamasnecalp@gmail.com'],
            ['name' => 'SHAMSUL ULAMA ISLAMIC & ARTS COLLEGE, PATHIYANKARA', 'password' => bcrypt('shamsululamasnecalp4621'),
            'membership_number' => 'SSOSNEC390']
        );

        Institution::firstOrCreate(
            ['email' => 'akmmsnec@gmail.com'],
            ['name' => 'AHMED KUTTY MUSLIYAR MEMORIAL COLLEGE OF ISLAMIC AND ARTS, KAINIKKARA', 'password' => bcrypt('akmmsnec4651'),'membership_number' => 'SSOSNEC352']
        );

        Institution::firstOrCreate(
            ['email' => 'gvicforboys@gmail.com'],
            ['name' => 'GRACE VALLEY ISLAMIC COLLEGE FOR BOYS, MARAVATTOM', 'password' => bcrypt('gvicforboys4658'),'membership_number' => 'SSOSNEC346']
        );

        Institution::firstOrCreate(
            ['email' => 'liwaulhudasnec@gmail.com'],
            ['name' => 'LIWA – UL HUDA ISLAMIC COMPLEX, KEEZHUPARAMBA', 'password' => bcrypt('liwaulhudasnec4562'),'membership_number' => 'SSOSNEC852']
        );

        Institution::firstOrCreate(
            ['email' => 'miacsnec@gmail.com'],
            ['name' => 'KHASI MUHAMMED MUSLIYAR EDUCATIONAL & CULTURAL COMPLEX, MARAYAMANGALAM', 'password' => bcrypt('miacsnec4521'),'membership_number' => 'SSOSNEC486']
        );

        Institution::firstOrCreate(
            ['email' => 'shamsululama@gmail.com'],
            ['name' => 'SHAMSUL ULAMA ISLAMIC ACADEMY, VENGAPPALLY', 'password' => bcrypt('shamsululama8465'),'membership_number' => 'SSOSNEC954']
        );

        

        Institution::firstOrCreate(
            ['email' => 'kickumbra@gmail.com'],
            ['name' => 'KARNATAKA ISLAMIC ACADEMY', 'password' => bcrypt('kickumbra4621'),'membership_number' => 'SSOSNEC483']
        );

        Institution::firstOrCreate(
            ['email' => 'diacademy31@gmail.com'],
            ['name' => 'DARUL IHSAN, CHUNGATHARA, NILAMBUR', 'password' => bcrypt('diacademy3146'),'membership_number' => 'SSOSNEC002']
        );

        

        Institution::firstOrCreate(
            ['email' => 'Imamshafieducationalboard316@gmail.com'],
            ['name' => 'IMAM SHAFI ISLAMIC ACADEMY, KUMBALA', 'password' => bcrypt('Imamshafieducationalboard3163'),'membership_number' => 'SSOSNEC960']
        );

        Institution::firstOrCreate(
            ['email' => 'daruswalah99@gmail.com'],
            ['name' => 'DARUSWALAH ISLAMIC ACADEMY, Karamoola', 'password' => bcrypt('daruswalah9982'),'membership_number' => 'SSOSNEC050']
        );

        Institution::firstOrCreate(
            ['email' => 'darulbirracademy@gmail.com'],
            ['name' => 'DARUL BIRR ISLAMIC ACADEMY, Payyannur', 'password' => bcrypt('darulbirracademy4397'),'membership_number' => 'SSOSNEC404']
        );

        Institution::firstOrCreate(
            ['email' => 'thanveeriac@gmail.com'],
            ['name' => 'THANVEER ISLAMIC AND ARTS COLLEGE, Kumminiparambu', 'password' => bcrypt('thanveeriac3648'),'membership_number' => 'SSOSNEC840']
        );

        Institution::firstOrCreate(
            ['email' => 'snecmuthawwalcampus@gmail.com'],
            ['name' => 'SNEC VARAKKAL MUTHAWWAL CAMPUS', 'password' => bcrypt('snecmuthawwalcampus4639'),'membership_number' => 'SSOSNEC813']
        );



        // sharea plus colleges 

         Institution::firstOrCreate(
            ['email' => 'micforboys@gmail.com'],
            ['name' => 'MARKAZ ISLAMIC & ARTS COLLEGE, KALAMASSERY', 'password' => bcrypt('micforboys4697'),'membership_number' => 'SSOSNEC963']
        );

        Institution::firstOrCreate(
            ['email' => 'nhocheruthuruthy@gmail.com'],
            ['name' => 'NOORUL HUDA EDUCATION CENTER, CHERUTHURUTHY', 'password' => bcrypt('nhocheruthuruthy4121'),'membership_number' => 'SSOSNEC802']
        );

        

        Institution::firstOrCreate(
            ['email' => 'Imamshafieducationalboard316@gmail.com'],
            ['name' => 'IMAM SHAFI ISLAMIC ACADEMY, Badriya Nagar, Kumbala, Kasaragod', 'password' => bcrypt('Imamshafieducationalboard3145'),'membership_number' => 'SSOSNEC741']
        );

        Institution::firstOrCreate(
            ['email' => 'pmicsnec@gmail.com'],
            ['name' => 'ANWARUL HUDA SHARI\'A COLLEGE, Vadakkangara, Mankada', 'password' => bcrypt('pmicsnec4632'),'membership_number' => 'SSOSNEC147']
        );

        Institution::firstOrCreate(
            ['email' => 'Cumvadihuda@gmail.com'],
            ['name' => 'VADI HUDA SHAREEATH COLLEGE, Omassery, Kozhikode', 'password' => bcrypt('Cumvadihuda4892'),'membership_number' => 'SSOSNEC258']
        );

        Institution::firstOrCreate(
            ['email' => 'cbmsislamicacademy@gmail.com'],
            ['name' => 'CBMS ISLAMIC ACADEMY, Vilayil Parappoor, Malappuram', 'password' => bcrypt('cbmsislamicacademy0345'),'membership_number' => 'SSOSNEC369']
        );

        Institution::firstOrCreate(
            ['email' => 'sda2k24@gmail.com'],
            ['name' => 'SHAMSUL ULAMA DARUSSALAM ACADEMY, WADITHWAIBA, Mangaluru', 'password' => bcrypt('sda2k2402'),'membership_number' => 'SSOSNEC064']
        );

        Institution::firstOrCreate(
            ['email' => 'bavaliacademy@gmail.com'],
            ['name' => 'SAYYID BAVA ALI ISLAMIC AND ARTS COLLEGE, Bavali, Wayanad', 'password' => bcrypt('bavaliacademy0066'),'membership_number' => 'SSOSNEC030']
        );

        Institution::firstOrCreate(
            ['email' => 'micaudcollege@gmail.com'],
            ['name' => 'MIC ARSHADUL ULOOM DA\'WA COLLEGE, Mahinabad, Chattanchal', 'password' => bcrypt('micaudcollege4623'),'membership_number' => 'SSOSNEC904']
        );

        Institution::firstOrCreate(
            ['email' => 'shamsululamasnec2025@gmail.com'],
            ['name' => 'SHAMSUL ULAMA ACADEMY, KUTHUPARAMB, KANNUR', 'password' => bcrypt('shamsululamasnec2085'),'membership_number' => 'SSOSNEC664']
        );

        Institution::firstOrCreate(
            ['email' => 'nic.snec@gmail.com'],
            ['name' => 'NUSRATHUL ISLAM SHAEE\'A COLLEGE, KUTTILAKADVU', 'password' => bcrypt('nicsnec0869'),'membership_number' => 'SSOSNEC403']
        );

        Institution::firstOrCreate(
            ['email' => 'darurahmakuzhalmannam@gmail.com'],
            ['name' => 'DARUL RAHMA COLLEGE, KUZHALMANNAM, PALAKKAD', 'password' => bcrypt('darurahmakuzhalmannam8962'),'membership_number' => 'SSOSNEC930']
        );


        // she colleges

        Institution::firstOrCreate(
            ['email' => 'snecmannar@gmail.com'],
            ['name' => 'NAFEESATHUL MISRIYYA ISLAMIC AND ARTS COLLEGE , MANNAR', 'password' => bcrypt('snecmannar6956'),'membership_number' => 'SSOSNEC101']
        );

        Institution::firstOrCreate(
            ['email' => 'shehidaya@gmail.com'],
            ['name' => 'DARUL HIDAYA WOMENS ACADEMY, EDAPPAL, MALAPPURAM', 'password' => bcrypt('shehidaya6456'),'membership_number' => 'SSOSNEC102']
        );

        Institution::firstOrCreate(
            ['email' => 'gvicforgirls@gmail.com'],
            ['name' => 'GRACE VALLEY ISLAMIC COLLEGE FOR GIRLS, MARAVATTOM', 'password' => bcrypt('gvicforgirls1239'),'membership_number' => 'SSOSNEC105']
        );

        Institution::firstOrCreate(
            ['email' => 'shecampusimamshafi@gmail.com'],
            ['name' => 'IMAM SHAFI SHE CAMPUS, KUMBALA', 'password' => bcrypt('shecampusimamshafi4562'),'membership_number' => 'SSOSNEC106']
        );

        Institution::firstOrCreate(
            ['email' => 'niorphanage1968@gmail.com'],
            ['name' => 'NOORUL ISLAM WOMENS COLLEGE, ALAMBADY', 'password' => bcrypt('niorphanage1903'),'membership_number' => 'SSOSNEC109']
        );

        

        Institution::firstOrCreate(
            ['email' => 'vadinoorcollege@gmail.com'],
            ['name' => 'VADI NOOR ISLAMIC AND ARTS COLLEGE FOR GIRLS , VANIMEL', 'password' => bcrypt('vadinoorcollege6496'),'membership_number' => 'SSOSNEC201']
        );

        Institution::firstOrCreate(
            ['email' => 'khidmathwomenscollege@gmail.com'],
            ['name' => 'KHIDMATHUL ISLAM WOMENS COLLEGE, EDAKKULAM', 'password' => bcrypt('khidmathwomenscollege3694'),'membership_number' => 'SSOSNEC203']
        );

        Institution::firstOrCreate(
            ['email' => 'mickaipamangalam@gmail.com'],
            ['name' => "MIC WOMEN'S COLLEGE, KAIPPAMANGALM", 'password' => bcrypt('mickaipamangalam4368'),'membership_number' => 'SSOSNEC208']
        );

        

        Institution::firstOrCreate(
            ['email' => 'kmmwomenscollegekmm@gmail.com'],
            ['name' => 'KOYYOD MUHIYIDHEENKUTTY MUSLIYAR MEMORIAL WOMENS ACADEMY, VENGAD', 'password' => bcrypt('kmmwomenscollegekmm0973'),'membership_number' => 'SSOSNEC280']
        );

        Institution::firstOrCreate(
            ['email' => 'ummulqurasnec@gmail.com'],
            ['name' => 'UMMUL QURA ISLAMIC AND ARTS COLLEGE FOR WOMEN, KALOOR', 'password' => bcrypt('ummulqurasnec0589'),'membership_number' => 'SSOSNEC100']
        );

        Institution::firstOrCreate(
            ['email' => 'kbbvellarakkad@gmail.com'],
            ['name' => 'KHADIJA BINTH BUKHARI (KBB), VELLARKKAD', 'password' => bcrypt('kbbvellarakkad1463'),'membership_number' => 'SSOSNEC999']
        );

        Institution::firstOrCreate(
            ['email' => 'crescentshecampus@gmail.com'],
            ['name' => 'CRESCENT SNEC SHE CAMPUS, VELIMUKK', 'password' => bcrypt('crescentshecampus7891'),'membership_number' => 'SSOSNEC666']
        );

        Institution::firstOrCreate(
            ['email' => 'ajumshecampus@gmail.com'],
            ['name' => 'AJUM SHE CAMPUS (DAY COLLEGE)', 'password' => bcrypt('ajumshecampus6874'),'membership_number' => 'SSOSNEC333']
        );

        Institution::firstOrCreate(
            ['email' => 'jaliyyachelari@gmail.com'],
            ['name' => 'JALIYYA GIRLS CAMPUS, CHELARI', 'password' => bcrypt('jaliyyachelari3647'),'membership_number' => 'SSOSNEC444']
        );

        
        
        // she plus colleges 

        Institution::firstOrCreate(
            ['email' => 'micforgirls@gmail.com'],
            ['name' => 'MARKAZ ISLAMIC & ARTS VANITHA COLLEGE, CHANGAPUZHA, ERNAKULAM', 'password' => bcrypt('micforgirls4731'),'membership_number' => 'SSOSNEC555']
        );

        Institution::firstOrCreate(
            ['email' => 'nafeesatulmisriyyawomens@gmail.com'],
            ['name' => 'NAFEESATHUL MISRIYA MOOTHEDAM, EDAKKARA', 'password' => bcrypt('nafeesatulmisriyyawomens4600'),'membership_number' => 'SSOSNEC660']
        );

        Institution::firstOrCreate(
            ['email' => 'sneckuttikkattoor@gmail.com'],
            ['name' => "SHAMSUL ULAMA WOMEN'S ACADEMY KUTTIKKATTOOR", 'password' => bcrypt('sneckuttikkattoor5412'),'membership_number' => 'SSOSNEC770']
        );

        Institution::firstOrCreate(
            ['email' => 'alameengirlsorphanage@gmail.com'],
            ['name' => 'AL AMEEN WOMENS COLLEGE ,KOTTAYI, PALAKKAD', 'password' => bcrypt('alameengirlsorphanage6941'),'membership_number' => 'SSOSNEC466']
        );

        Institution::firstOrCreate(
            ['email' => 'iqrathrikaripur@gmail.com'],
            ['name' => "IQRA'A ISLAMIC COLLEGE FOR GIRLS, MANIYANODY, TRIKARIPUR, KASARAGOD", 'password' => bcrypt('iqrathrikaripur9431'),'membership_number' => 'SSOSNEC488']
        );

        Institution::firstOrCreate(
            ['email' => 'micsnecsheplus@gmail.com'],
            ['name' => 'MIC WOMENS ACADEMY KOTTOPADAM, MANNARKKAD, PALAKKAD', 'password' => bcrypt('micsnecsheplus9542'),'membership_number' => 'SSOSNEC422']
        );


        // life colleges


        Institution::firstOrCreate(
            ['email' => 'thoobacampus@gmail.com'],
            ['name' => 'THOOBA RESIDENTIAL CAMPUS , Madavoor, KOZHIKODE', 'password' => bcrypt('thoobacampus4623'),'membership_number' => 'SSOSNEC433']
        );

        Institution::firstOrCreate(
            ['email' => 'gpasnec@gmail.com'],
            ['name' => 'GRACE VALLEY LIFE INSTITUTE Maravattom, MALAPPURAM', 'password' => bcrypt('gpasnec6852'),'membership_number' => 'SSOSNEC499']
        );



        // life plus colleges

        Institution::firstOrCreate(
            ['email' => 'daruthaqwasnecalr@gmail.com'],
            ['name' => 'DARU THAQWA ISLAMIC ACADEMY, ALANALLUR, PALAKKAD', 'password' => bcrypt('daruthaqwa3695'),'membership_number' => 'SSOSNEC467']
        );



        // bayyinath colleges

        Institution::firstOrCreate(
            ['email' => 'quranicvillagektni@gmail.com'],
            ['name' => 'QURANIC VILLAGE (BOY), Karinkallathani', 'password' => bcrypt('quranic4623'),'membership_number' => 'SSOSNEC700']
        );


}

}
