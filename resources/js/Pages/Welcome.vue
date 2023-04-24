<template>
    <layout>
        <div class="container pt-5">
            <div class="row">
                <div class="col-5">
                    <reservation-form @submitted="loadReservations"/>
                </div>
                <div class="col-5 text-center offset-1">
                    <h2>Table availability</h2>

                    <table class="table w-100">
                        <thead>
                        <tr>
                            <th>Time from</th>
                            <th>Time to</th>
                            <th>Week day</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="timeline in timelines">
                            <td>{{ timeline.time_from }}</td>
                            <td>{{ timeline.time_to }}</td>
                            <td>{{ timeline.day_no }}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
                <div class="col-12 text-center">
                    <h2>Reservations</h2>

                    <table class="table">
                        <thead>
                        <tr>
                            <th>From</th>
                            <th>To</th>
                            <th>Table</th>
                            <th>Party</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="reservation in reservations">
                            <td>{{ reservation.from }}</td>
                            <td>{{ reservation.to }}</td>
                            <td>{{ reservation.reservable }}</td>
                            <td>{{ reservation.reservee }}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </layout>
</template>
<script>
import Layout from "@/Layouts/Layout.vue";
import ReservationForm from "@/Components/ReservationForm.vue";

export default {
    components: {
        Layout,
        ReservationForm
    },
    data() {
        return {
            reservations: null,
            timelines: null,
        }
    },
    async mounted() {
        this.loadData();
    },
    methods: {
        async loadData() {
            this.timelines = (await axios.get('api/booker/availabilities/timelines')).data.data;
            this.loadReservations();
        },
        async loadReservations() {
            this.reservations = (await axios.get('api/booker/reservations?with[0]=reservable&with[1]=reservee')).data.data
        },
    }


}
</script>
