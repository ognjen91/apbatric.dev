<?php
if (!isset($_GET['lang'])){
//echo $apartman;
if ($apartman == "Apartman1"){
    
    $punNaziv = "Apartman 1";
    
    $brojKreveta = "4+3";
    $pocetnaCijena = "75";
    
    
    $opis = "<span class='firstcharacter'>A</span>partman 1 se sastoji od dvije odvojene sobe i može da primi do 7 gostiju: jedna soba posjeduje bračni krevet, a druga 2 kreveta dimenzija 90x200cm, sa fiokama - računaju se kao pomoćni ležajevi.<br><br> 
    Za naše goste koji dolaze u većim grupama, ovaj apartman posjeduje i pomoćni ležaj (sofa, razvučena 90x200cm) koji se nalazi u predsoblju. <br><br>
    
    Takođe, posjeduje i kompletno opremljenu kuhinju, kupatilo, klimu i LCD TV.";
    
    
    $pogodnosti = ["Kupatilo", "Kuhinja", "Klima", "Wi-Fi", "LCD TV"];
}

if ($apartman == "Apartman2"){
    
    $punNaziv = "Apartman 2";
    $brojKreveta = "4+3";
    $pocetnaCijena = "75";
    
    $opis = "Apartman 2 se sastoji od 2 sobe i posjeduje 6 kreveta. <br>
    Soba 1 posjeduje bračni krevet, a soba 2 posjeduje 2 kreveta dimenzija 90x200 cm sa fiokama - računaju se kao pomoćni ležajevi.<br>
    Za dodatne potrebe, apartman posjeduje i pomoćni ležaj (90x200cm) koji se nalazi u predsoblju. <br><br>
    
    Takođe, kao i svi naši apartmani, posjeduje i kompletno opremljenu kuhinju, kupatilo, klimu i LCD TV.";
    
    $pogodnosti = ["Kupatilo", "Kuhinja", "Klima", "Wi-Fi", "LCD TV"];
}

if ($apartman == "Apartman3"){
    
    $punNaziv = "Apartman 3";
    $brojKreveta = "6+1";
    $pocetnaCijena = "85";
    
    $opis = "Apartman 3 se sastoji od 2 odvojene spavaće sobe i dnevnog boravka i posjeduje 5 kreveta. <br>
    Obje spavaće sadrže po bračni ležaj, a u dnevnom boravku se nalazi trosjed na kojem, kada se rasklopi, mogu da spavaju dvije osobe.<br>
    Za dodatne potrebe, apartman posjeduje i pomoćni ležaj koji se nalazi u jednoj od soba.<br><br>
    
    
    Apartman 3 se nalazi u prizemlju, a plaža je udaljena svega nekoliko metara.<br>
    
    Takođe, posjeduje i kompletno opremljenu kuhinju, kupatilo sa hidromasažnom kabinom, klimu i LCD TV.";
    
    $pogodnosti = ["Kupatilo", "Kuhinja", "Klima", "Wi-Fi", "LCD TV"];
    
    
}

if ($apartman == "Apartman4"){
    
    $punNaziv = "Apartman 4";
    $brojKreveta = "4";
    $pocetnaCijena = "55";
    
    $opis = "Apartman 4 je namjenjen za porodice ili manje grupe. Ovaj apartman je čeLCD TVrokrevetni sa jednom spavaćom sobom u kojoj se nalazi bračni ležaj i jedan krevet. U predsoblju/dnevnoj sobi se nalazi još jedan ležaj.<br><br>
    
    Jedna od odlika ovog apartmana je i pogled na plažu i zaliv. Sama plaža se nalazi na tek par koraka.<br>
    
    
    Takođe, kao i svi naši apartmani, posjeduje i kompletno opremljenu kuhinju, kupatilo sa hidromasažnom kabinom, klimu i LCD TV.";
    
    $pogodnosti = ["Kupatilo", "Kuhinja", "Klima", "Wi-Fi", "LCD TV"];
}


if ($apartman == "Apartman5"){
    
    $punNaziv = "Apartman 5";
    $brojKreveta = "4+1";
    $pocetnaCijena = "70";
    
    $opis = "Apartman 5 posjeduje jednu spavaću sobu sa bračnim krevetom, a u dnevnom boravku se nalaze sofa, te ležaj sa klik-klak mehanizmom.<br><br>
    
    
    Ovaj apartman posjeduje i kompletno opremljenu kuhinju, kupatilo sa hidromasažnom kabinom, klimu i LCD TV.";
    
    $pogodnosti = ["Kupatilo", "Kuhinja", "Klima", "Wi-Fi", "LCD TV"];
}

if ($apartman == "Apartman6"){
    
    $punNaziv = "Apartman 6";
    $brojKreveta = "5+1";
    $pocetnaCijena = "75";
    
    $opis = "Apartman 6 je šestokrevetni i posjeduje 2 spavaće sobe.<br>
    U jednoj spavaćoj sobi nalazi se bračni krevet, a u drugoj ležaj sa klik-klak mehanizmom, jedan ležaj dimenzija 90x200cm i pomoćni ležaj.<br><br>
    
    
    Apartman 6 posjeduje i kompletno opremljenu kuhinju, kupatilo sa hidromasažnom kabinom, klimu i LCD TV.";
    
    $pogodnosti = ["Kupatilo", "Kuhinja", "Klima", "Wi-Fi", "LCD TV"];
}

if ($apartman == "ApartmanLux"){
    
    $punNaziv = "Apartman Lux";
    $brojKreveta = "6+2";
    $pocetnaCijena = "100";
    
    $opis = "Apartman 7 (Lux) je naš najveći apartman. Površine je 90 m<sup>2</sup> i kapaciteta je do 8 osoba.<br>
    Sastoji se od 2 odvojene spavaće sobe koje sadrže po bračni krevet. U jednoj od soba se nalazi i ležaj 90x200cm, a u dnevnom boravku ugaona garnitura na razvlačenje, kao i sofa na razvlačenje. <br><br>
    U sklopu apartmana je potpuno opremljena kuhinja sa mašinom za pranje sudova i mikrotalasnom pećnicom, komforno kupatilo sa mašinama za pranje i sušenje veša, klima, LCD TV. <br><br>
    
    
    Ono što ovaj apartman izdvaja od ostalih je i prostrana terasa sa pogledom na more, a plaža se nalazi na tek nekoliko metara.";
    
    $pogodnosti = ["Kupatilo", "Veš mašina <br> (pranje/sušenje)", "Kuhinja", "Klima", "Mašina za sudove", "Mikrotalasna pećnica", "Wi-Fi", "LCD TV", "Terasa sa pogledom"];
}


if ($apartman == "Apartman8"){
    
    $punNaziv = "Apartman 8";
    $pocetnaCijena = "50";
    $brojKreveta = "3";
    
    $opis = "Apartman 8 je naš najnoviji apartman. Nalazi se tek par koraka od mora i odvojen je od ostalih apartmana.<br>
    
    Sastoji se iz sobe u kojoj se nalazi bračni krevet i sofa (razvučena 190x200cm). <br>
    
    U sklopu apartmana je potpuno opremljena kuhinja sa mašinom za pranje sudova i mikrotalasnom pećnicom, te kupatilo sa veš mašinom, klima, LCD TV. 
    <br><br>
    
    ";
    
    $pogodnosti = ["Kupatilo", "Veš mašina", "Kuhinja", "Klima", "Mašina za sudove", "Mikrotalasna pećnica", "Wi-Fi", "LCD TV"];
}

}


