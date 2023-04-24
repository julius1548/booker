<template>

    <div class="alert alert-danger" role="alert" v-if="errors.length">
        <ul>
            <li v-for="error in errors">{{ error }}</li>
        </ul>
    </div>

    <div class="alert alert-success" role="alert" v-if="success">
        Reservation successful
    </div>

    <h3 class="text-center">Reservation</h3>
    <div class="mb-3">
        <select class="form-select" v-model="restaurant_id">
            <option selected value="">Select a restaurant</option>
            <option v-for="restaurant in restaurants" :value="restaurant.id">
                {{ restaurant.name }}
            </option>
        </select>
    </div>
    <div class="row">
        <div class="mb-3 col-6">
            <input class="form-control" placeholder="First name" v-model="main_contact.first_name">
        </div>
        <div class="mb-3 col-6">
            <input class="form-control" placeholder="Last name" v-model="main_contact.last_name">
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-6">
            <input placeholder="Email" class="form-control" v-model="main_contact.email">
        </div>
        <div class="mb-3 col-6">
            <div class="input-group">
                <span class="input-group-text">+370</span>
                <input type="text" v-model="main_contact.phone_number" class="form-control" placeholder="Phone">
            </div>
        </div>
    </div>

    <h5 class="text-center" v-if="contacts.length">Guests</h5>
    <template v-for="contact in contacts">
        <div class="row">
            <div class="mb-3 col-4">
                <input placeholder="First name" class="form-control" v-model="contact.first_name">
            </div>
            <div class="mb-3 col-4">
                <input placeholder="Last name" class="form-control" v-model="contact.last_name">
            </div>
            <div class="mb-3 col-4">
                <input placeholder="Email" class="form-control" v-model="contact.email">
            </div>
        </div>
    </template>

    <button class="btn btn-warning mb-3 me-3" @click="addContact()">+ Add guest</button>
    <button v-if="contacts.length" class="btn btn-danger mb-3" @click="removeContact()">
        - Remove guest
    </button>

    <h5 class="text-center">Date select</h5>
    <div class="form-group mb-3">
        <div class="row">
            <div class="col-6">
                <label class="input-group">Date</label>
                <vue-date-picker ref="date"
                                 v-model="date"
                                 :start-time="{minutes: 0}"
                                 :minutes-increment="60"
                                 :minutes-grid-increment="60"
                />
            </div>
            <div class="col-6">
                <label class="input-group">Reservation length (hours)</label>
                <input type="number" class="form-control" v-model="length">
            </div>
        </div>

        <button class="btn btn-success mb-3 me-3 mt-5" @click="submit()">Reserve</button>
    </div>
</template>

<script>
import Layout from "@/Layouts/Layout.vue";
import VueDatePicker from "@vuepic/vue-datepicker";
import '@vuepic/vue-datepicker/dist/main.css';

export default {
    components: {
        Layout,
        VueDatePicker,
    },
    emits: ["submitted"],
    name: "InspectForm",

    data() {
        return {
            success: false,
            errors: [],
            restaurants: null,
            date: null,
            to: null,
            length: 1,
            main_contact: {
                first_name: 'John',
                last_name: 'Johno',
                email: 'John@johno.com',
                country_code: '+370',
                phone_number: '12345678',
            },
            restaurant_id: "",
            contact_template: {
                first_name: 'John\'s',
                last_name: 'friend',
                email: 'friend@johns.com',
                country_code: '+370',
                phone_number: null,
            },
            contacts: []
        }
    },
    async mounted() {
        this.loadData();
    },
    methods: {
        async loadData() {
            this.restaurants = (await axios.get('api/restaurants')).data.data;
        },
        async loadReservations() {
            this.reservations = (await axios.get('api/booker/reservations?with[0]=reservable&with[1]=reservee')).data.data
        },
        addContact() {
            this.contacts.push(this.copy(this.contact_template));
        },
        removeContact() {
            this.contacts.pop();
        },
        copy(object) {
            return JSON.parse(JSON.stringify(object));
        },
        submit() {
            this.errors = [];
            this.success = false;
            let to = null;
            if (this.date) {
                to = new Date(this.date.valueOf());
                to = new Date(to.setHours(this.date.getHours() + this.length));
            }

            const data = {
                restaurant_id: this.restaurant_id,
                from: formatDate(this.date),
                to: formatDate(to),
                contacts: [
                    this.main_contact,
                    ...this.contacts
                ]
            }

            axios.post('api/reservations', data).then(() => {
                this.$emit('submitted');
                this.success = true;
            }).catch((error) => {
                if (error.response.status === 422) {
                    const errors = error.response.data.errors;
                    return Object.keys(errors).forEach((index) => {
                        this.errors.push(errors[index][0]);
                    });
                }

                this.errors.push(error.response.data.error);
            })

            function formatDate(date) {
                if (!date) {
                    return null;
                }
                const offset = date.getTimezoneOffset() * 60000;
                return new Date(date.getTime() - offset);
            }
        },
    }
}
</script>

<style scoped>

</style>
