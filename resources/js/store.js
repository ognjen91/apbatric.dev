import {
    getLocalUser
} from './helpers/auth.js';
import Vue from 'vue';


const user = getLocalUser();

export default {
    state: {
        currentUser: user,
        isLoggedIn: !!user,
        loading: false,
        auth_error: null,
        rooms: [],
        activeEvents: [],
        pastEvents: [],
        all_reserved_dates: {},
        room_reserved_dates: [],
        about: {},
        contact: {
            adress: "",
            phone1: "",
            phone2: "",
            skype: "",
            facebook: "",
            instagram: ""
        },
        sliderImages: [],
        sliderTexts: [],
        galleryImages: [],
        reservedDates: [],
        showDiscountDanger: null
    },



    getters: {
        isLoading: (state) => state.loading,
        isLoggedIn: (state) => state.isLoggedIn,
        currentUser: (state) => state.currentUser,
        authError: (state) => state.auth_error,
        getRooms: (state) => state.rooms,
        getRoom: state => id => {
            return state.rooms.find(room => room.id == id);
        },
        getRoomReservedDates: (state) => (id) => {
            return state.all_reserved_dates[id];
        },
        getRoomPrices : (state) => (id) => {
            let room = state.rooms.find(room => room.id == id);
            return room.prices.prices;
        },
        getActiveEvents: state => state.activeEvents,
        getPastEvents: state => state.pastEvents,
        getCurrentEvent: state => state.activeEvents.find(event => event.active == 1),
        getEvent: state => id => state.activeEvents.find(event => event.id == id),
        getAbout: state => state.about,
        getContact: state => state.contact,

        // guestGetters
        getSliderImages: state => state.sliderImages,
        getSliderTexts: state => state.sliderTexts,
        getGalleryImages: state => state.galleryImages,
        getAllReservedDates: state => state.reservedDates,
        showDiscountDanger: state => state.showDiscountDanger,
    },



    mutations: {

      // ==========ADMIN/GUEST MUTATIONS============

        login(state) {
            state.loading = true;
            state.auth_error = null
        },
        loginSuccess(state, payload) {
            state.auth_error = null;
            state.isLoading = false;
            state.isLoggedIn = true;
            state.currentUser = Object.assign({}, payload.user, {
                token: payload.access_token
            });
            localStorage.setItem("user", JSON.stringify(state.currentUser));
        },
        loginFailed(state, payload) {
            state.loading = false;
            state.auth_error = payload.error;
        },
        logout(state) {
            localStorage.removeItem('user');
            state.isLoggedIn = false;
            state.currentUser = null;
        },

        getRooms(state, payload) {
            state.rooms = payload;
            state.rooms.forEach((room) => {

                let name = JSON.parse(room.name);
                let desc = JSON.parse(room.description);
                let oa = JSON.parse(room.other_amenities);
                let slogan = JSON.parse(room.slogan);

                //koristim da ubacim i kalendare i cijene
                let reserved_dates = JSON.parse(room.calendars.reserved_dates);
                state.reservedDates = [...state.reservedDates, {
                    id: room.id,
                    reserved_dates: reserved_dates
                }];
                let prices = JSON.parse(room.prices.prices);

                room.name = name;
                room.description = desc;
                room.other_amenities = oa;
                room.slogan = slogan;
                room.prices.prices = prices;
            })

        },
        getEvents(state, payload) {

            state.activeEvents = [];
            state.pastEvents = [];
            payload.forEach(event => {

                let name = JSON.parse(event.name);
                let description = JSON.parse(event.description);
                let preview = JSON.parse(event.preview);

                event.name = name;
                event.description = description;
                event.preview = preview;

                event.finish > Date.now() ? state.activeEvents.push(event) : state.pastEvents.push(event);
            });
        },

        getAbout(state, payload) {
            let texts = JSON.parse(payload);
            // state.about = {...state.about, sr : texts.sr, en : texts.en, ru : texts.ru};
            Vue.set(state.about, "sr", texts.sr);
            Vue.set(state.about, "en", texts.en);
            Vue.set(state.about, "ru", texts.ru);
        },
        getContact(state, payload) {
            state.contact = payload;
        },


        // ===========GUEST mutations===========
        getSlider(state, payload) {
            payload.sort(function(a, b) {
                return a.order - b.order
            }) //sortiranje po redu(object.order)
            let images = [];
            let texts = [];
            payload.forEach(img => {
                // console.log(img);
                images = [...images, "/images/slider/" + img.name];
                img.text = JSON.parse(img.text);
                texts = [...texts, img.text];
            })
            state.sliderImages = images;
            state.sliderTexts = texts;
        },
        getGallery(state, payload) {
            payload.sort(function(a, b) {
                return a.order - b.order
            }); //sortiranje po redu (object.order)
            let images = [];
            payload.forEach(img => {
                images = [...images, "/images/gallery/" + img.name];

            })
            state.galleryImages = images;
        },

        checkWarningDiscount(state) {

          // da li je setovano u ls (=da li je sajt skoro posjecen) i da li je prikazano posljednjih sat vremena
            if (typeof localStorage.getItem('discountWarningLastShown') == 'string') {
                // jeste : zabiljezi vrijeme posjete
                let lastShown = localStorage.getItem('discountWarningLastShown');
                // console.log((+new Date()- lastShown)/1000);
                // console.log("posljednje prikazano prije: ", ((+new Date() - lastShown)/1000));
                state.showDiscountDanger = (((+new Date() - lastShown) / 1000) > 3600);
                // console.log(state.showDiscountDanger);
                localStorage.setItem("discountWarningLastShown", +new Date());
            } else {
              //  nije : prikazi i zabiljezi posjetu
                state.showDiscountDanger = true;
                localStorage.setItem("discountWarningLastShown", +new Date());
            }

        },
        logout(state) {
            localStorage.removeItem("user");
            state.isLoggedIn = false;
            state.currentUser = null;
        },

    },





    actions: {

        ////////===========ADMIN ACTIONS===========

        login(context) {
            context.commit('login');
        },
        getRooms(context) {
            axios.get('/api/rooms')
                .then((response) => {
                    context.commit('getRooms', response.data.rooms);
                })
        },
        getEvents(context) {
            axios.get('/api/events')
                .then((response) => {
                    context.commit('getEvents', response.data.events);
                })
        },
        getAbout(context) {
            axios.get('/api/about')
                .then((response) => {
                    context.commit('getAbout', response.data.text);
                })
        },
        getContact(context) {
            axios.get('/api/contact')
                .then((response) => {
                    context.commit('getContact', response.data.data);
                })
        },



        /////============GUEST ACTIONS============

        guestGetRooms(context) {
            axios.get('/api/public/rooms').then((response => {
                context.commit('getRooms', response.data.rooms);
            }))
        },
        guestGetSlider(context) {
            axios.get('/api/public/slider').then((response => {
                context.commit('getSlider', response.data.images);
            }))
        },
        guestGetGallery(context) {
            axios.get('/api/public/gallery').then((response => {
                context.commit('getGallery', response.data.images);
            }))
        },
        guestGetEvents(context) {

            axios.get('/api/public/events')
                .then((response) => {
                    context.commit('getEvents', response.data.events);
                })
        },
        guestGetContact(context) {
            axios.get('/api/public/contact')
                .then((response) => {
                    context.commit('getContact', response.data.data);
                })
        },
        guestGetAbout(context) {

            axios.get('/api/public/about')
                .then((response) => {
                    context.commit('getAbout', response.data.text);
                })
        },




    }
}