//-----------------ENGLESKI--------------


if($_GET['lang'] == "en"){
if ($apartman == "Apartman1"){
    
    $punNaziv = "Apartment No. 1";
    
    $brojKreveta = "4+3";
    $pocetnaCijena = "75";
    
    
    $opis = "<span class='firstcharacter'>A</span>partment No. 1 consists of 2 bedrooms and living room and can host up to 7 guests: first room is double room, and in the other one there are 2 beds with drawers, as seen on images.<br><br> 
    For larger groups, there is an extra bed in anteroom (sleeper sofa, 90x200 when pulled out).<br><br>
    
    All our apartments are fully equiped with modern amanities (LCD TV, air conditioner, modern kitchen and bathroom amanities).
    ";
    
    
    $pogodnosti = ["Bathroom", "Kitchen", "Air conditioner", "Wi-Fi", "LCD TV"];
}

if ($apartman == "Apartman2"){
    
    $punNaziv = "Apartment No. 2";
    $brojKreveta = "4+3";
    $pocetnaCijena = "75";
    
    $opis = "<span class='firstcharacter'>A</span>partment No. 2 consists of 2 bedrooms and living room and can accommodate up to 7 guests: first room is double room,  and in the other one there are 2 beds with drawers, as seen on images.<br><br> 
    For larger groups, there is an extra bed in anteroom.<br><br>
    
    All our apartments are fully equiped with modern amanities (LCD TV, air conditioner, modern kitchen and bathroom amanities).";
    
     $pogodnosti = ["Bathroom", "Kitchen", "Air conditioner", "Wi-Fi", "LCD TV"];
}

if ($apartman == "Apartman3"){
    
    $punNaziv = "Apartment No. 3";
    $brojKreveta = "6+1";
    $pocetnaCijena = "85";
    
    $opis = "<span class='firstcharacter'>A</span>partment No. 3 consists of 2 separate double rooms and living room. <br>
    In living room there is a sleeper sofa (suitable for 2 persons).<br>
    Additionaly, there is an extra bed in anteroom.<br><br>
    
    
    Apartmanent No. 3 is situated on ground floor, only a few meters far from our private beach.<br>
    
    All our apartments are fully equiped with modern amanities (LCD TV, air conditioner, modern kitchen amanities and bathroom with hydromassage shower).";
    
      $pogodnosti = ["Bathroom", "Kitchen", "Air conditioner", "Wi-Fi", "LCD TV"];
    
    
}

if ($apartman == "Apartman4"){
    
    $punNaziv = "Apartment No. 4";
    $brojKreveta = "4";
    $pocetnaCijena = "55";
    
    $opis = "Apartment No. 4 is a good choice for families or small groups. This apartment has one bedroom with double bed and one single bed. In anteroom/living room, there is one more bed.<br><br>
    
    If you choose this apartment, your days will begin with sea view. Our private beach is only a few meters away.<br>
    
    
    Just like all our apartments, Apartment No. 4 is fully equiped with modern amanities (LCD TV, air conditioner, modern kitchen amanities and bathroom amanities).";
    
     $pogodnosti = ["Bathroom", "Kitchen", "Air conditioner", "Wi-Fi", "LCD TV"];
}


if ($apartman == "Apartman5"){
    
    $punNaziv = "Apartment No. 5";
    $brojKreveta = "4+1";
    $pocetnaCijena = "70";
    
    
    $opis = "Apartment No. 5 consists of one double room and living room with 3 additional beds (sofa bed and sleeper sofa)<br><br>
    
    
     All our apartments are fully equiped with modern amanities (LCD TV, air conditioner, modern kitchen amanities and bathroom with hydromassage shower).";
    
    $pogodnosti = ["Bathroom", "Kitchen", "Air conditioner", "Wi-Fi", "LCD TV"];
}

if ($apartman == "Apartman6"){
    
    $punNaziv = "Apartment No. 6";
    $brojKreveta = "5+1";
    $pocetnaCijena = "75";
    
    $opis = "Apartman No. 6 with total of 6 beds is great choice for big groups or families.<br>
    One room in apartment is a double room, while in the other room there are 4 beds (one single bed, sofa bed and sleeper sofa).<br><br>
    
    
     All our apartments are fully equiped with modern amanities (LCD TV, air conditioner, modern kitchen and bathroom amanities).";
    
    $pogodnosti = ["Bathroom", "Kitchen", "Air conditioner", "Wi-Fi", "LCD TV"];
}

if ($apartman == "ApartmanLux"){
    
    $punNaziv = 'Apartment "Lux"';
    $brojKreveta = "6+2";
    $pocetnaCijena = "100";
    
    $opis = "Apartment No. 7 (Lux) is our largest apartment. This bright apartment with its 90 m<sup>2</sup> can host up to 8 guests.<br>
    It consists of one double room, one room with double bed and single bed 90x200cm, and in the living room there are corner sofa set (can be pulled out) and sleeper sofa.<br><br>
    It is fully equiped with modern room amanities (LCD TV, air conditioner), kitchen amanities (dishwasher, microwave)and bathroom amanities - washing machine and clothes dryer. <br><br>
    
    
    Apartment's large terrace with sea view is great place for morning cofee. Private beach is only a few meters away.";
    
    $pogodnosti = ["Bathroom", "Washing machine/clothes dryer <br> (pranje/sušenje)", "Kitchen", "Air conditioner", "Dishwasher", "Microwave", "Wi-Fi", "LCD TV", "Terrace with sea view"];
}


if ($apartman == "Apartman8"){
    
    $punNaziv = "Apartment No. 8";
    $pocetnaCijena = "50";
    
    $opis = "Apartment No. 8 has been recently refurbished to the highest standards. It is separated from the other apartments and it is located only a few steps from the sea. <br>
    
    It can accommodate 3 guests: in this apartment there are double bed and sleeper sofa (190x200cm when pulled out). <br>
    
   All our apartments are fully equiped with modern amanities (LCD TV, air conditioner, modern kitchen and bathroom amanities). 
    <br><br>
    
    ";
    
    $pogodnosti = ["Bathroom", "Washing machine", "Kitchen", "Air conditioner", "Dishwasher", "Microwave", "Wi-Fi", "LCD TV"];
}

}






