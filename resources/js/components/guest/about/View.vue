<i18n>
{
"sr": {
    "O nama" : "O nama",
    "naslov1" : "Uvijek smo tu za Vas",
    "tekst1" : "Učinićemo sve da Vaš odmor prođe onako kako ste zamislili, čak i bolje od toga. U svakom trenutku bićemo dobri domaćini Vama i Vašim dragim osobama.",
    "naslov2" : "Tradicija",
    "tekst2" : "20 godina iskustva u ugostiteljstvu i mnogo zadovoljnih gostiju garantuju vrhunsku uslugu. Ipak, sa uzbuđenjem čakamo i vaše utiske.",
    "naslov3" : "Mir i tišina",
    "tekst3" : "Naša lokacija u srcu Bokokotorskog zaliva, između mora na jednoj i obronaka Orjena na drugoj strani, sama po sebi djeluje umirujuće na sva čula.",
    "naslov4" : "Kontaktirajte nas",
    "tekst4" : "Rado ćemo odgovoriti na sva vaša pitanja, ali i razmotiriti vaše prijedloge i sugestije, u najkraćem mogućem roku. Ostanimo u kontaktu!"
},
  "en": {
    "O nama" : "About Us",
    "naslov1" : "Always There For You",
    "tekst1" : "Our mission is clear: provide anything that is necessary for your stay, so that you feel that you are among friends and to see you again in the future.",
    "naslov2" : "Tradition",
    "tekst2" : "20 years of experience in tourism is a guarantee for the good service: but still, we are looking for Your positive opinion as it menas the most to us.",
    "naslov3" : "Peace and Quiet",
    "tekst3" : "Situated if quiet part of The Bay f Kotor, Apartments Batrićević are perfect place for carefree and relaxing stay.",
    "naslov4" : "Contact Us",
    "tekst4" : "We are ready to answer any questions as soon as possible. Please send as your questions, opinions and suggestions. Let's stay connected!"
  },
  "ru" : {
    "O nama" : "Насчет нас",
    "naslov1" : "Всегда к вашим услугам",
    "tekst1" : "Наша миссия понятна: обеспечить, чтобы ваш отдых прошел великолепно, чтобы вы почувствовали, что находитесь среди друзей и чтобы у вас возникло желание посетить нас еще раз.",
    "naslov2" : "Tрадиция",
    "tekst2" : "20-летний опыт в сфере туризма является гарантией хорошего обслуживания. Мы ищем ваше положительное мнение!",
    "naslov3" : "Мир и спокойствие",
    "tekst3" : "Апартаменты Батричевич расположены в тихой части Кока-Которского залива. Это идеальное место для беззаботного семейного отдыха в дружеской средиземноморской атмосфере.",
    "naslov4" : "Kontaktirajte nas",
    "tekst4" : "Мы готовы ответить на любые вопросы как можно скорее. Присылайте свои вопросы, мнения и предложения. Mы ценим ваше мнение!"
  }
}
</i18n>



<template lang="html">
  <div class="row aboutUs">

                 <div class="col-xl-1 helperAbout"></div>

                <div class=" col-12 col-sm-6 col-xl-5 introAboutUs">
                    <div class="aboutus">
                        <h2 class="aboutus-title title aboutUsTitle">{{$t("O nama")}}</h2>
                        <p class="aboutus-text title" v-html="about[locale]"></p>

                        <!-- <a class="aboutus-more" href="#">read more</a> -->
                    </div>
                </div>
                <div class="col-sm-6 col-12 col-xl-5 aboutUsImg">
                    <div class="aboutus-banner">
                        <img src="/images/batricevici.jpg" alt="">
                    </div>
                </div>

                <div class="col-xl-1 helperAbout"></div>


                <div class="col-sm-10 col-12 col-xl-12 featureSection">
                    <div class="feature row">
                        <div class="feature-box col-12 col-sm-6 col-xl-3">
                            <div class="clearfix">
                                <div class="iconset">
                                    <span class="glyphicon glyphicon-cog icon"></span>
                                </div>
                                <div class="feature-content">
                                    <h4 class='titleBig paragraphTitle spaced'>{{$t("naslov1")}}</h4>
                                    <p class='title'>{{$t("tekst1")}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="feature-box col-12 col-sm-6 col-xl-3">
                            <div class="clearfix">
                                <div class="iconset">
                                    <span class="glyphicon glyphicon-cog icon"></span>
                                </div>
                                <div class="feature-content">
                                    <h4 class='titleBig paragraphTitle spaced'>{{$t("naslov2")}}</h4>
                                    <p class='title'>{{$t("tekst2")}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="feature-box col-12 col-sm-6 col-xl-3">
                            <div class="clearfix">
                                <div class="iconset">
                                    <span class="glyphicon glyphicon-cog icon"></span>
                                </div>
                                <div class="feature-content">
                                    <h4 class='titleBig paragraphTitle spaced'>{{$t("naslov3")}}</h4>
                                    <p class='title'>{{$t("tekst3")}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="feature-box col-12 col-sm-6 col-xl-3">
                            <div class="clearfix">
                                <div class="iconset">
                                    <span class="glyphicon glyphicon-cog icon"></span>
                                </div>
                                <div class="feature-content">
                                    <h4 class='titleBig paragraphTitle spaced'>{{$t("naslov4")}}</h4>
                                    <p class='title'>{{$t("tekst4")}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

    </div>

  </div>
</template>

<script>
export default {
  created(){
    this.$store.dispatch('guestGetAbout');
  },
  data(){
    return {
        locale: localStorage.getItem('lang')
    }
  },
  computed : {
    about(){
      return this.$store.getters.getAbout;
    }
  }
}
</script>

<style lang="css">
</style>