//-------------RUSKI JEZIK---------------

if($_GET['lang'] == "ru"){
//echo $apartman;
if ($apartman == "Apartman1"){
    
    $punNaziv = "Апартамент № 1";
    
    $brojKreveta = "4+3";
    $pocetnaCijena = "75";
    
    
    $opis = "<span class='firstcharacter'>A</span>партамент 1 состоит из двух отдельных комнат и в нем могут поместиться шестеро гостей: в одной комнате брачная кровать а в другой 4 постели (кровати с выдвижными ящиками).<br><br> 
    Для гостей, приезжающих в группах, в апартаменте есть добавочная постель, находящаяся в прихожей.<br><br>
    
    В апартаменте полное оборудование – кухня, ванная, климат-контроль и LCD TV.";
    
    
    $pogodnosti = ["Ванная комата", "Кухня", "Кондиционер", "Wi-Fi", "LCD TV"];
}

if ($apartman == "Apartman2"){
    
    $punNaziv = "Апартамент № 2";
    $brojKreveta = "4+3";
    $pocetnaCijena = "75";
    
    $opis = "<span class='firstcharacter'>A</span>партамент 1 состоит из двух отдельных комнат и в нем могут поместиться шестеро гостей: в одной комнате брачная кровать а в другой 4 постели (кровати с выдвижными ящиками).<br><br> 
    Для гостей, приезжающих в группах, в апартаменте есть добавочная постель, находящаяся в прихожей.<br><br>
    
    В апартаменте полное оборудование – кухня, ванная, климат-контроль и LCD TV.";
    
    $pogodnosti = ["Ванная комата", "Кухня", "Кондиционер", "Wi-Fi", "LCD TV"];
}

if ($apartman == "Apartman3"){
    
    $punNaziv = "Апартамент № 3";
    $brojKreveta = "6+1";
    $pocetnaCijena = "85";
    
    $opis = "Апартамент 3 состоит из двух отдельных спален и гостиной,  в нем 7 кроватей.<br>
    В обоих спальнях брачная постель, а в гостиной находится раскладывающийся трехместный диван, на котором, если его разложить, могут спать двое человек.<br><br>
    
    
    
    В апартаменте полное оборудование – кухня, ванная, климат-контроль и LCD TV. ";
    
    
    
    $pogodnosti = ["Ванная комата", "Кухня ", "Кондиционер", "Wi-Fi", "LCD TV"];
    
    
}

if ($apartman == "Apartman4"){
    
    $punNaziv = "Апартамент № 4";
    $brojKreveta = "4";
    $pocetnaCijena = "55";
    
    $opis = "Апартамент № 4 (4 человека мощности), одна спальня содержащие двуспальная кровать и одна кровать. B гостиной, eсть еще одна кровать.<br><br>
    
    Квартира полностью оборудованная кухня, ванная комната с гидромассажным душем, включает в себя кондиционер и телевизор.<br>";
    
    $pogodnosti = ["Ванная комата", "Кухня ", "Кондиционер", "Wi-Fi", "LCD TV"];
}


if ($apartman == "Apartman5"){
    
    $punNaziv = "Апартамент № 5";
    $brojKreveta = "4+1";
    $pocetnaCijena = "70";
    
    $opis = "Апартамент № 5 (5 человек мощности) имеет одну спальню содержащие двуспальной кроватью и гостиная  с двумя кроватями. <br><br>
    
    
    Квартира полностью оборудованная кухня, ванная комната с гидромассажным душем, включает в себя кондиционер и телевизор.";
    
   $pogodnosti = ["Ванная комата", "Кухня ", "Кондиционер", "Wi-Fi", "LCD TV"];
}

if ($apartman == "Apartman6"){
    
    $punNaziv = "Апартамент № 6";
    $brojKreveta = "5+1";
    $pocetnaCijena = "75";
    
    $opis = "Апартамент № 6 (6 человек мощности) имеет две спальни. Одна спальня имеет двуспальную кровать,  а другой имеет четыре кровати. <br><br>
    Квартира полностью оборудованная кухня и ванная комната с гидромассажным душем, включает в себя кондиционер и телевизор.";
    
    
    $pogodnosti = ["Ванная комата", "Кухня ", "Кондиционер", "Wi-Fi", "LCD TV"];
}

if ($apartman == "ApartmanLux"){
    
    $punNaziv = "Апартамент Люкс";
    $brojKreveta = "6+2";
    $pocetnaCijena = "100";
    
    $opis = "Апартамент № 7 (Люкс) – самый пространный у нас. Его площадь 90 м2 и предназначен на 8 человек. Состоит из двух спален с брачными постелями (в одном из этих номеров есть односпальная кровать) и гостиной с 4 постелями. <br><br>
    Преимущество данного апартамента и в том, что он оснащен пространной террасой с видом на море и что находится в нескольких шагах от пляжа. <br><br>
    
    
    Квартира полностью оборудованная кухня и ванная комната с гидромассажным душем, включает в себя кондиционер и телевизор.";
    
    $pogodnosti = ["Ванная комата", "Стиральная машина/Сушильная машина", "Кухня ", "Кондиционер", "Посудомоечная машина", "СВЧ-печь", "Wi-Fi", "LCD TV", "Терраса с видом на море"];
}


if ($apartman == "Apartman8"){
    
    $punNaziv = "Апартамент № 8";
    $pocetnaCijena = "50";
    $brojKreveta = "3";
    
    $opis = "Апартамент № 8 – новейший у нас. Nalazi se tek par koraka od mora i odvojen je od ostalih apartmana.<br>
    
    Расположен в нескольких шагах от моря обособленно от остальных наших  апартаментов. Состоит из комнаты, в которой брачная постель и диван (при раскладке 190 X 200 см).  <br>
    
    В апартаменте полностью оборудованная кухня с машиной для мытья посуды и микроволновой печью, ванная с стиральной машиной, климат-котнроль, LCD TV.
    <br><br>
    
    ";
    
    $pogodnosti = ["Ванная комата", "Стиральная машина", "Кухня", "Кондиционер", "Посудомоечная машина", "СВЧ-печь", "Wi-Fi", "LCD TV"];
}

}


//-----------SLUCAJAN BROJ> SLOGANI ZA SLIKE NA VRHU---



$slucajniBroj = rand (1,6);

if (!isset($_GET['lang'])){
switch ($slucajniBroj){
        
         
    case 1:
        $naslovZaSobu = "10% sniženje za rezervacije direktno sa sajta";
        break;
        
    case 2:
        $naslovZaSobu = "Pratite na na Facebooku za dodatna sniženja";
        break;
        
    case 3:
        $naslovZaSobu = "Pratite na na Instagramu za dodatna sniženja";
        break;
        
    case 4:
        $naslovZaSobu =  "10% sniženje za rezervacije direktno sa sajta";
        break;
        
    case 5:
        $naslovZaSobu =  "Pratite na na Facebooku za dodatna sniženja";
        break;
        
    case 6:
        $naslovZaSobu =  "Pratite na na Instagramu za dodatna sniženja";
        break;    
         }
        
        
        
}


if($_GET['lang'] == "en"){
    switch ($slucajniBroj){
        
         
    case 1:
        $naslovZaSobu = "10% OFF FOR RESERVTIONS FROM WEBSITE";
        break;
        
    case 2:
        $naslovZaSobu = "FOLLOW US ON FACEBOOK FOR SPECIAL OFFERS";
        break;
        
    case 3:
        $naslovZaSobu = "FOLLOW US ON INSTAGRAM FOR SPECIAL OFFERS";
        break;
        
    case 4:
        $naslovZaSobu = "10% OFF FOR RESERVTIONS FROM WEBSITE";
        break;
        
    case 5:
        $naslovZaSobu = "FOLLOW US ON FACEBOOK FOR SPECIAL OFFERS";
        break;
        
    case 6:
        $naslovZaSobu = "FOLLOW US ON INSTAGRAM FOR SPECIAL OFFERS";
        break;    
         }
        
    
}


if($_GET['lang'] == "ru"){
    switch ($slucajniBroj){
        
         
    case 1:
        $naslovZaSobu = "Получите скидку 10% при бронировании с сайта";
        break;
        
    case 2:
        $naslovZaSobu = "Следите за нами в Facebook для специальных предложений";
        break;
        
    case 3:
        $naslovZaSobu = "Получите скидку 10% при бронировании с сайта";
        break;
        
    case 4:
        $naslovZaSobu = "Получите скидку 10% при бронировании с сайта";
        break;
        
    case 5:
        $naslovZaSobu = "Следите за нами в Facebook для специальных предложений";
        break;
        
    case 6:
        $naslovZaSobu = "Следите за нами в Facebook для специальных предложений";
        break;    
         }
        
    
}


?>